<?php

namespace IdeaSeven\Core\Services\User;

use Illuminate\Http\Request;
use Bican\Roles\Models\Role;

class RoleService
{

    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }
    
    public function all()
    {
        return $this->role->all();
    }

    /**
     * Update a role in the DB
     *
     * @param $id
     * @param array $role
     * @return mixed
     */
    public function update($id, array $role)
    {
        return $this->role->find($id)->update($role);
    }

    /**
     * Create a new role in the DB
     *
     * @param array $role
     */
    public function store(array $role)
    {
        return $this->role->create($role);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->role->find($id)->delete();
    }
}