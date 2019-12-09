<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Vendor;
use App\Rider;
use App\OrderDetail;

class Order extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        return $this->beolongsTo(User::class);
    }
    
    public function vendor()
    {
        return $this->beolongsTo(Vendor::class);
    }
    
    
    public function rider()
    {
        return $this->beolongsTo(Rider::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
    
}
