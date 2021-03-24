<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Category;
use App\Tag;
use App\BlogTag;
use App\Seo;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\SeoRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$blogs          = Blog::where('status', 1)->orderBy('id','desc')->get();
		
        return view('admin.blogs.index', [
            'blogs' => $blogs,
            'blog_count' => Blog::where('status', 1)->count(),
        ]);

    }


    public function draft()
    {
		
		$drafts         = Blog::where('status', 0)->orderBy('id','desc')->get();
		
        return view('admin.blogs.draft', [
            'drafts' => $drafts,
            'draft_count' => Blog::where('status', 0)->count(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.blogs.create', [
            'categories'    => Category::all() ,
             'tags'         => Tag::all(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        
        if($request->url == '')
        {
            $url1 = $request->title;
        }
        else
        {
            $url1 = $request->url;
        }

        $url =  preg_replace(array('/[-?]/', '/\s+/'), '_', $url1);

        $blog =  Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $request->image->store('images/blogs', 'public'),
            'alt_image' => $request->alt_image,
            'category_id' => $request->category_id,
            'user_id' => $request->userID,
            'token' => uniqid(),
            'url' => $url,
            'status' => $request->status
        ]);

        if($request->tags)
        {
            $blog->tags()->attach($request->tags);
        }

        $seo = Seo::create([
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'page_token' => $blog->token,
            'image' => $blog->image,
        ]);

        session()->flash('success', 'Post created successfully');
        
        return redirect(route('blogs.index'));
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
    public function edit(Blog $blog)
    {
        $seo                = Seo::where('page_token', $blog->token)->first();
        $blog->keywords     = $seo->keywords;

		return view('admin.blogs.create', [
            'blog'      => $blog,
            'categories' => Category::all() ,
            'tags'      => Tag::all(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if($request->url == '')
        {
            $url1 = $request->title;
        }
        else
        {
            $url1 = $request->url;
        }

        $url =  preg_replace(array('/[-?]/', '/\s+/'), '_', $url1);

        $data = $request->only(['title', 'description', 'content', 'category_id', 'alt_image', 'status']);


        $seo                = Seo::where('page_token', $blog->token)->first();
        $seo->title         = $request->title;
        $seo->description   = $request->description;
        $seo->keywords      = $request->keywords;

        if($request->hasfile('image'))
        {
            $image = $request->image->store('images/blogs', 'public');
            Storage::disk('public')->delete($blog->image);

            $data['image'] = $image;
            $seo->image     = $image;
        }

        if($request->tags)
        {
            $blog->tags()->sync($request->tags);
        }

        $data['url'] = $url;

        $blog->update($data);
        
        $seo->save();

        session()->flash('success', 'Post updated successfully');
        
        return redirect(route('blogs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::where('id', $id)->first();

        Storage::disk('public')->delete($blog->image);
        $blog->delete();

        session()->flash('success', 'Blog deleted successfully');
        
        return redirect(route('blogs.index'));

    }

    //======== Remove Blog ======== 
    public function removeblog(Request $request)
    {
        $item = Blog::where('id', $request->id)->first();
        $tags = BlogTag::where('blog_id', $request->id);
        // $tags = DB::table('blog_tag')->where('blog_id', $request->id);

        Storage::disk('public')->delete($item->image);

        $item->delete();
        $tags->delete();

    }
}
