<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ReceiverEmailRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\LogoRequest;
use App\Http\Requests\SeoRequest;

use App\User;
use App\Page;
use App\Blog;
use App\Social;
use App\Message;
use App\Subscriber;
use App\ReceiverEmail;
use App\Logo;
use App\Seo;
use App\Category;
use App\Product;
use App\ProductImages;
use App\Visit;
use App\Tag;
use App\Todo;
use App\Note;
use App\Event;
use App\Configuration;
use App\Offer;
use App\Coupon;
use App\Customer;
use App\Driver;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */


/*
=========================================================
  *  PAGES 
=========================================================
*/ 

    //======== Home Page ======== 
    public function index()
    {
        $user = auth()->user();

        $latest_posts   = Blog::where('status', 1)->orderBy('id','desc')->limit(10)->get();

        $top_authors    = Blog::where('status', 1)->select('user_id', DB::raw('count(*) as total'))
                        ->groupBy('user_id')->orderBy('total','desc')
                        ->get();

        $categories    = Blog::where('status', 1)->select('category_id', DB::raw('count(*) as total'))
                        ->groupBy('category_id')->orderBy('total','desc')
                        ->get();

        $top_posts      = Blog::where('status', 1)->orderBy('views','desc')->limit(10)->get();


        foreach ($categories as $category)
        {
          $category_name[]  = $category->category->name;
          $category_posts[] = $category->total;
        }

        foreach ($top_authors as $author)
        {
          $author_name[]  = $author->user->name;
          $author_posts[] = $author->total;
        }


        return view('admin.home', [
            'traffic' => Visit::all()->sum('views'),
            'category_count' => Category::all()->count(),
            'products_count' => Product::where('type', 'product')->count(),
            'coupons_count' => Coupon::all()->count(),
            'offers_count' => Product::where('type', 'offer')->count(),
            'members_count' => User::all()->count(),
            'customers_count' => Customer::all()->count(),
            'drivers_count' => Driver::all()->count(),
            'messages_count' => Message::all()->count(),
            'latest_posts' => $latest_posts,
            'categories' => $categories,
            'category_name' => $category_name,
            'category_posts' => $category_posts,
            'author_name' => $author_name,
            'author_posts' => $author_posts,
            'top_posts' => $top_posts,
        ]);
    }

    //======== Pages Page ======== 
    public function pages()
    {
        $pages          = Page::orderBy('id','asc')->paginate(10);

        return view('admin.pages', [
            'pages'    => $pages,
        ]);
    }

    //======== Members Page ======== 
    public function members()
    {
        $users          = User::orderBy('id','asc')->paginate(10);

        return view('admin.members', [
            'users'    => $users,
        ]);
    }

    //======== Categories Page ======== 
    public function categories()
    {
        $categories     = Category::orderBy('id','desc')->paginate(30);

        return view('admin.categories', [
            'categories'    => $categories,
        ]);
    }

    //======== Messages Page ======== 
    public function messages()
    {
        $messages       = Message::orderBy('id','desc')->paginate(10);

        return view('admin.messages', [
            'messages'    => $messages,
        ]);
    }

    //======== Subscribers Page ======== 
    public function subscribers()
    {
        $subscribers     = Subscriber::orderBy('id','desc')->paginate(10);

        return view('admin.subscribers', [
            'subscribers'    => $subscribers,
        ]);
    }

    //======== Social Media Page ======== 
    public function socialmedia()
    {
        $socials        = Social::orderBy('id','desc')->paginate(10);

        return view('admin.socialmedia', [
            'socials'    => $socials,
        ]);
    }

    //======== Configuration Page ======== 
    public function configuration()
    {
        $order_min_price                = Configuration::where('name', 'order_min_price')->first();
        $today_max_price                = Configuration::where('name', 'today_max_price')->first();
        $sales_tax                      = Configuration::where('name', 'sales_tax')->first();
        $delivery_fees                  = Configuration::where('name', 'delivery_fees')->first();
        $first_order_discount           = Configuration::where('name', 'first_order_discount')->first();
        $driver_order_limit             = Configuration::where('name', 'driver_order_limit')->first();

        $order_value                    = $order_min_price->type . '_value';
        $today_value                    = $today_max_price->type . '_value';
        $sales_value                    = $sales_tax->type . '_value';
        $delivery_value                 = $delivery_fees->type . '_value';
        $first_order_value              = $first_order_discount->type . '_value';
        $driver_order_value             = $driver_order_limit->type . '_value';

        $order_min_price->value         = $order_min_price[$order_value];
        $today_max_price->value         = $today_max_price[$today_value];
        $sales_tax->value               = $sales_tax[$sales_value];
        $delivery_fees->value           = $delivery_fees[$delivery_value];
        $first_order_discount->value    = $first_order_discount[$first_order_value];
        $driver_order_limit->value      = $driver_order_limit[$driver_order_value];

        return view('admin.configuration', [
            'order_min_price'           => $order_min_price,
            'today_max_price'           => $today_max_price,
            'sales_tax'                 => $sales_tax,
            'delivery_fees'             => $delivery_fees,
            'first_order_discount'      => $first_order_discount,
            'driver_order_limit'        => $driver_order_limit,
            
        ]);
    }

    //======== Logo Page ======== 
    public function logo()
    {
        $logo     = Logo::first();

        return view('admin.logo', [
            'logo'    => $logo
        ]);
    }

    //======== Profile Page ======== 
    public function profile()
    {
        return view('admin.profile', []);
    }



/*
=========================================================
  *  ACTIONS 
=========================================================
*/ 

    //======== Configuration ======== 
    public function configurationEdit(Request $request)
    {

        for ($i = 0; $i < count($request->name); $i++) 
        {
            $con                = Configuration::where('name', $request->name[$i])->first();

            $value              = $request->type[$i] . '_value';
            $con[$value]        = $request->value[$i];

            $con->save();
        }


        if($con)
        {
            return response()->json([
                'status' => 'true',
                'msg' => 'success'
            ]) ;
        }
        else
        {
            return response()->json([
                'status' => 'false',
                'msg' => 'error'
            ]) ;
        }
    }

    //======== Social Media ======== 
    public function social(Request $request)
    {
        
        Social::truncate();

        for ($i = 0; $i < count($request->platform); $i++) 
        {
            $socials[] = [
                'platform' => $request->platform[$i],
                'link' => $request->link[$i],
                'off' => $request->off[$i]
            ];
        }

        $social =  Social::insert($socials);

        if($social)
        {
            return response()->json([
                'status' => 'true',
                'msg' => 'success'
            ]) ;
        }
        else
        {
            return response()->json([
                'status' => 'false',
                'msg' => 'error'
            ]) ;
        }
    }

    //======== Get Receiver Email ======== 
    public function getreceiveremail()
    {
        $email     = ReceiverEmail::first();

        return view('admin.modals.receiver_email', [
            'email'    => $email
        ]);
    }

    //======== Get Message ======== 
    public function getmessage(Request $request)
    {
        $message     = Message::find($request->id);

        $message->open = 1;
        $message->save();

        return view('admin.modals.show_message', [
            'message'    => $message
        ]);
    }

    //======== Receiver Email ======== 
    public function receiveremail(ReceiverEmailRequest $request)
    {
        ReceiverEmail::truncate();

        $create =  ReceiverEmail::create([
            'email' => $request->email,
        ]);

        if($create)
        {
            return response()->json([
                'status' => 'true',
                'msg' => 'success'
            ]) ;
        }
        else
        {
            return response()->json([
                'status' => 'false',
                'msg' => 'error'
            ]) ;
        }
    }

    //======== Change Logo ======== 
    public function changelogo(LogoRequest $request)
    {

        $old_logo     = Logo::first();

        if($old_logo)
        {
            Storage::disk('public')->delete($old_logo->logo);
        }

        Logo::truncate();

        $create =  Logo::create([
            'logo' => $request->logo->store('images/logo', 'public')
        ]);

        return redirect(route('admin-logo'));
    }

    //======== Get SEO ======== 
    public function getseo(Request $request)
    {
        $seo     = Seo::where('page_token', $request->page_token)->first();

        return view('admin.modals.show_seo', [
            'seo'    => $seo,
            'page_token'    => $request->page_token
        ]);
    }

    //======== Edit SEO ======== 
    public function seo(SeoRequest $request)
    {
        $seo     = Seo::where('page_token', $request->page_token)->first();

        if($seo)
        {
            $seo->title         = $request->title;
            $seo->description   = $request->description;
            $seo->keywords      = $request->keywords;
            $seo->canonical     = $request->canonical;

            if($request->hasfile('image'))
            {
                $image = $request->image->store('images/seo', 'public');
                Storage::disk('public')->delete($seo->image);
                
                $seo->image     = $image;
            }

            $seo->save();

            if($seo)
            {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'success'
                ]) ;
            }
            else
            {
                return response()->json([
                    'status' => 'false',
                    'msg' => 'error'
                ]) ;
            }
        }
        else
        {
            if($request->hasfile('image'))
            {
                $image = $request->image->store('images/seo', 'public');
            }
            else
            {
                $image = '';
            }

            $seo = Seo::create([
                'title' => $request->title,
                'description' => $request->description,
                'keywords' => $request->keywords,
                'canonical' => $request->canonical,
                'page_token' => $request->page_token,
                'image' => $image,
            ]);

            if($seo)
            {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'success'
                ]) ;
            }
            else
            {
                return response()->json([
                    'status' => 'false',
                    'msg' => 'error'
                ]) ;
            }
        }

    }

    //======== Add Category ======== 
    public function addcategory(CategoryRequest $request)
    {
            $category = Category::create([
                'name' => $request->name,
            ]);

            if($category)
            {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'success'
                ]) ;
            }
            else
            {
                return response()->json([
                    'status' => 'false',
                    'msg' => 'error'
                ]) ;
            }
    }

    //======== Remove Category ======== 
    public function removecategory(Request $request)
    {
        $category = Category::where('id', $request->id)->first();

        $category->delete();
    }

    //======== Get Category ======== 
    public function getcategory(Request $request)
    {
        $category     = Category::where('id', $request->id)->first();

        return view('admin.modals.edit_category', [
            'category'    => $category,
        ]);
    }


    //======== Edit Category ======== 
    public function editcategory(Request $request)
    {
        $category     = Category::where('id', $request->id)->first();

        $category->name         = $request->name;

        $category->save();

        if($category)
        {
            return response()->json([
                'status' => 'true',
                'msg' => 'success'
            ]) ;
        }
        else
        {
            return response()->json([
                'status' => 'false',
                'msg' => 'error'
            ]) ;
        }

    }

    //======== Edit User Info ======== 
    public function editinfo(UpdateUserRequest $request)
    {
            $user            = User::where('id', $request->id)->first();

            $data = $request->only(['name', 'email', 'gender', 'phone']);

            if($request->gender == 'Male')
            {
                $avatar = 'admin_assets/img/theme/avatar.png';
            }
            else
            {
                $avatar = 'admin_assets/img/theme/avatar2.png';
            }

            $data['avatar'] = $avatar;

            $user->update($data);

            if($user)
            {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'success'
                ]) ;
            }
            else
            {
                return response()->json([
                    'status' => 'false',
                    'msg' => 'error'
                ]) ;
            }
    }

    //======== Change Password ======== 
    public function changepassword(Request $request)
    {
            $user            = User::where('id', $request->id)->first();
            $old_password    = Hash::make($request->oldpassword);
            $new_password    = Hash::make($request->newpassword);

            $check  = Hash::check($request->oldpassword, $user->password);


            if($request->oldpassword == '')
            {
                return response()->json([
                'status' => 'error',
                'msg' => 'Current Password Required'
                ]) ;
            }
            elseif($request->newpassword == '')
            {
                return response()->json([
                'status' => 'error',
                'msg' => 'New Password Required'
                ]) ;
            }
            elseif(!$check)
            {
                return response()->json([
                'status' => 'error',
                'msg' => 'Current password is wrong'
                ]) ;
            }

            $data['password'] = $new_password;
            $user->update($data);

            if($user)
            {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'success'
                ]) ;
            }
            else
            {
                return response()->json([
                    'status' => 'false',
                    'msg' => 'error'
                ]) ;
            }
    }

    //======== Enable User ======== 
    public function enableuser(Request $request)
    {
        $user     = User::where('id', $request->id)->first();

        if($user->enable == 1)
        {
            $enable = 0;
        }
        elseif($user->enable == 0)
        {
            $enable = 1;
        }

        $user->enable = $enable;
        $user->save();
    }



    //======== Add Todo ======== 
    public function addtodo(Request $request)
    {
            $todo = Todo::create([
                'task' => $request->task,
                'user_id' => $request->user_id,
            ]);

            $todos   = Todo::where('user_id', $request->user_id)->get();

            return view('admin.modals.todo', [
                'todos'    => $todos,
            ]);
    }

    //======== Get Todo ======== 
    public function gettodo(Request $request)
    {
            $todos   = Todo::where('user_id', $request->id)->get();

            return view('admin.modals.todo', [
                'todos'    => $todos,
            ]);
    }

    //======== Edit Todo ======== 
    public function edittodo(Request $request)
    {
            $todo   = Todo::where('id', $request->id)->first();

            if($todo->done == 1)
            {
                $done = 0;
            }
            elseif($todo->done == 0)
            {
                $done = 1;
            }

            $todo->done = $done;
            $todo->save();
    }

    //======== Remove Todo ======== 
    public function removetodo(Request $request)
    {
        $todo   = Todo::where('id', $request->id)->first();

        $todo->delete();
    }



    //======== Create Note ======== 
    public function createnote()
    {
        return view('admin.modals.show_note', []);
    }

    //======== Add Note ======== 
    public function addnote(Request $request)
    {
            $note = Note::create([
                'title' => $request->title,
                'text' => $request->text,
                'user_id' => $request->user_id,
            ]);

            $notes   = Note::where('user_id', $request->user_id)->get();

            return view('admin.modals.note', [
                'notes'    => $notes,
            ]);
    }

    //======== Get Note ======== 
    public function getnote(Request $request)
    {
            $notes   = Note::where('user_id', $request->id)->get();

            return view('admin.modals.note', [
                'notes'    => $notes,
            ]);
    }

    //======== Show Note ======== 
    public function shownote(Request $request)
    {
            $note   = Note::where('id', $request->id)->first();

            return view('admin.modals.show_note', [
                'note'    => $note,
            ]);
    }

    //======== Edit Note ======== 
    public function editnote(Request $request)
    {
            $note   = Note::where('id', $request->note_id)->first();

            $note->title = $request->title;
            $note->text = $request->text;
            $note->save();

            $notes   = Note::where('user_id', $note->user_id)->get();

            return view('admin.modals.note', [
                'notes'    => $notes,
            ]);
    }

    //======== Remove Note ======== 
    public function removenote(Request $request)
    {
        $note   = Note::where('id', $request->id)->first();

        $note->delete();
    }

    //======== Calendar ======== 
    public function calendar(Request $request)
    {
            return view('admin.calendar', [ ]);
    }

    //======== Get Events ======== 
    public function getevent($user_id)
    {
        $events   = Event::where('user_id', $user_id)->get();
            
        foreach($events as $event)
        {
            $data[] = array(
            'id'   	        => $event["id"],
            'title'         => html_entity_decode($event["title"],ENT_QUOTES | ENT_XML1,'UTF-8'),
            'description'   => $event["description"],
            'start'         => $event["start_date"],
            'end'   	    => $event["end_date"],
            'className'     => $event["class_name"],
            'allDay'        => '!0'

            );
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    //======== Add Event ======== 
    public function addevent(Request $request)
    {
            $event = Event::create([
                'title' => $request->title,
                'user_id' => $request->user_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'class_name' => $request->class_name,
            ]);
    }

    //======== Remove Event ======== 
    public function removeevent(Request $request)
    {
        $event   = Event::where('id', $request->id)->first();

        $event->delete();
    }

    //======== Edit Event ======== 
    public function editevent(Request $request)
    {
            $event   = Event::where('id', $request->event_id)->first();

            $event->title           = $request->title;
            $event->description     = $request->description;
            $event->class_name      = $request->class_name;
            $event->save();
    }

    //======== Update Event ======== 
    public function updateevent(Request $request)
    {
            $event   = Event::where('id', $request->event_id)->first();

            $event->start_date     = $request->start_date;
            $event->end_date       = $request->end_date;
            $event->save();
    }

}
