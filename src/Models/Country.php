<?php

namespace IdeaSeven\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Multilingual\Translatable;

class Country extends Model
{
    use Translatable;
    protected $table = 'countries';
    public $translatable = ['name'];
    public $casts = ['name' => 'array'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

 


}
