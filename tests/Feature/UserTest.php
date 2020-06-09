<?php
# test/Feature/UserTest.php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A user test.
     *
     * @return void
     */
    public function testUserTest()
    {
        $response = $this->get('/');
        $response->assertRedirect('/user/1');
        $response->assertStatus(302);
    }
}
