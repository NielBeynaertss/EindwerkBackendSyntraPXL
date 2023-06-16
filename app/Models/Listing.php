<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'city',
        'description',
        'category',
        'type_of_transaction',
        'created_by',
        'postalcode'
    ];
}
