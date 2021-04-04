<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'size',
        'quantity',
        'composition'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'api_token'
    ];
}
