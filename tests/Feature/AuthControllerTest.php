<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test showing login page
     */
    public function test_show_login_page(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /**
     * Test successful login
     */
    public function test_successful_login(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test login with invalid credentials
     */
    public function test_login_with_invalid_credentials(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test login with missing email
     */
    public function test_login_with_missing_email(): void
    {
        $response = $this->post(route('login'), [
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test login with missing password
     */
    public function test_login_with_missing_password(): void
    {
        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /**
     * Test showing forgot password page
     */
    public function test_show_forgot_password_page(): void
    {
        $response = $this->get(route('password.request'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.forgot-password');
    }

    /**
     * Test successful send reset link using Mock
     */
    public function test_send_reset_link_success(): void
    {
        // Mock facade Password agar tidak query ke tabel password_reset_tokens
        Password::shouldReceive('sendResetLink')
            ->once()
            ->with(['email' => 'test@example.com'])
            ->andReturn(Password::RESET_LINK_SENT);

        $response = $this->post(route('password.email'), [
            'email' => 'test@example.com',
        ]);

        $response->assertSessionHas('status', __(Password::RESET_LINK_SENT));
    }

    /**
     * Test failed send reset link (email not found) using Mock
     */
    public function test_send_reset_link_invalid_email(): void
    {
        Password::shouldReceive('sendResetLink')
            ->once()
            ->with(['email' => 'notfound@example.com'])
            ->andReturn(Password::INVALID_USER);

        $response = $this->post(route('password.email'), [
            'email' => 'notfound@example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test showing reset password form
     */
    public function test_show_reset_password_form(): void
    {
        $token = 'test-token-12345';
        $response = $this->get(route('password.reset', ['token' => $token]));
        $response->assertStatus(200);
        $response->assertViewIs('auth.reset-password');
        $response->assertViewHas('token', $token);
    }

    /**
     * Test successful password reset using Mock
     */
    public function test_successful_password_reset(): void
    {
        Event::fake([PasswordReset::class]);

        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('oldpassword123'),
        ]);

        // Mock facade Password
        Password::shouldReceive('reset')
            ->once()
            ->andReturnUsing(function ($credentials, $callback) use ($user) {
                // Simulasi memanggil closure yang ada di Controller (untuk coverage 100%)
                $callback($user, $credentials['password']);
                return Password::PASSWORD_RESET;
            });

        $response = $this->post(route('password.update'), [
            'token' => 'dummy-token',
            'email' => 'test@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('success', 'Password berhasil diperbarui. Silakan login kembali.');
        
        $this->assertTrue(Hash::check('newpassword123', $user->fresh()->password));
        Event::assertDispatched(PasswordReset::class);
    }

    /**
     * Test failed password reset (invalid token) using Mock
     */
    public function test_failed_password_reset_invalid_token(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('oldpassword123'),
        ]);

        // Mock facade Password agar merespon INVALID_TOKEN
        Password::shouldReceive('reset')
            ->once()
            ->andReturn(Password::INVALID_TOKEN);

        $response = $this->post(route('password.update'), [
            'token' => 'invalid-token',
            'email' => 'test@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertTrue(Hash::check('oldpassword123', $user->fresh()->password));
    }

    /**
     * Test password reset validation (password mismatch)
     */
    public function test_password_reset_validation_fails(): void
    {
        $response = $this->post(route('password.update'), [
            'token' => 'some-token',
            'email' => 'test@example.com',
            'password' => 'newpassword123',
            'password_confirmation' => 'differentpassword123',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /**
     * Test logout
     */
    public function test_logout(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('logout'));

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    /**
     * Test logout with invalid session
     */
    public function test_logout_without_authentication(): void
    {
        $response = $this->post(route('logout'));
        
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}