# TopNew entity test

require "minitest/autorun"
require "json"
require_relative "../TopNews_sdk"
require_relative "runner"

class TopNewEntityTest < Minitest::Test
  def test_create_instance
    testsdk = TopNewsSDK.test(nil, nil)
    ent = testsdk.TopNew(nil)
    assert !ent.nil?
  end

  def test_basic_flow
    setup = top_new_basic_setup(nil)
    # Per-op sdk-test-control.json skip.
    _live = setup[:live] || false
    ["list"].each do |_op|
      _should_skip, _reason = Runner.is_control_skipped("entityOp", "top_new." + _op, _live ? "live" : "unit")
      if _should_skip
        skip(_reason || "skipped via sdk-test-control.json")
        return
      end
    end
    # The basic flow consumes synthetic IDs from the fixture. In live mode
    # without an *_ENTID env override, those IDs hit the live API and 4xx.
    if setup[:synthetic_only]
      skip "live entity test uses synthetic IDs from fixture — set TOPNEWS_TEST_TOP_NEW_ENTID JSON to run live"
      return
    end
    client = setup[:client]

    # Bootstrap entity data from existing test data.
    top_new_ref01_data_raw = Vs.items(Helpers.to_map(
      Vs.getpath(setup[:data], "existing.top_new")))
    top_new_ref01_data = nil
    if top_new_ref01_data_raw.length > 0
      top_new_ref01_data = Helpers.to_map(top_new_ref01_data_raw[0][1])
    end

    # LIST
    top_new_ref01_ent = client.TopNew(nil)
    top_new_ref01_match = {}

    top_new_ref01_list_result, err = top_new_ref01_ent.list(top_new_ref01_match, nil)
    assert_nil err
    assert top_new_ref01_list_result.is_a?(Array)

  end
end

def top_new_basic_setup(extra)
  Runner.load_env_local

  entity_data_file = File.join(__dir__, "..", "..", ".sdk", "test", "entity", "top_new", "TopNewTestData.json")
  entity_data_source = File.read(entity_data_file)
  entity_data = JSON.parse(entity_data_source)

  options = {}
  options["entity"] = entity_data["existing"]

  client = TopNewsSDK.test(options, extra)

  # Generate idmap via transform.
  idmap = Vs.transform(
    ["top_new01", "top_new02", "top_new03"],
    {
      "`$PACK`" => ["", {
        "`$KEY`" => "`$COPY`",
        "`$VAL`" => ["`$FORMAT`", "upper", "`$COPY`"],
      }],
    }
  )

  # Detect ENTID env override before envOverride consumes it. When live
  # mode is on without a real override, the basic test runs against synthetic
  # IDs from the fixture and 4xx's. Surface this so the test can skip.
  entid_env_raw = ENV["TOPNEWS_TEST_TOP_NEW_ENTID"]
  idmap_overridden = !entid_env_raw.nil? && entid_env_raw.strip.start_with?("{")

  env = Runner.env_override({
    "TOPNEWS_TEST_TOP_NEW_ENTID" => idmap,
    "TOPNEWS_TEST_LIVE" => "FALSE",
    "TOPNEWS_TEST_EXPLAIN" => "FALSE",
  })

  idmap_resolved = Helpers.to_map(
    env["TOPNEWS_TEST_TOP_NEW_ENTID"])
  if idmap_resolved.nil?
    idmap_resolved = Helpers.to_map(idmap)
  end

  if env["TOPNEWS_TEST_LIVE"] == "TRUE"
    merged_opts = Vs.merge([
      {
      },
      extra || {},
    ])
    client = TopNewsSDK.new(Helpers.to_map(merged_opts))
  end

  live = env["TOPNEWS_TEST_LIVE"] == "TRUE"
  {
    client: client,
    data: entity_data,
    idmap: idmap_resolved,
    env: env,
    explain: env["TOPNEWS_TEST_EXPLAIN"] == "TRUE",
    live: live,
    synthetic_only: live && !idmap_overridden,
    now: (Time.now.to_f * 1000).to_i,
  }
end
