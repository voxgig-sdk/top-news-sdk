<?php
declare(strict_types=1);

// TopNews SDK feature factory

require_once __DIR__ . '/feature/BaseFeature.php';
require_once __DIR__ . '/feature/TestFeature.php';


class TopNewsFeatures
{
    public static function make_feature(string $name)
    {
        switch ($name) {
            case "base":
                return new TopNewsBaseFeature();
            case "test":
                return new TopNewsTestFeature();
            default:
                return new TopNewsBaseFeature();
        }
    }
}
