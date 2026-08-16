<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'completed_at',
    ];

    /**
     * Defines the relationship between a Task and its user.
     *
     * A Task belongs to one User.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Defines the relationship between a Task and its category.
     *
     * A Task belongs to one Category.
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }

    protected function casts() : array {
        return [
            'due_date' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }
}
