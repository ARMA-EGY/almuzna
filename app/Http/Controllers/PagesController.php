<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ComponentsModel;
use App\ElementsModel;
use App\CardsModel;
use App\CardsElementsModel;
use App\ClientsModel;

use App\Blog;
use App\Page;
use App\Category;
use App\Product;
use App\Contact;
use App\Logo;

use Image;
use Illuminate\Support\Facades\DB;


class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
		  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



      // ======== Home Page ========

      public function index()
      {
          return view('admin.pages.home');      
      }

    





    // ================ Start Functions ================

    public function componenteditform(Request $request)
    {
        $id       = $request->get('id');
        $elements = ElementsModel::where('component_id',$id)->get();

        if($elements->isEmpty())
        {
            abort(404);
        } 

        $inputFields ="";
        foreach ($elements as $element)
        {
            if($element->type=="text")
            {
               $inputFields =   $inputFields . 
               '<div class="input-group mb-3"><div class="input-group-prepend"><label for="'.$element->name.'" class="input-group-text" id="basic-addon1">'.$element->name.'</label></div><input id="'.$element->name.'" class="form-control" type="text" name="'.$element->id.'" autocomplete="off" aria-describedby="basic-addon1" value="'.$element->content.'"></div>';                 
            }
            elseif ($element->type=="img") 
            {
                $inputFields =   $inputFields .
                '<div class="input-group mb-3"><input id="covertemp" class="mb-3" type="file"  name="'.$element->id.'" multiple="false" /></div>';
            }
            elseif ($element->type=="textarea") 
            {
               $inputFields =   $inputFields . 
               '<div class="input-group mb-3"><div class="input-group-prepend"><label for="'.$element->name.'" class="input-group-text" id="basic-addon1">'.$element->name.'</label></div><textarea id="'.$element->name.'" rows="3" cols="90" name="'.$element->id.'" >'.$element->content.'</textarea></div>';
            }elseif ($element->type=="editor") 
            {
               $inputFields =   $inputFields . 
               '<div class="input-group mb-3"><div class="input-group-prepend"></div><textarea class="content" id="'.$element->name.'" rows="3" cols="90" name="'.$element->id.'" >'.$element->content.'</textarea></div>';
            }




        }

        $form=
        '<form class="edit_form" data-target="">'.$inputFields.'<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="submit" class="btn btn-primary submit_edit_form">Save</button></div></form>';
  
        return $inputFields;               
    }

    public function updatecomponent(Request $request)
    {
        $data = array();
        foreach($_FILES as $name => $value)
        {

          if($value['name'] != "")
          {
            
            $element = ElementsModel::find($name);

            if(!$element)
            {
              abort(404);
            }

            if ($element->type == "img") 
            {
                  $file_pointer = public_path().'/'.$element->content;

                  if(file_exists($file_pointer))
                  {
                    unlink($file_pointer);
                  }
                  else
                  {
                    //abort(500);
                  }

                  $filenameToStore="";
                  $imagePath = "";
                  if($request->hasFile($name))
                  {
                    //Get File Name with the extenssion
                    $filenameWithExt = $request->file($name)->getClientOriginalName();
                    //get just filname
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    //get just ext
                    $extension = $request->file($name)->getClientOriginalExtension();

                    //Filename to store
                    $filenameToStore = $filename.'_'.time().'.'.$extension;

                    //upload image
                    $path = $request->file($name)->move('public/images/',$filenameToStore);

                    $imagePath = "images/".$filenameToStore;



                    ElementsModel::where('id',$name)->update(['content' => $imagePath]);

                    $temp = array($name=>$value);
                    $data = $data+$temp;                   
                  }             
            }

          }    

        }
        
        foreach($_POST as $name => $value)
        {   
            if($name!="_token")
            {
              $element = ElementsModel::find($name);

              if(!$element)
              {
                abort(404);
              }

              if($element->type == "text" || $element->type == "textarea")
              {
                  $updated_element = ElementsModel::where('id',$name)->update(['content' => $value]);

                  if(!$updated_element)
                  {
                    abort(422);
                  }
                  $element = ElementsModel::find($name);
                  array_push($data, $element);
              }
            }
        } 
        
        return response()->json($data, 200);
    }

    public function cardeditform(Request $request)
    {
        $id = $request->get('id');
        $elements = CardsElementsModel::where('card_id',$id)->get();

        if($elements->isEmpty())
        {
            abort(404);
        }  
        
        $inputFields ="";
        foreach ($elements as $element)
        {
            if($element->type=="text")
            {
               $inputFields =   $inputFields . 
               '<div class="input-group mb-3"><div class="input-group-prepend"><label for="'.$element->name.'" class="input-group-text" id="basic-addon1">'.$element->name.'</label></div><input id="'.$element->name.'" class="form-control" type="text" name="'.$element->id.'" autocomplete="off" aria-describedby="basic-addon1" value="'.$element->content.'"></div>';                 
            }
            elseif ($element->type=="img") 
            {
                $inputFields =   $inputFields .
                '<div class="input-group mb-3"><input id="covertemp" class="mb-3" type="file"  name="'.$element->id.'" multiple="false" /></div>';
            }
        }

        return $inputFields;              
    }

    public function updatecard(Request $request)
    {

        $data = array();
        foreach($_FILES as $name => $value)
        {
          
          if($value['name'] != "")
          {
            

          
            $element = CardsElementsModel::find($name);

            if(!$element)
            {
              abort(404);
            }

            if ($element->type == "img") {


                  $file_pointer = public_path().'/'.$element->content;

                  if(file_exists($file_pointer))
                  {
                    unlink($file_pointer);
                  }
                  else{
                   // abort(422);
                  }

                    $filenameToStore="";
                    $imagePath = "";
                    if($request->hasFile($name)){

                    //Get File Name with the extenssion
                    $filenameWithExt = $request->file($name)->getClientOriginalName();
                    //get just filname
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    //get just ext
                    $extension = $request->file($name)->getClientOriginalExtension();

                    //Filename to store
                    $filenameToStore = $filename.'_'.time().'.'.$extension;

                    //upload image
                    $path = $request->file($name)->move('public/images/',$filenameToStore);

                    $imagePath = "images/".$filenameToStore;
                    $updated_element = CardsElementsModel::where('id',$name)->update(['content' => $imagePath]);

                    if(!$updated_element)
                    {
                      abort(422);
                    } 
                    $element = CardsElementsModel::find($name);
                    array_push($data, $element);

                    }


                                                        
              }  
          }
        }
        
        foreach($_POST as $name => $value)
        {   
            

            if($name!="_token")
            {

              $element = CardsElementsModel::find($name);

              if(!$element)
              {
                abort(404);
              }

              if($element->type == "text")
              {
                  $updated_element = CardsElementsModel::where('id',$name)->update(['content' => $value]);
                  if(!$updated_element)
                  {
                    abort(422);
                  } 
                  $element = CardsElementsModel::find($name);
                  array_push($data, $element);



              }

            }
        } 

        return response()->json($data, 200);

    }

    public function cardDestroy(Request $request)
    {
        $id = $request->get('id');
        $card =   CardsModel::find($id);
        $cardCount = CardsModel::where('name', $card->name)->count();
        //dd($cardCount);
        if($cardCount > 1)
        {
          
          
          $elements = CardsElementsModel::where('card_id' , $id)->where('type' ,'img')->get();

          if(!$elements->isEmpty())
          {
            foreach ($elements as $element) {
              if($element->type == "img")
              {
                $file_pointer = public_path().'/'.$element->content;
                //dd($file_pointer);
                if(file_exists($file_pointer))
                {
                    
                  unlink($file_pointer);
                }
                else{
                  //abort(500);
                }           
              } 
            }
            
          }


          $del =   CardsModel::find($id)->delete();

          if($del)
          {
            return response()->json([
              'status' => 'success'
            ]);
          }
        }

    }

    public function cardCreate(Request $request)
    {
        $cardName = $request->get('cardName');

        try {
                $sampleCard = CardsModel::with('CardsElementsModel')->where('name', $cardName)->firstOrFail(); 
        } catch (Exception $e) {
          abort(422);
        }


        if($sampleCard->CardsElementsModel->isEmpty())
        {
          abort(422);
        }

        
        $inputFields ='<input type="hidden" name="cardName" value="'.$cardName.'">';
        foreach ($sampleCard->CardsElementsModel as $element){

            if($element->type=="text"){
               $inputFields =   $inputFields . 
               '<div class="input-group mb-3"><div class="input-group-prepend"><label for="'.$element->name.'" class="input-group-text" id="basic-addon1">'.$element->name.'</label></div><input id="'.$element->name.'" class="form-control" type="text" name="'.$element->name.'" autocomplete="off" aria-describedby="basic-addon1" value=""></div>';                 
           }elseif ($element->type=="img") {
            $inputFields =   $inputFields .
                '<div class="input-group mb-3"><input id="" class="mb-3" type="file"  name="'.$element->name.'" multiple="false" /></div>';

           }
 
     
        }

  
        return $inputFields;   

    }

    public function cardStore(Request $request)
    {
        $cardName = $request->post('cardName');
        $newCard = CardsModel::create(['name' => $cardName]);
        $cardId = $newCard->id;  

        foreach($_POST as $name => $value)
        {   
            if($name!="_token" && $name!='cardName')
            {

              $newCardElement = CardsElementsModel::create([ 
                  'card_id' => $cardId ,
                  'name' => $name ,
                  'content' => $value ,
                  'type' => 'text'
                ]);

            }
        }

        foreach($_FILES as $name => $value)
        {


            $filenameToStore="";
            $imagePath = "";
        
            if($request->hasFile($name)){
 
            //Get File Name with the extenssion
            $filenameWithExt = $request->file($name)->getClientOriginalName();
            //get just filname
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file($name)->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file($name)->move('public/images/',$filenameToStore);

            $imagePath = "images/".$filenameToStore;
            }


              $newCardElement = CardsElementsModel::create([ 
                  'card_id' => $cardId ,
                  'name' => $cardName ,
                  'content' => $imagePath ,
                  'type' => 'img'
                ]);    
        }


        $card = CardsElementsModel::where('card_id',$cardId)->get();
        $Path = "public/";
        if($cardName == "whatWeDo")
        {
          $frontcard = '                    <div class="col-lg-6" id="'.$cardId.'_card">
                       

                        <div class="team-member edit-section p-0">

                        <i class="fa fa-ellipsis-h edit2" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="right: 15px; top: 25px; color: black;"></i>    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                              <a class="dropdown-item pointer edit_card" data-cardId="'.$cardId.'">
                                    <i class="fa fa-edit text-success"></i> Edit</a>
                              <a class="dropdown-item pointer card_remove" data-cardId="'.$cardId.'">
                                    <i class="fa fa-trash text-danger"></i> Remove</a>
                            </div> 

                            <div class="team-image">
                                <img id="crd_'.$card[4]->id.'" class="" src="'.asset($Path.$card[4]->content).'">
                            </div>

                            <div class="team-desc">
                                <h3 id="crd_'.$card[0]->id.'">'.$card[0]->content.'</h3>
                                <p id="crd_'.$card[1]->id.'">'.$card[1]->content.'</p>
                                <div class="align-center">
                                    <a href="'.$card[3]->content.'" class="btn btn-sm" id="crd_'.$card[2]->id.'">'.$card[2]->content.'</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  '; 
 
 
 

        }
        elseif($cardName == "marketShare")
        {
          $frontcard = ' <div class="col-md-3 col-6 edit-section" id="'.$cardId.'_card">
                                <i class="fa fa-ellipsis-h edit2 text-white" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="right: 15px; top: 25px; color: black;"></i>    
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item pointer edit_card" data-cardId="'.$cardId.'">
                                        <i class="fa fa-edit text-success"></i> Edit</a>
                                <a class="dropdown-item pointer card_remove" data-cardId="'.$cardId.'">
                                        <i class="fa fa-trash text-danger"></i> Remove</a>
                                </div>                            
                                <div class="text-center">
                                <div class="icon"><img id="crd_'.$card[2]->id.'" width="60" src="'.asset($Path.$card[2]->content).'"></div>
                                <div class="counter text-white"> <span data-speed="500" data-refresh-interval="50" data-to="'.$card[0]->content.'" data-from="1000" data-seperator="true" id="crd_'.$card[0]->id.'">'.$card[0]->content.'</span> </div>
                                <div class="seperator seperator-small"></div>
                                <h4 class="text-white" id="crd_'.$card[1]->id.'">'.$card[1]->content.'</h4>
                                </div>
                            </div>
                          '; 
 
 
 

        }


        $response = [
            'success' => 1,
            'message' => 'activity added successfully',
            'cardName'=>$cardName,
            'newCardElements' => $card,
            'frontcard'=>$frontcard
        ];

        return response()->json($response, 200);

    }

    // ================ End Functions ================

}
