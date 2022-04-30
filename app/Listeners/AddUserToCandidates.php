<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Role;
use App\Services\CandidateService;
use App\Services\UserRoleService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddUserToCandidates implements ShouldQueue
{
    /**
     * @var CandidateService $candidateService
     */
    public $candidateService;

    /**
     * @var UserRoleService $userRoleService
     */
    public $userRoleService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CandidateService $candidateService, UserRoleService $userRoleService)
    {
        $this->candidateService = $candidateService;
        $this->userRoleService = $userRoleService;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        if($event->roleData['role'] === 'candidate') {
            // Add user to role_user table
            $this->userRoleService->storeUserRole($event->user_id, Role::CANDIDATE_ROLE_ID);
            // Add user to candidates table
            $this->candidateService->storeCandidate(['user_id' => $event->user_id]);
        }
    }
}
