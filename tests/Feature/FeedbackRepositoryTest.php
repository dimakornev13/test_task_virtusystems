<?php

namespace Tests\Feature;

use App\Contracts\Repositories\FeedbackRepositoryInterface;
use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeedbackRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_success_feedback_repository_init()
    {
        $this->assertInstanceOf(FeedbackRepositoryInterface::class, resolve(FeedbackRepositoryInterface::class));
    }

    /**
     *
     */
    public function test_success_repository_work(){
        /** @var FeedbackRepositoryInterface $repository */
        $repository = resolve(FeedbackRepositoryInterface::class);

        $model = $repository->store(Feedback::factory()->make()->toArray());

        $this->assertInstanceOf(Feedback::class, $model);
    }
}
