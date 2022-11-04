<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Contact extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'avatar',
        'account_id',
        'favorite'
    ];

    public function getAvatarUrl()
    {
        return Storage::url($this->avatar);
    }
}
