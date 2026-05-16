<?php
declare(strict_types=1);

// TopNews SDK exists test

require_once __DIR__ . '/../topnews_sdk.php';

use PHPUnit\Framework\TestCase;

class ExistsTest extends TestCase
{
    public function test_create_test_sdk(): void
    {
        $testsdk = TopNewsSDK::test(null, null);
        $this->assertNotNull($testsdk);
    }
}
