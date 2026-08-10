<?php

use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create([
        'name' => 'Admin Utama',
        'email' => 'adminutama@gadaistartech.com',
    ]);
});

it('can display admin management index page for authenticated admin', function () {
    $response = $this->actingAs($this->admin)->get(route('admin-management.index'));
    $response->assertStatus(200);
    $response->assertSee('Manajemen Admin');
    $response->assertSee('Admin Utama');
});

it('can store a new admin user', function () {
    $response = $this->actingAs($this->admin)->post(route('admin-management.store'), [
        'name' => 'Petugas Cabang 2',
        'email' => 'petugas2@gadaistartech.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect(route('admin-management.index'));
    $this->assertDatabaseHas('users', [
        'email' => 'petugas2@gadaistartech.com',
        'name' => 'Petugas Cabang 2',
    ]);
});

it('can update admin profile information', function () {
    $targetAdmin = User::factory()->create([
        'name' => 'Old Name',
        'email' => 'oldemail@gadaistartech.com',
    ]);

    $response = $this->actingAs($this->admin)->put(route('admin-management.update', $targetAdmin), [
        'name' => 'Updated Name',
        'email' => 'updatedemail@gadaistartech.com',
    ]);

    $response->assertRedirect(route('admin-management.index'));
    $this->assertDatabaseHas('users', [
        'id' => $targetAdmin->id,
        'name' => 'Updated Name',
        'email' => 'updatedemail@gadaistartech.com',
    ]);
});

it('prevents self deletion of currently logged in admin', function () {
    $response = $this->actingAs($this->admin)->delete(route('admin-management.destroy', $this->admin));

    $response->assertRedirect();
    $response->assertSessionHas('error');
    $this->assertDatabaseHas('users', [
        'id' => $this->admin->id,
    ]);
});

it('can delete another admin user', function () {
    $otherAdmin = User::factory()->create();

    $response = $this->actingAs($this->admin)->delete(route('admin-management.destroy', $otherAdmin));

    $response->assertRedirect(route('admin-management.index'));
    $this->assertDatabaseMissing('users', [
        'id' => $otherAdmin->id,
    ]);
});
