<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Account extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'phone',
        'address',
        'user_id',
    ];

    public function getAvatarUrl()
    {
        return Storage::url($this->avatar);
    }
}
