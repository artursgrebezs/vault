<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_includes_post_form_and_csrf(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('method="post"', false);
        $response->assertSee('name="_token"', false);
    }

    public function test_livewire_login_redirects_super_admin_to_dashboard(): void
    {
        $role = Role::create(['name' => 'super-admin', 'guard_name' => 'web']);
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'secret-password',
        ]);
        $user->assignRole($role);

        Livewire::test('auth.login')
            ->set('email', 'admin@example.com')
            ->set('password', 'secret-password')
            ->call('login')
            ->assertRedirect(route('dashboard'));
    }

    public function test_livewire_login_rejects_invalid_credentials(): void
    {
        $role = Role::create(['name' => 'super-admin', 'guard_name' => 'web']);
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'secret-password',
        ]);
        $user->assignRole($role);

        Livewire::test('auth.login')
            ->set('email', 'admin@example.com')
            ->set('password', 'wrong')
            ->call('login')
            ->assertHasErrors('email');
    }

    public function test_livewire_login_rejects_user_without_super_admin_role(): void
    {
        Role::create(['name' => 'super-admin', 'guard_name' => 'web']);
        $user = User::factory()->create([
            'email' => 'plain@example.com',
            'password' => 'secret-password',
        ]);

        Livewire::test('auth.login')
            ->set('email', 'plain@example.com')
            ->set('password', 'secret-password')
            ->call('login')
            ->assertHasErrors('email');
    }
}
