<?php
declare(strict_types=1);

// TopNews SDK base feature

class TopNewsBaseFeature
{
    public string $version;
    public string $name;
    public bool $active;

    // Positions this feature when added via the client `extend` option:
    // "__before__" / "__after__" / "__replace__" name an already-added
    // feature (mirrors the ts feature `_options`). Declared so setting it
    // on an extension instance avoids the dynamic-property deprecation.
    public ?array $_options = null;

    public function __construct()
    {
        $this->version = '0.0.1';
        $this->name = 'base';
        $this->active = true;
    }

    public function get_version(): string { return $this->version; }
    public function get_name(): string { return $this->name; }
    public function get_active(): bool { return $this->active; }

    public function init(TopNewsContext $ctx, array $options): void {}
    public function PostConstruct(TopNewsContext $ctx): void {}
    public function PostConstructEntity(TopNewsContext $ctx): void {}
    public function SetData(TopNewsContext $ctx): void {}
    public function GetData(TopNewsContext $ctx): void {}
    public function GetMatch(TopNewsContext $ctx): void {}
    public function SetMatch(TopNewsContext $ctx): void {}
    public function PrePoint(TopNewsContext $ctx): void {}
    public function PreSpec(TopNewsContext $ctx): void {}
    public function PreRequest(TopNewsContext $ctx): void {}
    public function PreResponse(TopNewsContext $ctx): void {}
    public function PreResult(TopNewsContext $ctx): void {}
    public function PreDone(TopNewsContext $ctx): void {}
    public function PreUnexpected(TopNewsContext $ctx): void {}
}
