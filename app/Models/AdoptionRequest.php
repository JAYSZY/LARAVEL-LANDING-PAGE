<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdoptionRequest extends Model
{
    protected $fillable = [
        'facility_name',
        'contact_name',
        'position',
        'email',
        'phone',
        'address',
        'message',
    ];
}
