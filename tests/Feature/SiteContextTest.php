<?php

namespace Tests\Feature;

use App\Support\SiteContext;
use Tests\TestCase;

class SiteContextTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('site.sites', [
            'site1.example.com' => [
                'hosts' => ['site1.ddev.site'],
                'name' => 'Site 1',
                'connection' => 'site1',
                'app_url' => 'https://site1.example.com',
                'session_cookie' => 'site1_session',
            ],
        ]);
    }

    public function test_it_resolves_www_and_local_aliases_to_the_same_site(): void
    {
        $this->assertSame('site1', SiteContext::resolve('www.site1.example.com')['connection']);
        $this->assertSame('site1', SiteContext::resolve('site1.ddev.site:8443')['connection']);
    }

    public function test_local_alias_generates_local_urls_instead_of_live_urls(): void
    {
        $site = SiteContext::apply('site1.ddev.site');

        $this->assertSame('http://site1.ddev.site', $site['app_url']);
        $this->assertSame('http://site1.ddev.site', config('app.url'));
    }

    public function test_it_applies_site_context_for_matched_host(): void
    {
        $site = SiteContext::apply('site1.example.com');

        $this->assertNotNull($site);
        $this->assertSame('site1', config('database.default'));
        $this->assertSame('Site 1', config('app.name'));
        $this->assertSame('Site 1', config('site.current.display_name'));
        $this->assertSame('https://site1.example.com', config('app.url'));
    }

    public function test_it_keeps_default_connection_for_unknown_host(): void
    {
        config()->set('database.default', 'mysql');

        $site = SiteContext::apply('unknown.example.com');

        $this->assertNull($site);
        $this->assertSame('mysql', config('database.default'));
    }
}
