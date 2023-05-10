<?php

namespace App\Http\Controllers\Home;

use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qtybutton' => 'required'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->qtybutton > $product->quantity) {
            alert()->error('تعداد وارد شده از محصول درست نمی باشد', 'دقت کنید');
            return redirect()->back();
        }

        $rowId = $product->id;

        if (Cart::get($rowId) == null) {
            Cart::add(array(
                'id' => $rowId,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->qtybutton,
                'associatedModel' => $product
            ));
        } else {
            alert()->warning('محصول مورد نظر به سبد خرید شما اضافه شده است', 'دقت کنید');
            return redirect()->back();
        }

        alert()->success('محصول مورد نظر به سبد خرید شما اضافه شد', 'باتشکر');
        return redirect()->back();
    }

    public function index()
    {
        return view('home.cart.index');
    }

    public function update(Request $request)
    {

        $request->validate([
            'qtybutton' => 'required'
        ]);
        dd($request->all());

        foreach ($request->qtybutton as $rowId => $quantity) {

            $item = Cart::get($rowId);

            if ($quantity > $item->quantity) {
                alert()->error('تعداد وارد شده از محصول درست نمی باشد', 'دقت کنید');
                return redirect()->back();
            }

            Cart::update($rowId, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $quantity
                ),
            ));
        }

        alert()->success('سبد خرید شما ویرایش شد', 'باتشکر');
        return redirect()->back();
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        alert()->success('سبد خرید شما ویرایش شد', 'باتشکر');
        return redirect()->back();
    }

    public function clear()
    {
        Cart::clear();
        alert()->success('سبد خرید شما خالی شد', 'باتشکر');
        return redirect()->back();
    }

    public function checkCoupon(Request $request)
    {
        $request->validate([
            'code' =>'required'
        ]);

        if(!auth()->check()){
            alert()->error('دقت کنید','ابتدا باید وارد سایت شوید');
            return redirect()->back();
        }
        $result = checkCoupon($request->code);
        if(array_key_exists('error' , $result)){
            alert()->error('دقت کنید', $result['error']);
        }else{
            alert()->success('دقت کنید',$result['success']);
        }
        return redirect()->back();
    }

    public function checkout()
    {
        if(\Cart::isEmpty()){
            alert()->error('دقت کنید',' سبد خرید شما خالی است');
            return redirect()->route('home.index');
        }

        $addresses = UserAddress::where('user_id' , auth()->id())->get();
        $provinces = Province::all();

        return view('home.cart.checkout' , compact('provinces' , 'addresses'));
    }

    public function usersProfileIndex()
    {
        $orders = Order::where('user_id' , auth()->id())->get();
        return view('home.users_profile.orders' , compact('orders'));
    }
}
