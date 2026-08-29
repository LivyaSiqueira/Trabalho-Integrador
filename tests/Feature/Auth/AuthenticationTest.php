<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

test('administrator login is fixed and redirects to admin users screen', function () {
    User::factory()->create([
        'name' => 'Administrador',
        'email' => 'admin@studyfy.com',
        'password' => bcrypt('admin123'),
    ]);

    $response = $this->post('/login', [
        'email' => 'admin@studyfy.com',
        'password' => 'admin123',
    ]);

    $this->assertAuthenticatedAs(User::where('email', 'admin@studyfy.com')->first());
    $response->assertRedirect(route('admin.users.index', absolute: false));
});

test('admin can access users control page and filter by search', function () {
    $userA = User::factory()->create(['name' => 'Maria Silva', 'email' => 'maria@example.com']);
    $userB = User::factory()->create(['name' => 'Pedro Souza', 'email' => 'pedro@example.com']);
    $admin = User::factory()->create(['name' => 'Administrador', 'email' => 'admin@studyfy.com', 'password' => bcrypt('admin123')]);

    $response = $this->actingAs($admin)->get('/admin/users?q=Maria');

    $response->assertOk();
    $response->assertSee('Maria Silva');
    $response->assertDontSee('Pedro Souza');
    $this->assertDatabaseHas('users', ['email' => 'maria@example.com']);
    $this->assertDatabaseHas('users', ['email' => 'admin@studyfy.com']);
});
