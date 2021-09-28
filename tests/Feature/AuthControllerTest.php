<?php


namespace Tests\Feature;


use App\Models\User;
use Illuminate\Foundation\Testing\TestCase;
use Laravel\Sanctum\Sanctum;
use Tests\CreatesApplication;

class AuthControllerTest extends TestCase
{
    use CreatesApplication;

    public function testUserCreateAccount()
    {
        $request = [
            'name' => 'Test Name',
            'email' => 'mail@mail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ];
        $result = $this->postJson('api/v1/register', $request)->json();

        $expected = [
            'message' => 'Registration Successful',
            'token' => '2|dmHjogARkl6t4p5UTQdMuipZ3Liyq6ELvaKHnwsx',
            'user' =>
                [
                    'name' => 'Test Name',
                    'email' => 'user@mail.com',
                    'email_verified_at' => '2020-10-12T18:06:53.000000Z',
                    'updated_at' => '2020-10-12T18:06:53.000000Z',
                    'created_at' => '2020-10-12T18:06:53.000000Z',
                    'id' => 3,
                ],
        ];


        $this->assertEquals($result['message'], $expected['message']);
    }

    public function testUserRegisterValidationError()
    {

        $result = $this->postJson('api/v1/register', [])->json();

        $expected = '{
            "message": "The given data was invalid.",
            "errors": {
                "name": [
                    "The name field is required."
                ],
                "email": [
                    "The email field is required."
                ],
                "password": [
                    "The password field is required."
                ]
            }
        }';


        $this->assertJson($expected, json_encode($result));
    }

    public function testUserLoginValidationError()
    {
        $user = User::factory()->create();
        $request = [
            'email' => $user->email,
            'password' => 'secret',
        ];

        $result = $this->postJson('api/v1/login', $request)->json();

        $expected = '{
            "message": "The given data was invalid.",
            "errors": {
                "email": [
                    "The provided credentials are incorrect."
                ]
            }
        }';


        $this->assertJson($expected, json_encode($result));
    }

    public function testUserLogin()
    {
//        $user = Sanctum::actingAs(
//            factory(User::class)->create(),
//            ['*']
//        );
        $user = User::factory()->create();
        $request = [
            'email' => $user->email,
            'password' => 'password',
            'remember' => true,
        ];
        $result = $this->postJson('api/v1/login', $request);

        $result->assertStatus(200);
        $this->assertAuthenticated();
    }

}
