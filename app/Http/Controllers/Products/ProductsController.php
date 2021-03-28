<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImages;
use App\ProductCategory;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$products          = Product::where('type', 'product')->orderBy('id','desc')->get();
		
        return view('admin.products.index', [
            'products' => $products,
            'products_count' => Product::where('type', 'product')->count(),
        ]);

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create', [
            'categories'    => ProductCategory::all() ,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        if($request->refill == 1)
        {
            $product2 = Product::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'price' => $request->price,
                'type' => 'product',
                'refill' => $request->refill,
                'refill_price' => 0,
                'photo' => $request->photo->store('images/product', 'public'),
            ]);
        }
        elseif($request->refill == 0)
        {
            $product = Product::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'price' => $request->price,
                'type' => 'product',
                'refill' => 0,
                'refill_price' => 0,
                'photo' => $request->photo->store('images/product', 'public'),
            ]);
        }

        session()->flash('success', 'Product created successfully');
        
        return redirect(route('products.index'));
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
    public function edit(Product $product)
    {

        $product_images     = ProductImages::where('product_id', $product->id)->get();

		return view('admin.products.create', [
            'product'      => $product,
            'product_images'        => $product_images
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        $data = $request->only(['name_en', 'name_ar', 'price', 'refill', 'refill_price']);
        
        if($request->hasfile('photo'))
        {
            $image = $request->image->store('images/product', 'public');
            Storage::disk('public')->delete($product->photo);

            $data['photo']  = $image;
            $seo->image     = $image;
        }

        $product->update($data);

        session()->flash('success', 'Product updated successfully');
        
        return redirect(route('products.index'));
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

    //======== Remove Product ======== 
    public function removeproduct(Request $request)
    {
        $item = Product::where('id', $request->id)->first();

        Storage::disk('public')->delete($item->photo);

        $item->delete();
    }
}
