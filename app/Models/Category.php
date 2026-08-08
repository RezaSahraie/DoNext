<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
    * The attributes that are mass assignable.
    */
    protected $fillable = [
        'user_id',
        'name',
        'color',
        'icon',
    ];

    /**
     * Defines the relationship between a Category and its user.
     *
     * A Category belongs to one User.
     */
    public function user() {
        return $this->belongsTo(User::class);;
    }
    
    /**
     * Defines the relationship between a Category and its tasks.
     *
     * A Category has many Tasks.
     */
    public function tasks() {
        return $this->hasMany(Task::class);
    }
    
}
