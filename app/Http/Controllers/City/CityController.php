<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\Http\Requests\CityRequest;
use App\Http\Requests\UpdateCityRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$cities         = City::orderBy('id','desc')->get();
		
        return view('admin.cities.index', [
            'cities' => $cities,
            'cities_count' => City::all()->count(),
        ]);

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create', [
            
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $city = City::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'area_en' => $request->area_en,
            'area_ar' => $request->area_ar,
            'delivery_fees' => $request->delivery_fees,
            'available' => $request->available,
        ]);


        session()->flash('success', 'City added successfully');
        
        return redirect(route('city.index'));
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
    public function edit(City $city)
    {
		return view('admin.cities.create', [
            'city'      => $city,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, City $city)
    {

        $data = $request->only(['name_en', 'name_ar', 'area_en', 'area_ar', 'delivery_fees', 'available']);
        
        $city->update($data);

        session()->flash('success', 'City updated successfully');
        
        return redirect(route('city.index'));
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
