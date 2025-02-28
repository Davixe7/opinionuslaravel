<?php

namespace App\Policies;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin'); 
    }

    public function view(User $user, Survey $survey)
    {
        return $user->id === $survey->user_id || $user->hasRole('admin');;
    }

    public function update(User $user, Survey $survey)
    {
        return $user->id === $survey->user_id || $user->hasRole('admin');;
    }

    public function delete(User $user, Survey $survey)
    {
        return $user->id === $survey->user_id || $user->hasRole('admin');;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function restore(User $user, Survey $survey): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Survey $survey): bool
    {
        return false;
    }
}
