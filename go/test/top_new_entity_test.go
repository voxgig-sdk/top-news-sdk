package sdktest

import (
	"encoding/json"
	"os"
	"path/filepath"
	"runtime"
	"strings"
	"testing"
	"time"

	sdk "github.com/voxgig-sdk/top-news-sdk/go"
	"github.com/voxgig-sdk/top-news-sdk/go/core"

	vs "github.com/voxgig-sdk/top-news-sdk/go/utility/struct"
)

func TestTopNewEntity(t *testing.T) {
	t.Run("instance", func(t *testing.T) {
		testsdk := sdk.TestSDK(nil, nil)
		ent := testsdk.TopNew(nil)
		if ent == nil {
			t.Fatal("expected non-nil TopNewEntity")
		}
	})

	t.Run("basic", func(t *testing.T) {
		setup := top_newBasicSetup(nil)
		// Per-op sdk-test-control.json skip — basic test exercises a flow
		// with multiple ops; skipping any op skips the whole flow.
		_mode := "unit"
		if setup.live {
			_mode = "live"
		}
		for _, _op := range []string{"list"} {
			if _shouldSkip, _reason := isControlSkipped("entityOp", "top_new." + _op, _mode); _shouldSkip {
				if _reason == "" {
					_reason = "skipped via sdk-test-control.json"
				}
				t.Skip(_reason)
				return
			}
		}
		// The basic flow consumes synthetic IDs from the fixture. In live mode
		// without an *_ENTID env override, those IDs hit the live API and 4xx.
		if setup.syntheticOnly {
			t.Skip("live entity test uses synthetic IDs from fixture — set TOPNEWS_TEST_TOP_NEW_ENTID JSON to run live")
			return
		}
		client := setup.client

		// Bootstrap entity data from existing test data (no create step in flow).
		topNewRef01DataRaw := vs.Items(core.ToMapAny(vs.GetPath("existing.top_new", setup.data)))
		var topNewRef01Data map[string]any
		if len(topNewRef01DataRaw) > 0 {
			topNewRef01Data = core.ToMapAny(topNewRef01DataRaw[0][1])
		}
		// Discard guards against Go's unused-var check when the flow's steps
		// happen not to consume the bootstrap data (e.g. list-only flows).
		_ = topNewRef01Data

		// LIST
		topNewRef01Ent := client.TopNew(nil)
		topNewRef01Match := map[string]any{}

		topNewRef01ListResult, err := topNewRef01Ent.List(topNewRef01Match, nil)
		if err != nil {
			t.Fatalf("list failed: %v", err)
		}
		_, topNewRef01ListOk := topNewRef01ListResult.([]any)
		if !topNewRef01ListOk {
			t.Fatalf("expected list result to be an array, got %T", topNewRef01ListResult)
		}

	})
}

func top_newBasicSetup(extra map[string]any) *entityTestSetup {
	loadEnvLocal()

	_, filename, _, _ := runtime.Caller(0)
	dir := filepath.Dir(filename)

	entityDataFile := filepath.Join(dir, "..", "..", ".sdk", "test", "entity", "top_new", "TopNewTestData.json")

	entityDataSource, err := os.ReadFile(entityDataFile)
	if err != nil {
		panic("failed to read top_new test data: " + err.Error())
	}

	var entityData map[string]any
	if err := json.Unmarshal(entityDataSource, &entityData); err != nil {
		panic("failed to parse top_new test data: " + err.Error())
	}

	options := map[string]any{}
	options["entity"] = entityData["existing"]

	client := sdk.TestSDK(options, extra)

	// Generate idmap via transform, matching TS pattern.
	idmap := vs.Transform(
		[]any{"top_new01", "top_new02", "top_new03"},
		map[string]any{
			"`$PACK`": []any{"", map[string]any{
				"`$KEY`": "`$COPY`",
				"`$VAL`": []any{"`$FORMAT`", "upper", "`$COPY`"},
			}},
		},
	)

	// Detect ENTID env override before envOverride consumes it. When live
	// mode is on without a real override, the basic test runs against synthetic
	// IDs from the fixture and 4xx's. Surface this so the test can skip.
	entidEnvRaw := os.Getenv("TOPNEWS_TEST_TOP_NEW_ENTID")
	idmapOverridden := entidEnvRaw != "" && strings.HasPrefix(strings.TrimSpace(entidEnvRaw), "{")

	env := envOverride(map[string]any{
		"TOPNEWS_TEST_TOP_NEW_ENTID": idmap,
		"TOPNEWS_TEST_LIVE":      "FALSE",
		"TOPNEWS_TEST_EXPLAIN":   "FALSE",
		"TOPNEWS_APIKEY":         "NONE",
	})

	idmapResolved := core.ToMapAny(env["TOPNEWS_TEST_TOP_NEW_ENTID"])
	if idmapResolved == nil {
		idmapResolved = core.ToMapAny(idmap)
	}

	if env["TOPNEWS_TEST_LIVE"] == "TRUE" {
		mergedOpts := vs.Merge([]any{
			map[string]any{
				"apikey": env["TOPNEWS_APIKEY"],
			},
			extra,
		})
		client = sdk.NewTopNewsSDK(core.ToMapAny(mergedOpts))
	}

	live := env["TOPNEWS_TEST_LIVE"] == "TRUE"
	return &entityTestSetup{
		client:        client,
		data:          entityData,
		idmap:         idmapResolved,
		env:           env,
		explain:       env["TOPNEWS_TEST_EXPLAIN"] == "TRUE",
		live:          live,
		syntheticOnly: live && !idmapOverridden,
		now:           time.Now().UnixMilli(),
	}
}
