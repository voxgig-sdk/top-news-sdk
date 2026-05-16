<?php
declare(strict_types=1);

// TopNews SDK utility: make_context

require_once __DIR__ . '/../core/Context.php';

class TopNewsMakeContext
{
    public static function call(array $ctxmap, ?TopNewsContext $basectx): TopNewsContext
    {
        return new TopNewsContext($ctxmap, $basectx);
    }
}
