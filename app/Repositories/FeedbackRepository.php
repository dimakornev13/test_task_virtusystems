<?php

namespace App\Repositories;

use App\Contracts\Repositories\FeedbackRepositoryInterface;
use App\Models\Feedback;

class FeedbackRepository implements FeedbackRepositoryInterface
{
    /**
     * @param array $data
     * @return Feedback
     */
    public function store(array $data): Feedback
    {
        return Feedback::query()->create($data);
    }
}
