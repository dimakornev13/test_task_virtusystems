<?php

namespace App\Contracts\Services\Local;

use App\Contracts\Repositories\FeedbackRepositoryInterface;
use App\Models\Feedback;
use Illuminate\Http\UploadedFile;

abstract class AbstractFeedbackService
{
    public function __construct(protected FeedbackRepositoryInterface $repository)
    {
    }

    abstract public function store(array $data, UploadedFile $splFileInfo = null): Feedback;
}
