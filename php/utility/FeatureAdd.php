<?php
declare(strict_types=1);

// TopNews SDK utility: feature_add

class TopNewsFeatureAdd
{
    public static function call(TopNewsContext $ctx, mixed $f): void
    {
        $ctx->client->features[] = $f;
    }
}
