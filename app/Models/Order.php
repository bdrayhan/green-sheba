<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    # Relationship With Courier
    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }

    # Relationship With User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    # Relationship With Shipping
    public function shipping(): HasOne
    {
        return $this->hasOne(Shipping::class);
    }

    # Relation With Order Details
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
    #relation with coupon
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class, 'coupon_code', 'coupon_name');
    }

    # Relation with User
    public function assign(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assign_id', 'id');
    }

    # Order Status Relation
    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'order_status', 'id');
    }

    # Today Order Count
    public function todayOrderCount()
    {
        $today = date('Y-m-d');
        $todayOrder = self::where('created_at', 'LIKE', '%' . $today . '%')->count();
        return $todayOrder;
    }


//    Return Order Relationship
    public function returnOrder(): HasOne
    {
        return $this->hasOne(ReturnOrder::class, 'id', 'order_id');
    }
}
