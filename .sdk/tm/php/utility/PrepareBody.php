<?php
declare(strict_types=1);

// TopNews SDK utility: prepare_body

class TopNewsPrepareBody
{
    public static function call(TopNewsContext $ctx): mixed
    {
        if ($ctx->op->input === 'data') {
            return ($ctx->utility->transform_request)($ctx);
        }
        return null;
    }
}
