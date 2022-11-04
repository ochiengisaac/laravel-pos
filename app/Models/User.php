<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'role', 'avatar', 'phone', 'address', 
        'longitude', 'latitude', 'tagline', 'header_image', 'kyc_completed', 'national_identification_no', 
        'national_identification_front', 'national_identification_back', 'passport_number', 'business_registration_no',
        'business_registration_cert', 'recent_bank_statement', 'account_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart()
    {
        return $this->belongsToMany(Product::class, 'user_cart')->withPivot('quantity');
    }

    public function getFullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getAvatar()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email);
    }

    
    public function getAvatarUrl()
    {
        return Storage::url($this->avatar);
    }

    public function getHeaderImageUrl()
    {
        return Storage::url($this->header_image);
    }

    public function getNationalIdentificationPicFrontUrl()
    {
        return Storage::url($this->national_identification_front);
    }

    public function getNationalIdentificationPicBackUrl()
    {
        return Storage::url($this->national_identification_back);
    }

    public function getBusinessRegistrationCertUrl()
    {
        return Storage::url($this->business_registration_cert);
    }

    public function getRecentBankStatmtUrl()
    {
        return Storage::url($this->recent_bank_statement);
    }



}
