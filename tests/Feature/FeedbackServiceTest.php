<?php

namespace Tests\Feature;

use App\Contracts\Services\Local\AbstractFeedbackService;
use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
     * @return void
     */
    public function test_success_service_work(){
        Storage::fake('public');

        /** @var AbstractFeedbackService $service */
        $service = resolve(AbstractFeedbackService::class);

        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');
        $model = $service->store(Feedback::factory()->make()->toArray(), $file);

        $this->assertInstanceOf(Feedback::class, $model);
        Storage::assertExists('feedback/' . $file->hashName());
    }
}
