<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, date>
     */
    protected $fillable = [
      'user_id',
      'customer_id',
      'title',
      'quantity',
      'executor',
      'deadline',
      'invoice_number'
    ];

    /**
     * Relationship to user model
     * 
     */
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function customer()
    {
      return $this->belongsTo(Customer::class);
    }

    /**
     * Relationship to progress model
     * 
     */
    public function progress()
    {
      return $this->hasOne(Progress::class);
    }

    /**
     * Relationship to payment model
     * 
     */
    public function payment()
    {
      return $this->hasOne(Payment::class);
    }
}
