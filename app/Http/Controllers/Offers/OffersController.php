<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Offer;
use App\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\OfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$offers          = Product::where('type', 'offer')->orderBy('id','desc')->get();
		
        return view('admin.offers.index', [
            'offers' => $offers,
            'offers_count' => Product::where('type', 'offer')->count(),
        ]);

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offers.create', [
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {

        $offer = Product::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'type' => 'offer',
            'price' => $request->price,
            'image' => $request->image->store('images/offers', 'public'),
        ]);

        session()->flash('success', 'Offer created successfully');
        
        return redirect(route('offers.index'));
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
    public function edit(Product $offer)
    {

		return view('admin.offers.create', [
            'offer'      => $offer,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $offer)
    {

        $data = $request->only(['name_en', 'name_ar', 'description_en', 'description_ar', 'price']);
       
        if($request->hasfile('image'))
        {
            $image = $request->image->store('images/offers', 'public');
            Storage::disk('public')->delete($offer->image);

            $data['image'] = $image;
            $seo->image     = $image;
        }

        $offer->update($data);

        session()->flash('success', 'Offer updated successfully');
        
        return redirect(route('offers.index'));
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

    //======== Remove Offer ======== 
    public function removeoffer(Request $request)
    {
        $item = Product::where('id', $request->id)->first();

        Storage::disk('public')->delete($item->image);

        $item->delete();
    }
}
