<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<float, string>
     */
    protected $fillable = [
      'price',
      'payment_method',
      'down_payment',
      'paid_amount',
      'total'
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
