<?php

namespace Tests\Feature\Middleware;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class SetLocaleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Buat route sementara untuk menguji middleware
        Route::get('/test-locale', function () {
            return app()->getLocale();
        })->middleware(\App\Http\Middleware\SetLocale::class);
    }

    public function test_it_sets_locale_from_session(): void
    {
        // 1. Simpan locale ke session
        session(['locale' => 'id']);

        // 2. Akses route
        $response = $this->get('/test-locale');

        // 3. Pastikan locale berubah
        $response->assertStatus(200);
        $this->assertEquals('id', app()->getLocale());
    }

    public function test_it_uses_default_locale_when_session_is_missing(): void
    {
        // 1. Jangan set session apapun
        
        // 2. Akses route
        $response = $this->get('/test-locale');

        // 3. Pastikan locale tetap default (biasanya 'en' di config/app.php)
        $response->assertStatus(200);
        $this->assertEquals(config('app.locale'), app()->getLocale());
    }
}