<?php
namespace Controller;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_returns_401_when_trying_to_get_details_and_not_being_logged()
    {
        // given

        // when
        $response = $this->get(route('users.me'));

        // then
        $response->assertStatus(401);
    }

    /** @test * */
    public function get_details_about_logged_user()
    {
        // given
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // when
        $response = $this->get(route('users.me'));

        // then
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ]);
    }
}