<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function  before(User $user)
    {
        if ($user->hasRole('admin')){
            return true;
        }
        return false;
    }
    public  function  viewAny(User $user):bool
    {
        return  in_array($user->role,[
            User::ROLE_MEMBER,
            User::ROLE_EDITOR,
            User::ROLE_AUTHOR,
        ]);
    }
    public function  create(User $user):bool
    {
        return in_array($user->role,[
            User::ROLE_EDITOR,
            User::ROLE_AUTHOR
        ]);
    }
    public  function  update(User  $user, Category $category): bool
    {
        if($user->hasRole('editor')){
            return true;
        }
        return $user->id === $category->user_id;
    }
    public function delete(User $user, Category $category):bool
    {
        return in_array($user->role,[
            User::ROLE_ADMIN,
            User::ROLE_EDITOR
        ]);

        if($user->hasRole('author')){
           return $category->id === $user->user_id;
        }



    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
