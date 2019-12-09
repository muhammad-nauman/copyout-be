<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\VendorRating;
use App\Order;
use App\Rider;

class Vendor extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(VendorRating::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function riders()
    {
        return $this->hasMany(Rider::class);
    }
}
