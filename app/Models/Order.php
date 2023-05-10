<?php

namespace App\Models;

use App\Models\User;
use App\Models\Coupon;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $guarded = [];

    // public function getStatusAttribute($status)
    // {
    //     switch($status){
    //         case '0' :
    //             $status = 'در انتظار پرداخت';
    //         break;
    //         case '1':
    //             $status = 'پرداخت شده';
    //         break;
    //     }
    //     return $status;
    // }

    // public function getPaymentTypeAttribute($paymentType)
    // {
    //     switch($paymentType){
    //         case 'pos' :
    //             $paymentType = 'دستگاه پوز';
    //         break;
    //         case 'online':
    //             $paymentType = 'اینترنتی ';
    //         break;
    //     }
    //     return $paymentType;
    // }

    // public function getPaymentStatusAttribute($paymentStatus)
    // {
    //     switch($paymentStatus){
    //         case '0' :
    //             $paymentStatus = 'ناموفق';
    //         break;
    //         case '1':
    //             $paymentStatus ='موفق';
    //         break;
    //     }
    //     return $paymentStatus;
    // }


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class);
    }
}
