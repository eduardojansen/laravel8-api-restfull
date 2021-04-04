<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory;
    use LogsActivity;


    protected $fillable = [
        'name',
        'code',
        'size',
        'quantity',
        'composition'
    ];

    protected static $logAttributes = [
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
