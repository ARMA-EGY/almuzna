<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Blog;
use App\BlogTag;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$categories       = Category::orderBy('id','desc')->get();
		
        return view('admin.categories.index', [
            'categories' => $categories,
            'categories_count' => Category::all()->count(),
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(CategoryRequest $request)
    {
            // Category::create([
            //     'name' => $request->name
            // ]);

            Category::create($request->all());
            
            $request->session()->flash('success', 'Category created successfully');
            
            return redirect(route('categories.index'));
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
    public function edit(Category $category)
    {
		return view('admin.categories.create', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        $category->update([
            'name' => $request->name
        ]);
		
		session()->flash('success', 'Category updated successfully');
		
		return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
		
		$category->delete();
		
		session()->flash('success', 'Category deleted successfully');
		
		return redirect(route('categories.index'));
    }

    
    //======== Remove Category ======== 
    public function removecategory(Request $request)
    {
        $item   = Category::where('id', $request->id)->first();
        $blogs  = Blog::where('category_id', $request->id);
        $blogs2 = Blog::where('category_id', $request->id)->get();

        foreach ($blogs2 as $blog) 
        {
            Storage::disk('public')->delete($blog->image);
            $tags = BlogTag::where('blog_id', $blog->id);
            $tags->delete();
        }

        $item->delete();
        $blogs->delete();
    }
}
