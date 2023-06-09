<?php

namespace App\Http\Controllers\Home;

use Exception;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\paymentGateway\Pay;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use App\PaymentGateway\Zarinpal;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
            'payment_method' => 'required',
        ]);

        if ($validator->fails()) {
            alert()
                ->error('انتخاب آدرس تحویل سفارش الزامی می باشد', 'دقت کنید')
                ->persistent('حله');
            return redirect()->back();
        }

        $checkCart = $this->checkCart();
        if (array_key_exists('error', $checkCart)) {
            alert()->error($checkCart['error'], 'دقت کنید');
            return redirect()->route('home.index');
        }

        $amounts = $this->getAmounts();
        if (array_key_exists('error', $amounts)) {
            alert()->error($amounts['error'], 'دقت کنید');
            return redirect()->route('home.index');
        }

        if($request->payment_method == 'pay') {
            $payGateway = new Pay();
            $payGatewayResult = $payGateway->send($amounts, $request->address_id);
            if (array_key_exists('error', $payGatewayResult)) {
                alert()->error($payGatewayResult['error'], 'دقت کنید');
                return redirect()->back();
            }else{
                return redirect()->to($payGatewayResult['success']);
            }
        }

        if($request->payment_method == 'zarinpal') {
            $zarinpalGateway = new Zarinpal();
            $zarinpalGatewayresult = $zarinpalGateway->send($amounts , 'تستس' , $request->address_id);
            if (array_key_exists('error', $zarinpalGatewayresult)) {
                alert()->error($zarinpalGatewayresult['error'], 'دقت کنید');
                return redirect()->back();
            }else{
                return redirect()->to($zarinpalGatewayresult['success']);
            }
        }

        alert()->error('درگاه انتخابی معتبر نمی باشد', 'دقت کنید');
        return redirect()->back();
    }

    public function paymentVerify(Request $request , $gatewayName)
    {
        if($gatewayName == 'pay'){
            $payGateway = new Pay();
            $payGatewayResult = $payGateway->verify($request->token , $request->status);
            if (array_key_exists('error', $payGatewayResult)) {
                alert()->error($payGatewayResult['error'], 'دقت کنید');
                return redirect()->back();
            }else{
                alert()->success($payGatewayResult['success'], 'دقت کنید');
                return redirect()->route('home.index');
            }
        }

        if($gatewayName == 'zarinpal'){
            $amounts = $this->getAmounts();
            if (array_key_exists('error', $amounts)) {
                alert()->error($amounts['error'], 'دقت کنید');
                return redirect()->route('home.index');
            }

            $zarinpalGateway = new Zarinpal();
            $zarinpalGatewayResult = $zarinpalGateway->verify($request->Authority , $amounts['paying_amount']);
            if (array_key_exists('error', $zarinpalGatewayResult)) {
                alert()->error($zarinpalGatewayResult['error'], 'دقت کنید');
                return redirect()->back();
            }else{
                alert()->success($zarinpalGatewayResult['success'], 'دقت کنید');
                return redirect()->route('home.index');
            }
        }

        alert()->error('مسیر بازگشت از درگاه انتخابی معتبر نمی باشد', 'دقت کنید');
        return redirect()->route('home.orders.checkout');
    }

    public function checkCart()
    {
        if (\Cart::isEmpty()) {
            return ['error' => 'سبد خرید شما خالی می باشد.'];
        }

        foreach (\Cart::getContent() as $item) {
            $product = Product::find($item->id);

            if ($item->price != $product->price) {
                \Cart::clear();
                return ['error' => 'قیمت محصول تغییر پیدا کرد'];
            }

            if ($item->quantity > $product->quantity) {
                \Cart::clear();
                return ['error' => 'تعداد محصول تغییر پیدا کرد'];
            }
            return ['success' => 'success!'];
        }
    }

    public function getAmounts()
    {
        if (session()->has('coupon')) {
            $checkCoupon = checkCoupon(session()->get('coupon.code'));

            if (array_key_exists('error', $checkCoupon)) {
                return $checkCoupon;
            }
        }

        return [
            'total_amount' => cartTotalAmount(),
            'delivery_amount' => cartTotalDeliveryAmount(),
            'coupon_amount' => session()->has('coupon') ? session()->get('coupon.amount') : 0,
            'paying_amount' => cartTotalAmount(),
        ];
    }
}
