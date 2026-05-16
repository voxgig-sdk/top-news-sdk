# TopNews SDK utility registration
require_relative '../core/utility_type'
require_relative 'clean'
require_relative 'done'
require_relative 'make_error'
require_relative 'feature_add'
require_relative 'feature_hook'
require_relative 'feature_init'
require_relative 'fetcher'
require_relative 'make_fetch_def'
require_relative 'make_context'
require_relative 'make_options'
require_relative 'make_request'
require_relative 'make_response'
require_relative 'make_result'
require_relative 'make_point'
require_relative 'make_spec'
require_relative 'make_url'
require_relative 'param'
require_relative 'prepare_auth'
require_relative 'prepare_body'
require_relative 'prepare_headers'
require_relative 'prepare_method'
require_relative 'prepare_params'
require_relative 'prepare_path'
require_relative 'prepare_query'
require_relative 'result_basic'
require_relative 'result_body'
require_relative 'result_headers'
require_relative 'transform_request'
require_relative 'transform_response'

TopNewsUtility.registrar = ->(u) {
  u.clean = TopNewsUtilities::Clean
  u.done = TopNewsUtilities::Done
  u.make_error = TopNewsUtilities::MakeError
  u.feature_add = TopNewsUtilities::FeatureAdd
  u.feature_hook = TopNewsUtilities::FeatureHook
  u.feature_init = TopNewsUtilities::FeatureInit
  u.fetcher = TopNewsUtilities::Fetcher
  u.make_fetch_def = TopNewsUtilities::MakeFetchDef
  u.make_context = TopNewsUtilities::MakeContext
  u.make_options = TopNewsUtilities::MakeOptions
  u.make_request = TopNewsUtilities::MakeRequest
  u.make_response = TopNewsUtilities::MakeResponse
  u.make_result = TopNewsUtilities::MakeResult
  u.make_point = TopNewsUtilities::MakePoint
  u.make_spec = TopNewsUtilities::MakeSpec
  u.make_url = TopNewsUtilities::MakeUrl
  u.param = TopNewsUtilities::Param
  u.prepare_auth = TopNewsUtilities::PrepareAuth
  u.prepare_body = TopNewsUtilities::PrepareBody
  u.prepare_headers = TopNewsUtilities::PrepareHeaders
  u.prepare_method = TopNewsUtilities::PrepareMethod
  u.prepare_params = TopNewsUtilities::PrepareParams
  u.prepare_path = TopNewsUtilities::PreparePath
  u.prepare_query = TopNewsUtilities::PrepareQuery
  u.result_basic = TopNewsUtilities::ResultBasic
  u.result_body = TopNewsUtilities::ResultBody
  u.result_headers = TopNewsUtilities::ResultHeaders
  u.transform_request = TopNewsUtilities::TransformRequest
  u.transform_response = TopNewsUtilities::TransformResponse
}
