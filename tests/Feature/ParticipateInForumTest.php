<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function unauthenticated_user_may_not_add_replies()
	{
        $this->withoutExceptionHandling();
		$this->expectException('Illuminate\Auth\AuthenticationException');

		$this->post('threads/1/replies', []);

	}
    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
    	$user = factory('App\User')->create();
    	$this->be($user);

    	$thread = factory('App\Thread')->create();
    	$reply = factory('App\Reply')->make();

    	$this->post($thread->path() . '/replies', $reply->toArray());

    	$this->get($thread->path())
    			->assertSee($reply->body);
    }
}
