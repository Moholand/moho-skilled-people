<?php

namespace App\Listeners;

use App\Models\Role;
use App\Events\UserRegistered;
use App\Services\UserRoleService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddUserToEmployers implements ShouldQueue
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
        if($event->role === 'employer') {
            // Add user to role_user table
            $this->userRoleService->storeUserRole($event->user_id, Role::EMPLOYER_ROLE_ID);
            // Add user to employers table
//            $this->employerService->storeEmployer(['user_id' => $event->user_id]);
        }
    }
}
