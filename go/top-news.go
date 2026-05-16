package voxgigtopnewssdk

import (
	"github.com/voxgig-sdk/top-news-sdk/core"
	"github.com/voxgig-sdk/top-news-sdk/entity"
	"github.com/voxgig-sdk/top-news-sdk/feature"
	_ "github.com/voxgig-sdk/top-news-sdk/utility"
)

// Type aliases preserve external API.
type TopNewsSDK = core.TopNewsSDK
type Context = core.Context
type Utility = core.Utility
type Feature = core.Feature
type Entity = core.Entity
type TopNewsEntity = core.TopNewsEntity
type FetcherFunc = core.FetcherFunc
type Spec = core.Spec
type Result = core.Result
type Response = core.Response
type Operation = core.Operation
type Control = core.Control
type TopNewsError = core.TopNewsError

// BaseFeature from feature package.
type BaseFeature = feature.BaseFeature

func init() {
	core.NewBaseFeatureFunc = func() core.Feature {
		return feature.NewBaseFeature()
	}
	core.NewTestFeatureFunc = func() core.Feature {
		return feature.NewTestFeature()
	}
	core.NewTopNewEntityFunc = func(client *core.TopNewsSDK, entopts map[string]any) core.TopNewsEntity {
		return entity.NewTopNewEntity(client, entopts)
	}
}

// Constructor re-exports.
var NewTopNewsSDK = core.NewTopNewsSDK
var TestSDK = core.TestSDK
var NewContext = core.NewContext
var NewSpec = core.NewSpec
var NewResult = core.NewResult
var NewResponse = core.NewResponse
var NewOperation = core.NewOperation
var MakeConfig = core.MakeConfig
var NewBaseFeature = feature.NewBaseFeature
var NewTestFeature = feature.NewTestFeature
