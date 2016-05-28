<?php

namespace IdeaSeven\Core\Services\User;


use Bican\Roles\Models\Role;
use IdeaSeven\Core\Models\User;
use IdeaSeven\Core\QueryFilters\Filterable;
use Illuminate\Support\Collection;

/**
 * Class UserService
 * @package IdeaSeven\Core\Services\User
 */
class UserService
{
    use Filterable;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var $model
     */
    public $model;

    /**
     * UserService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->model = $user;
    }

    /**
     * Filters the translations based on filters provided
     * Legend has it that it will filter properly role based queries.
     * So, if i am an admin, i should not be able to see the super users
     *
     * @param $filters
     */
    public function filter($filters, array $options = [])
    {
        $results = $this->user->filter($filters);
        $results = (array_key_exists('orderBy', $options)) ? $results->orderBy($options['orderBy']) : $results->orderBy('created_at', 'asc');
        /**
         * find all the roles that are a lower or same level as i am
         * to that, check which of my roles have a lower or equal level
         * compared to the rest
         */
        $roles = \Auth::user()->getRoles();
        $myMaxLevel = $roles->pluck('level')->max();
        $allRoles = Role::all();
        $allRolesMaxLevel = $allRoles->pluck('level')->max();
        //if my level is max, i am a super user
        $checkByRole = ($myMaxLevel >= $allRolesMaxLevel);

        //i am not a super user, so i need to figure out which roles i am looking for
        //so that we can filter out everything higher than mine #MindBlown

        $rolesToLookUp = [];
        if (!$checkByRole) {
            $rolesToLookUp = $allRoles->each(function ($role, $key) use ($myMaxLevel) {
                return $role->level <= $myMaxLevel;
            })->pluck('slug')->toArray();
        }


/*        \DB::listen(function ($query) {
            var_dump($query->sql);
            var_dump($query->bindings);
        });*/

        $results = $results
            ->with(['roles', 'userPermissions']);

        if (!$checkByRole) {
            $results = $results
                ->where(function ($subQuery) use ($rolesToLookUp) {
                    //nest these queries cause there might have been some direct
                    //filters applied earlier on from the query string
                    return $subQuery->whereNotIn('id', function ($q) {
                        //grab all users with NO roles, plain users basically
                        return $q->select('role_user.user_id')
                            ->from('role_user')
                            ->leftJoin('users', 'users.id', '=', 'role_user.user_id');
                    })
                        ->orWhereHas('roles', function ($q) use ($rolesToLookUp) {
                            //grab all users with the specific roles
                            return $q->whereIn('slug', $rolesToLookUp);
                        });
                });
        }



        $results = $results->paginate();


        return $results;
    }


    /**
     * Updates existing users
     *
     * @param $id
     * @param array $user
     * @return array
     */
    public function update($id, array $user)
    {
        $User = $this->user->find($id);
        $User->update($user);
        
        if (array_key_exists('roles', $user)){
            $User->roles()->sync($this->extractFromUser($user['roles']));
        }

        if (array_key_exists('user_permissions', $user)){
            $User->userPermissions()->sync($this->extractFromUser($user['user_permissions']));
        }

       return $user;
    }

    /**
     * Create a new user
     *
     * @param array $user
     * @return static
     */
    public function store(array $user)
    {
        $User = $this->user->create($user);
        
        if (array_key_exists('roles', $user)){
            $User->roles()->sync($this->extractFromUser($user['roles']));
        }

        if (array_key_exists('user_permissions', $user)){
            $User->userPermissions()->sync($this->extractFromUser($user['user_permissions']));
        }
        

        return $User;
    }


    /**
     * Delete a user
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->user->find($id)->delete();
    }

    /**
     * @param $arr
     * @param string $key
     * @return array
     */
    private function extractFromUser($arr, $key = 'id'){
        $collection =  new Collection($arr);
        return $collection->pluck($key)->toArray();
    }
}