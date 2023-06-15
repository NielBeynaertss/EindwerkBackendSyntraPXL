<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Member extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;

    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'phone',
        'streetnr',
        'city',
        'postalcode',
        'approved',
        'youthorganisation_id',
        'password',
        'approved_email_sent',
        'favourite_listings',
        'profile_picture'
    ];
}