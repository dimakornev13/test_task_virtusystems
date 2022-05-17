<?php

namespace Tests\Feature;

use App\Contracts\Services\Local\AbstractFeedbackService;
use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeedbackServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_success_feedback_service_init()
    {
        $this->assertInstanceOf(AbstractFeedbackService::class, resolve(AbstractFeedbackService::class));
    }

    /**
     *
     */
    public function test_success_service_work(){
        /** @var AbstractFeedbackService $service */
        $service = resolve(AbstractFeedbackService::class);

        $model = $service->store(Feedback::factory()->make()->toArray());

        $this->assertInstanceOf(Feedback::class, $model);
    }
}
