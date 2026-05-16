<?php
declare(strict_types=1);

// TopNews SDK utility: result_body

class TopNewsResultBody
{
    public static function call(TopNewsContext $ctx): ?TopNewsResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result && $response && $response->json_func && $response->body) {
            $result->body = ($response->json_func)();
        }
        return $result;
    }
}
