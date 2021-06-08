<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'cus_name',
        'cus_id',
        'cus_username',
        'tel',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'cus_id');
    }
}
