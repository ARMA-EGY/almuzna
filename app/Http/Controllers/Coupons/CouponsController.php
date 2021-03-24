<?php

namespace App\Http\Controllers\Coupons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use App\Customer;
use App\Http\Requests\CouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$coupons         = Coupon::orderBy('id','desc')->get();
		
        return view('admin.coupons.index', [
            'coupons' => $coupons,
            'coupons_count' => Coupon::all()->count(),
        ]);

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers         = Customer::orderBy('id','desc')->get();

        return view('admin.coupons.create', [
            'customers' => $customers,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $coupon = Coupon::create([
            'code' => $request->code,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'use_num' => $request->use_num,
            'discount' => $request->discount,
            'type' => $request->type,
            'private' => $request->private,
        ]);

        if($request->customers)
        {
            $coupon->customers()->attach($request->customers);
        }


        session()->flash('success', 'Coupon created successfully');
        
        return redirect(route('coupons.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        $customers         = Customer::orderBy('id','desc')->get();

		return view('admin.coupons.create', [
            'coupon'      => $coupon,
            'customers' => $customers,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        
        $data = $request->only(['code', 'start_date', 'end_date', 'use_num', 'discount', 'available', 'type', 'private']);
        
        if($request->customers)
        {
            $coupon->customers()->sync($request->customers);
        }

        $coupon->update($data);

        session()->flash('success', 'Coupon updated successfully');
        
        return redirect(route('coupons.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    
}
