<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Vendor;
use App\Rider;
use App\Order;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    const ADMIN = 0;
    const VENDOR = 1;
    const RIDER = 2;
    const CUSTOMER = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getColumns()
    {
        return Schema::getColumnListing($this->table);
    }

    public function rider()
    {
        return $this->hasOne(Rider::class);
    }

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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}