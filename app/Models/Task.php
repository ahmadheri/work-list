<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'description',
      'status',
      'hours',
      'work_start_date',
      'work_end_date'
    ];
}
