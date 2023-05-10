<?php

namespace App\paymentGateway;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;

class payment
{
    public function createOrder($addressId , $amounts ,$token , $gateway_name)
    {
        try
        {
            DB::beginTransaction();

            $order = Order::create([
                'user_id'=>auth()->id(),
                'address_id'=>$addressId,
                'coupon_id'=>session()->has('coupon') ? session()->get('coupon.id'): null,
                'total_amount'=>$amounts['total_amount'],
                'delivery_amount'=>$amounts['delivery_amount'],
                'coupon_amount'=>$amounts['coupon_amount'],
                'paying_amount'=>$amounts['paying_amount'],
                'payment_type'=>'online'
            ]);

            foreach (\Cart::getContent() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->associatedModel->id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->quantity * $item->price,
                ]);
            }

            Transaction::create([
                'user_id'=>auth()->id(),
                'order_id'=>$order->id,
                'amount'=>$amounts['paying_amount'],
                'token'=> $token ,
                'gateway_name' => $gateway_name
            ]);

            DB::commit();
        }catch(Exception $ex)
        {
            DB::rollBack();
            return ['error' => $ex->getmessage()];
        }
        return ['success' => 'success!'];

    }

    public function updateOrder($token , $refId)
    {
        try
        {
            DB::beginTransaction();

            $transaction = Transaction::where('token' , $token )->firstOrFail();
            $transaction->update([
                'status'=> 1,
                'ref_id' =>$refId
            ]);

            $order = Order::findOrFail($transaction->order_id);
            $order->update([
                'payment_status' => 1 ,
                'status' => 1
            ]);


            foreach (\Cart::getContent() as $item) {
            $product = Product::find($item->id);
            $product->update([
                'quantity' => $product->quantity - $item->quantity
            ]);
            }

            DB::commit();
        }catch(Exception $ex)
        {
            DB::rollBack();
            return ['error' => $ex->getmessage()];
        }
        return ['success' => 'success!'];
    }
}
