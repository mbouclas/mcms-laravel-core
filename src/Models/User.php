<?php

namespace IdeaSeven\Core\Models;

use FrontEnd\Models\Content;
use IdeaSeven\Core\QueryFilters\Filterable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use IdeaSeven\Core\Traits\Presentable;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

/**
 * The User model
 * Class User
 * @package IdeaSeven\Core\Models
 */
class User extends Authenticatable implements HasRoleAndPermissionContract
{
    use Presentable, HasRoleAndPermission, CanResetPassword, Filterable;
    /**
     * Set the presenter class. Will add extra view-model presenter methods
     * @var string
     */
    protected $presenter = 'IdeaSeven\Core\Presenters\UserPresenter';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    /**
     * Auto cast variables to types
     * @var array
     */
    protected $casts = [
        'profile' => 'array',
        'settings' => 'array',
    ];


    /**
     * Check if i am the owner of this model    
     * @param $relation
     * @return bool
     */
    public function owns($relation)
    {
        return $relation->uid == $this->id;
    }

    /**
     * return content that belongs to the user
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function content()
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Save a new content automatically assigning the uid to it
     * try something like User->publish(new Content($request->all));
     * This will create a new content assigning the uid to it
     * @param Content $content
     */
    public function publishContent(Content $content)
    {
        $this->content()->save($content);
    }


}
