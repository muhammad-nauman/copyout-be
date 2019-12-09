<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Order;

class OrderDetail extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
