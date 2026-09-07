<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        // Browser requests retain CSRF protection. Feature tests submit JSON
        // requests directly, so they intentionally bypass that browser-only
        // requirement while exercising authenticated application behaviour.
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }
}
