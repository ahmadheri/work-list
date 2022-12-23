<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<boolean>
     */
    protected $fillable = [
      'task_id',
      'design',
      'print'
    ];

    /**
     * Relationship to task model
     * 
     */
    public function task()
    {
      return $this->belongsTo(Task::class);
    }
}
