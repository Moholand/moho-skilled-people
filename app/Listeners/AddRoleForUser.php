<?php

namespace App\Listeners;

use App\Models\Role;
use App\Events\UserRegistered;
use App\Services\UserRoleService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddRoleForUser implements ShouldQueue
{
    /**
     * @var UserRoleService $userRoleService
     */
    public $userRoleService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserRoleService $userRoleService)
    {
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
        $role_id = $event->role === 'employer' ? Role::EMPLOYER_ROLE_ID : Role::CANDIDATE_ROLE_ID;

        $this->userRoleService->storeUserRole($event->user_id, $role_id);
    }
}
