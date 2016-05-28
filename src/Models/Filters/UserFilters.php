<?php

namespace IdeaSeven\Core\Models\Filters;

use IdeaSeven\Core\QueryFilters\QueryFilters;


/**
 * Implement query based filtering for the User model
 * Class UserFilters
 * @package IdeaSeven\Core\Models\Filters
 */
class UserFilters extends QueryFilters
{
    /**
     * @var array
     */
    protected $filterable = [
        'id',
        'status',
        'email',
        'role',
    ];

    /**
     * @example ?status=active,inactive O
     * @param $status
     * @return mixed
     */
    public function status($status = null)
    {
        if ( ! $status){
            return $this->builder;
        }

        //In case ?status=active,inactive
        if (! is_array($status)) {
            $status = $status = explode(',',$status);
        }

        return $this->builder->whereIn('active', $status);
    }

    /**
     * @param $email
     * @return $this
     */
    public function email($email = null)
    {
        if ( ! $email){
            return $this->builder;
        }

        return $this->builder->where('email', 'LIKE', "%{$email}%");
    }

    /**
     * @param $role
     * @return mixed
     */
    public function role($role = null)
    {
        if ( ! $role){
            return $this->builder;
        }

        //join first
        //In case ?role=guest,admin,moderator
        if (! is_array($role)) {
            $role = $role = explode(',',$role);
        }

        return $this->builder->whereIn('active', $role);
    }

    public function id($id = null)
    {
        if ( ! $id){
            return $this->builder;
        }

        //join first
        //In case ?role=guest,admin,moderator
        if (! is_array($id)) {
            $id = $id = explode(',',$id);
        }

        return $this->builder->whereIn('id', $id);
    }
}