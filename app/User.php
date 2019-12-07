<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Vendor;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    const ADMIN = 0;
    const VENDOR = 1;
    const RIDER = 2;
    const CUSTOMER = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    public function isAdmin()
    {
        return $this->user_role === self::ADMIN;
    }

    public function isCustomer()
    {
        return $this->user_role === self::CUSTOMER;
    }

    public function isVendor()
    {
        return $this->user_role === self::VENDOR;
    }

    public function isRider()
    {
        return $this->user_role === self::RIDER;
    }

    public static function scopeOnlyAdmins($query)
    {
        return $query->where('user_role', self::ADMIN)->get();
    }

    public static function scopeOnlyVendors($query)
    {
        return $query->where('user_role', self::VENDOR)->with('vendor')->get();
    }

    public static function scopeOnlyRiders($query)
    {
        return $query->where('user_role', self::RIDER)->get();
    }

    public static function scopeOnlyCustomer($query)
    {
        return $query->where('user_role', self::CUSTOMER)->get();
    }
}