<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Role;
use App\Services\CandidateService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddUserToCandidates implements ShouldQueue
{
    /**
     * @var CandidateService $candidateService
     */
    public $candidateService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        if($event->role === 'candidate') {
            $this->candidateService->storeCandidate(['user_id' => $event->user_id]);
        }
    }
}
