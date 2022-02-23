<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate');
    }

    public function test_can_register_and_see_welcome_page()
    {
        $name = $this->faker->name;
        $email = $this->faker->email;
        $crmv = strval($this->faker->numberBetween($min = 111111, $max = 999999));
        $password = $this->faker->password(8);

        $response = $this->post('/register', [
            'name' => $name,
            'email' => $email,
            'crmv' => $crmv,
            'password' => $password,
            'password_confirmation' => $password,
        ]);
        $response->assertStatus(302);

        $user = User::where([
            'name' => $name,
            'email' => $email,
        ])->first();
        $this->assertNotNull($user);

        $response = $this->actingAs($user)->get('admin');
        $response->assertStatus(200);
    }

    public function test_cannot_access_admin_routes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('purchases/1/edit');
        $response->assertStatus(403);

        $response = $this->put('purchases/1', []);
        $response->assertStatus(403);

        $response = $this->delete('purchases/1');
        $response->assertStatus(403);

        $response = $this->delete('tutores/1');
        $response->assertStatus(403);

        $response = $this->delete('animais/1');
        $response->assertStatus(403);

        $response = $this->delete('finance/1');
        $response->assertStatus(403);

        $response = $this->delete('service/1');
        $response->assertStatus(403);

        $response = $this->get('registros/1/edit');
        $response->assertStatus(403);
    }

    public function test_logged_user()
    {
        $response = $this->get('/admin')->assertStatus(302);
    }

    public function test_register_form()
    {
        $response = $this->get('/register')->assertStatus(200);
    }

//    public function test_it_stores_new_users()
//    {
//        $admin = User::factory()->create(['admin' => 1]);
//        $response = $this->actingAs($admin)->post('tutores', [
//            'nome' => 'UserTest',
//            'telefone' => '11985645874',
//        ]);
//        $response->assertRedirect('tutores');
//        $response = $this->post('/register', [
//           'name'=>'UserTest', 'crmv'=>'654321', 'email'=>'usertest@mail.com', 'password'=>'123456789', 'password_confirmation'=>'123456789'
//        ]);
//        $response->assertCreated();
//    }
}
