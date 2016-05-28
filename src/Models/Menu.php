<?php

namespace IdeaSeven\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = 'menus';
    public $casts = ['settings' => 'array'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'slug',
        'settings'
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
 


}
