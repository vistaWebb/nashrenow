<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::latest()->paginate(5);
        return view('admin.coupons.index' , compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'code'=> 'required|unique:coupons,code',
            'type' =>'required',
            'amount' =>'required_if:type,=,amount',
            'percentage' =>'required_if:type,=,percentage',
            'max_percentage_amount' =>'required_if:type,=,percentage',
            'expired_at' =>'required'
        ]);

        Coupon::create([
            'name'=>$request->name,
            'code'=>$request->code,
            'type'=>$request->type,
            'amount'=>$request->amount,
            'percentage'=>$request->percentage,
            'max_percentage_amount'=>$request->max_percentage_amount,
            'expired_at'=>$request->expired_at,
        ]);

        alert()->success('با تشکر','کوپن با موفقیت اضافه شد');
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show' , compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit' , compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $coupon->update([
            'name'=>$request->name,
            'amount'=>$request->amount,
            'percentage'=>$request->percentage,
        ]);

        alert()->success('با تشکر','کوپن با موفقیت ویرایش شد');
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
