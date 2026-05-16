<?php
declare(strict_types=1);

// TopNews SDK utility: make_error

require_once __DIR__ . '/../core/Operation.php';
require_once __DIR__ . '/../core/Result.php';
require_once __DIR__ . '/../core/Error.php';

class TopNewsMakeError
{
    public static function call(?TopNewsContext $ctx, mixed $err): array
    {
        if ($ctx === null) {
            require_once __DIR__ . '/../core/Context.php';
            $ctx = new TopNewsContext([], null);
        }
        $op = $ctx->op ?? new TopNewsOperation([]);
        $opname = $op->name;
        if ($opname === '' || $opname === '_') {
            $opname = 'unknown operation';
        }

        $result = $ctx->result ?? new TopNewsResult([]);
        $result->ok = false;

        if ($err === null) {
            $err = $result->err;
        }
        if ($err === null) {
            $err = $ctx->make_error('unknown', 'unknown error');
        }

        $errmsg = ($err instanceof TopNewsError) ? $err->msg : (string)$err;
        $msg = "TopNewsSDK: {$opname}: {$errmsg}";
        $msg = ($ctx->utility->clean)($ctx, $msg);

        $result->err = null;
        $spec = $ctx->spec;

        if ($ctx->ctrl->explain) {
            $ctx->ctrl->explain['err'] = ['message' => $msg];
        }

        $sdk_err = new TopNewsError('', $msg, $ctx);
        $sdk_err->result = ($ctx->utility->clean)($ctx, $result);
        $sdk_err->spec = ($ctx->utility->clean)($ctx, $spec);
        if ($err instanceof TopNewsError) {
            $sdk_err->sdk_code = $err->sdk_code;
        }

        $ctx->ctrl->err = $sdk_err;

        if ($ctx->ctrl->throw_err === false) {
            return [$result->resdata, null];
        }
        return [null, $sdk_err];
    }
}
