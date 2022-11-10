<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
      'name',
      'phone',
      'email'
    ];

    /**
     * Relationship to task model
     * 
     */
    public function tasks()
    {
      return $this->hasMany(Task::class);
    }
}
