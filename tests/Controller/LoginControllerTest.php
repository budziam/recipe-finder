<?php
namespace Controller;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test * */
    public function it_can_logout()
    {
        // given
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // when
        $this->post(route('logout'));

        // then
        $this->dontSeeIsAuthenticated();
    }
}