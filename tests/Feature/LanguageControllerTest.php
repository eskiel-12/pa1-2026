<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test switch language to Indonesian
     */
    public function test_switch_language_to_indonesian(): void
    {
        // Membuat user dummy dan melakukan simulasi login
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from('/halaman-awal')
            ->get(route('language.switch', ['lang' => 'id']));

        $response->assertRedirect('/halaman-awal');
        $response->assertSessionHas('Locale', 'id');
    }

    /**
     * Test switch language to English
     */
    public function test_switch_language_to_english(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from('/halaman-berita')
            ->get(route('language.switch', ['lang' => 'en']));

        $response->assertRedirect('/halaman-berita');
        $response->assertSessionHas('Locale', 'en');
    }

    /**
     * Test switch to invalid language still works
     */
    public function test_switch_language_to_custom_language(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from('/kontak')
            ->get(route('language.switch', ['lang' => 'custom']));

        $response->assertRedirect('/kontak');
        $response->assertSessionHas('Locale', 'custom');
    }
}