<?php
declare(strict_types=1);

// TopNews SDK utility registration

require_once __DIR__ . '/../core/UtilityType.php';
require_once __DIR__ . '/Clean.php';
require_once __DIR__ . '/Done.php';
require_once __DIR__ . '/MakeError.php';
require_once __DIR__ . '/FeatureAdd.php';
require_once __DIR__ . '/FeatureHook.php';
require_once __DIR__ . '/FeatureInit.php';
require_once __DIR__ . '/Fetcher.php';
require_once __DIR__ . '/MakeFetchDef.php';
require_once __DIR__ . '/MakeContext.php';
require_once __DIR__ . '/MakeOptions.php';
require_once __DIR__ . '/MakeRequest.php';
require_once __DIR__ . '/MakeResponse.php';
require_once __DIR__ . '/MakeResult.php';
require_once __DIR__ . '/MakePoint.php';
require_once __DIR__ . '/MakeSpec.php';
require_once __DIR__ . '/MakeUrl.php';
require_once __DIR__ . '/Param.php';
require_once __DIR__ . '/PrepareAuth.php';
require_once __DIR__ . '/PrepareBody.php';
require_once __DIR__ . '/PrepareHeaders.php';
require_once __DIR__ . '/PrepareMethod.php';
require_once __DIR__ . '/PrepareParams.php';
require_once __DIR__ . '/PreparePath.php';
require_once __DIR__ . '/PrepareQuery.php';
require_once __DIR__ . '/ResultBasic.php';
require_once __DIR__ . '/ResultBody.php';
require_once __DIR__ . '/ResultHeaders.php';
require_once __DIR__ . '/TransformRequest.php';
require_once __DIR__ . '/TransformResponse.php';

TopNewsUtility::setRegistrar(function (TopNewsUtility $u): void {
    $u->clean = [TopNewsClean::class, 'call'];
    $u->done = [TopNewsDone::class, 'call'];
    $u->make_error = [TopNewsMakeError::class, 'call'];
    $u->feature_add = [TopNewsFeatureAdd::class, 'call'];
    $u->feature_hook = [TopNewsFeatureHook::class, 'call'];
    $u->feature_init = [TopNewsFeatureInit::class, 'call'];
    $u->fetcher = [TopNewsFetcher::class, 'call'];
    $u->make_fetch_def = [TopNewsMakeFetchDef::class, 'call'];
    $u->make_context = [TopNewsMakeContext::class, 'call'];
    $u->make_options = [TopNewsMakeOptions::class, 'call'];
    $u->make_request = [TopNewsMakeRequest::class, 'call'];
    $u->make_response = [TopNewsMakeResponse::class, 'call'];
    $u->make_result = [TopNewsMakeResult::class, 'call'];
    $u->make_point = [TopNewsMakePoint::class, 'call'];
    $u->make_spec = [TopNewsMakeSpec::class, 'call'];
    $u->make_url = [TopNewsMakeUrl::class, 'call'];
    $u->param = [TopNewsParam::class, 'call'];
    $u->prepare_auth = [TopNewsPrepareAuth::class, 'call'];
    $u->prepare_body = [TopNewsPrepareBody::class, 'call'];
    $u->prepare_headers = [TopNewsPrepareHeaders::class, 'call'];
    $u->prepare_method = [TopNewsPrepareMethod::class, 'call'];
    $u->prepare_params = [TopNewsPrepareParams::class, 'call'];
    $u->prepare_path = [TopNewsPreparePath::class, 'call'];
    $u->prepare_query = [TopNewsPrepareQuery::class, 'call'];
    $u->result_basic = [TopNewsResultBasic::class, 'call'];
    $u->result_body = [TopNewsResultBody::class, 'call'];
    $u->result_headers = [TopNewsResultHeaders::class, 'call'];
    $u->transform_request = [TopNewsTransformRequest::class, 'call'];
    $u->transform_response = [TopNewsTransformResponse::class, 'call'];
});
