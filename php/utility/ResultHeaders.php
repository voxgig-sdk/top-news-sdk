<?php
declare(strict_types=1);

// TopNews SDK utility: result_headers

class TopNewsResultHeaders
{
    public static function call(TopNewsContext $ctx): ?TopNewsResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result) {
            if ($response && is_array($response->headers)) {
                $result->headers = $response->headers;
            } else {
                $result->headers = [];
            }
        }
        return $result;
    }
}
