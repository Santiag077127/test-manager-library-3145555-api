<?php

namespace Tests\Feature;

use Library\Bootstrap\LibraryServiceProvider;
use Tests\TestCase;

class ApplicationConfigurationTest extends TestCase
{
    public function test_application_boots_with_the_phase_one_configuration(): void
    {
        $this->assertSame('pgsql', config('database.default'));
        $this->assertSame('library,public', config('database.connections.pgsql.search_path'));
        $this->assertSame('public.migrations', config('database.migrations.table'));
        $this->assertSame('covers', config('filesystems.default'));
        $this->assertFalse(config('filesystems.disks.covers.serve'));
        $this->assertNull(config('auth.defaults.guard'));
        $this->assertTrue($this->app->providerIsLoaded(LibraryServiceProvider::class));
    }
}
