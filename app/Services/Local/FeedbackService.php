<?php

namespace App\Services\Local;

use \App\Contracts\Services\Local\AbstractFeedbackService;
use Illuminate\Http\UploadedFile;

class FeedbackService extends AbstractFeedbackService
{
    public function store(array $data, UploadedFile $splFileInfo = null)
    {
        if ($splFileInfo) {
            $data['file'] = $splFileInfo->store('feedback');
        }

        $model = $this->repository->store($data);

        // may be trigger some functions

        return $model;
    }
}
