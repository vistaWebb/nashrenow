<?php

namespace App\Http\Controllers\Home;

use App\Models\City;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = UserAddress::where('user_id' , auth()->id())->get();
        $provinces = Province::all();
        return view('home.users_profile.addresses' , compact('provinces' , 'addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cellphone' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
        ]);

        UserAddress::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'cellphone' => $request->cellphone,
            'province_id' =>$request->province_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'postal_code' =>$request->postal_code,
        ]);

        alert()->success('با موفقیت انجام شد','ادرس با موفقیت ارسال شد');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserAddress $address)
    {
        $validator = Validator::make($request->all() , [
            'title' => 'required',
            'cellphone' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'postal_code' => 'required'
        ]);

        if($validator->fails()){
            $validator->errors()->add('address_id' , $address->id);
            return redirect()->back()->withErrors($validator , 'addressUpdate')->withInput();
        }

        $address->update([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'cellphone' => $request->cellphone,
            'province_id' =>$request->province_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'postal_code' =>$request->postal_code,
        ]);

        alert()->success('با موفقیت انجام شد','ادرس با موفقیت ارسال شد');
        return redirect()->route('home.addresses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getProvinceCitiesList(Request $request)
    {
        $cities = City::where('province_id', $request->province_id)->get();
        return $cities;
    }
}
