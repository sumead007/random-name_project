<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tel',
        'username',
    ];
    public $timestamps = false;

    public function random_detail()
    {
        return $this->hasOne(RandomDetail::class,'id');
    }
}
