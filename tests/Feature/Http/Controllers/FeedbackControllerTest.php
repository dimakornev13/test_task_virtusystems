<?php

namespace Tests\Feature\Http\Controllers;

use App\Contracts\Repositories\FeedbackRepositoryInterface;
use App\Contracts\Services\Local\AbstractFeedbackService;
use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Mockery\MockInterface;
use Tests\TestCase;

class FeedbackControllerTest extends TestCase
{
    use WithFaker,
        RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_status_200_controller()
    {
        $repository = $this->mock(FeedbackRepositoryInterface::class, function (MockInterface $mock){
            $mock->shouldReceive('store')->andReturn(Feedback::factory()->make());
        });

        $response = $this->post(route('feedback.create'), [
            'message' => $this->faker->realTextBetween(100, 150),
            'attachment' => UploadedFile::fake()->create('document.pdf', 100, 'application/pdf')
        ]);

        $response->assertOk();
    }
}
