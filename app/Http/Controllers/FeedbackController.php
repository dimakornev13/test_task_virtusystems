<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Local\AbstractFeedbackService;
use App\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{
    /**
     * @param FeedbackRequest $request
     * @param AbstractFeedbackService $service
     * @return mixed
     */
    public function __invoke(FeedbackRequest $request, AbstractFeedbackService $service)
    {
        return $service->store($request->validated(), $request->file('attachment'));
    }
}
