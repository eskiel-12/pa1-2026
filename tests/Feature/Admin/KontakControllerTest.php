<?php

namespace Tests\Feature\Admin;

use App\Models\Kontak;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KontakControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $tableName = 'kontak';

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_index_page(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.kontak.index'));
        $response->assertStatus(200);
    }

    public function test_create_page(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.kontak.create'));
        $response->assertStatus(200);
    }

    public function test_store_kontak(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.kontak.store'), [
            'alamat' => 'Jln. Test No. 123',
            'telepon_1' => '081234567890',
            'email_1' => 'test@example.com',
            'jam_buka_kerja' => '08:00',
            'jam_tutup_kerja' => '17:00',
        ]);

        $response->assertRedirect(route('admin.kontak.index'));
        $this->assertDatabaseHas($this->tableName, ['alamat' => 'Jln. Test No. 123']);
    }

    public function test_store_validation_fails_with_invalid_email(): void
    {
        $response = $this->actingAs($this->user)->post(route('admin.kontak.store'), [
            'email_1' => 'bukan-email-valid',
        ]);

        $response->assertSessionHasErrors('email_1');
    }

    public function test_edit_page(): void
    {
        $kontak = Kontak::factory()->create();
        $response = $this->actingAs($this->user)->get(route('admin.kontak.edit', $kontak->id));
        $response->assertStatus(200);
    }

    public function test_update_kontak(): void
    {
        $kontak = Kontak::factory()->create(['alamat' => 'Alamat Lama']);

        $response = $this->actingAs($this->user)->put(route('admin.kontak.update', $kontak->id), [
            'alamat' => 'Updated Address',
        ]);

        $response->assertRedirect(route('admin.kontak.index'));
        $this->assertDatabaseHas($this->tableName, [
            'id' => $kontak->id,
            'alamat' => 'Updated Address',
        ]);
    }

    public function test_destroy_kontak(): void
    {
        $kontak = Kontak::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('admin.kontak.destroy', $kontak->id));

        $response->assertRedirect(route('admin.kontak.index'));
        $this->assertDatabaseMissing($this->tableName, ['id' => $kontak->id]);
    }
}