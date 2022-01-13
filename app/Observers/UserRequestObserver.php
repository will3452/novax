<?php

namespace App\Observers;

use App\Models\Document;
use App\Models\UserRequest;

class UserRequestObserver
{
    public function creating(UserRequest $userRequest)
    {
        $document = Document::find($userRequest->document_id);

        $userRequest->document = $document->name;
        $userRequest->amount = $document->amount;

        $userRequest->name = auth()->user()->name;
        $userRequest->user_id = auth()->id();
    }
}
