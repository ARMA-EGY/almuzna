 @extends('admin.pages.layouts.includes')

@section('content')

        <div id="slider" class="inspiro-slider slider-fullscreen dots-creative cover" data-fade="true">

            <!-- Slide 1 -->
            @foreach ($sliders as $slider)
            <div class="slide kenburns" data-bg-image="{{ asset('storage/'.$slider->image) }}">
                <div class="bg-overlay"></div>
                <div class="container">
                    <div class="slide-captions text-center text-light edit-section">
                        <!-- Captions -->
                        <i class="fa fa-edit edit" data-componentId="{{$header_components[0]->id}}" data-edit="header" data-target="header_data"></i>
                        <p class="mb-0" id="elt_{{$header_components[0]->ElementsModel[0]->id}}">{{$header_components[0]->ElementsModel[0]->content}}</p>
                        <h3 class="font-weight-bold mb-4" id="elt_{{$header_components[0]->ElementsModel[1]->id}}">{{$header_components[0]->ElementsModel[1]->content}}</h3>
                        <div><a href="#welcome" class="btn scroll-to" id="elt_{{$header_components[0]->ElementsModel[2]->id}}">{{$header_components[0]->ElementsModel[2]->content}}</a></div>
                        </span>
                        <!-- end: Captions -->
                    </div>
                </div>

            </div>
            @endforeach

						<label class="update-slider get_slider_modal">
                                <i class="fa fa-camera"></i>
                                Update Photos
                        </label>
        </div>
        <!--end: Inspiro Slider -->

        <!-- WHAT WE DO -->
        <section class="services">
            <div class="container">
                <div class="heading-text heading-section text-center edit-section">
                    <i class="fa fa-edit edit" data-componentId="{{$whatWeDo_components[0]->id}}" data-edit="header" data-target="header_data"></i>  
                    <h2 id="elt_{{$whatWeDo_components[0]->ElementsModel[0]->id}}">{{$whatWeDo_components[0]->ElementsModel[0]->content}}</h2>
                    <p id="elt_{{$whatWeDo_components[0]->ElementsModel[1]->id}}">{{$whatWeDo_components[0]->ElementsModel[1]->content}}</p>
                </div>
                

                <div class="p-4 text-right" style="position: relative;">
                    <button class="btn add_card" data-cardName="whatWeDo">
                        <i class="fa fa-plus"></i> 
                    </button>
                </div>

                <div class="row justify-content-center team-members team-members-left team-members-shadow m-b-40">

                @foreach($whatWeDo_cards as $card)


                    <div class="col-lg-6" id="{{$card->id}}_card">
                       

                        <div class="team-member edit-section p-0">

                        <i class="fa fa-ellipsis-h edit2" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="right: 15px; top: 25px; color: black;"></i>    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                              <a class="dropdown-item pointer edit_card" data-cardId="{{$card->id}}">
                                    <i class="fa fa-edit text-success"></i> Edit</a>
                              <a class="dropdown-item pointer card_remove" data-cardId="{{$card->id}}">
                                    <i class="fa fa-trash text-danger"></i> Remove</a>
                            </div> 

                            <div class="team-image">
                                <img id="crd_{{$card->CardsElementsModel[4]->id}}" class="lazy" src="{{asset('images/src-load.png')}}" data-src="{{asset($card->CardsElementsModel[4]->content)}}">
                            </div>

                            <div class="team-desc">
                                <h3 id="crd_{{$card->CardsElementsModel[0]->id}}">{{$card->CardsElementsModel[0]->content}}</h3>
                                <p id="crd_{{$card->CardsElementsModel[1]->id}}">{{$card->CardsElementsModel[1]->content}}</p>
                                <div class="align-center">
                                    <a href="{{$card->CardsElementsModel[3]->content}}" class="btn btn-sm" id="crd_{{$card->CardsElementsModel[2]->id}}">{{$card->CardsElementsModel[2]->content}}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                 @endforeach 



                </div>
            </div>
        </section>
        <!-- END WHAT WE DO -->

        <!-- LATEST PRODUCT -->
        <section class="background-grey">
            <div class="container">
                <div class="heading-text heading-section text-center edit-section">
                    <i class="fa fa-edit edit" data-componentId="{{$latest_products[0]->id}}" data-edit="header" data-target="header_data"></i> 
                    <h2 id="elt_{{$latest_products[0]->ElementsModel[0]->id}}">{{$latest_products[0]->ElementsModel[0]->content}}</h2>
                    <p id="{{$latest_products[0]->ElementsModel[1]->id}}">{{$latest_products[0]->ElementsModel[1]->content}}</p>
                </div>
                <div class="row team-members team-members-circle m-b-40">
                    
                    <div class="content col-md-12 edit-section">
                    <i class="fa fa-edit edit product-check"></i> 
                        
                        <div class="carousel team-members team-members-shadow" data-items="4">

                            <div class="team-member bg-white">
                                <div class="team-image">
                                    <img class="lazy" src="{{asset('images/src-load.png')}}" data-src="{{asset('images/pos1.png')}}">
                                </div>
                                <div class="team-desc">
                                    <h3>D210</h3>
                                    <p>The most happiest time of the day!. Praesent tristique hendrerit ex ut laoreet.
                                    </p>
                                    <div class="align-center">
                                        <a class="btn btn-xs btn-slide btn-light" href="#">
                                            <i class="fa fa-eye"></i>
                                            <span>View</span></a>
                                        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
                                            <i class="fas fa-file-pdf"></i>
                                            <span>PDF</span></a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="team-member bg-white">
                                <div class="team-image">
                                    <img class="lazy" src="{{asset('images/src-load.png')}}" data-src="{{asset('images/pos2.png')}}">
                                </div>
                                <div class="team-desc">
                                    <h3>A80</h3>
                                    <p>The most happiest time of the day!. Praesent tristique hendrerit ex ut laoreet.
                                    </p>
                                    <div class="align-center">
                                        <a class="btn btn-xs btn-slide btn-light" href="#">
                                            <i class="fa fa-eye"></i>
                                            <span>View</span></a>
                                        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
                                            <i class="fas fa-file-pdf"></i>
                                            <span>PDF</span></a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="team-member bg-white">
                                <div class="team-image">
                                    <img class="lazy" src="{{asset('images/src-load.png')}}" data-src="{{asset('images/pos3.png')}}">
                                </div>
                                <div class="team-desc">
                                    <h3>IM300</h3>
                                    <p>The most happiest time of the day!. Praesent tristique hendrerit ex ut laoreet.
                                    </p>
                                    <div class="align-center">
                                        <a class="btn btn-xs btn-slide btn-light" href="#">
                                            <i class="fa fa-eye"></i>
                                            <span>View</span></a>
                                        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
                                            <i class="fas fa-file-pdf"></i>
                                            <span>PDF</span></a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="team-member bg-white">
                                <div class="team-image">
                                    <img class="lazy" src="{{asset('images/src-load.png')}}" data-src="{{asset('images/pos4.png')}}">
                                </div>
                                <div class="team-desc">
                                    <h3>E600</h3>
                                    <p>The most happiest time of the day!. Praesent tristique hendrerit ex ut laoreet.
                                    </p>
                                    <div class="align-center">
                                        <a class="btn btn-xs btn-slide btn-light" href="#">
                                            <i class="fa fa-eye"></i>
                                            <span>View</span></a>
                                        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
                                            <i class="fas fa-file-pdf"></i>
                                            <span>PDF</span></a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="team-member bg-white">
                                <div class="team-image">
                                    <img class="lazy" src="{{asset('images/src-load.png')}}" data-src="{{asset('images/pos5.png')}}">
                                </div>
                                <div class="team-desc">
                                    <h3>Q80</h3>
                                    <p>The most happiest time of the day!. Praesent tristique hendrerit ex ut laoreet.
                                    </p>
                                    <div class="align-center">
                                        <a class="btn btn-xs btn-slide btn-light" href="#">
                                            <i class="fa fa-eye"></i>
                                            <span>View</span></a>
                                        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
                                            <i class="fas fa-file-pdf"></i>
                                            <span>PDF</span></a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="team-member bg-white">
                                <div class="team-image">
                                    <img class="lazy" src="{{asset('images/src-load.png')}}" data-src="{{asset('images/pos6.png')}}">
                                </div>
                                <div class="team-desc">
                                    <h3>D220</h3>
                                    <p>The most happiest time of the day!. Praesent tristique hendrerit ex ut laoreet.
                                    </p>
                                    <div class="align-center">
                                        <a class="btn btn-xs btn-slide btn-light" href="#">
                                            <i class="fa fa-eye"></i>
                                            <span>View</span></a>
                                        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
                                            <i class="fas fa-file-pdf"></i>
                                            <span>PDF</span></a>
                                    </div>
                                </div>
                            </div>

                           
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- end: LATEST PRODUCT -->

        <!-- WELCOME -->
        <section id="welcome" class="p-b-0">
            <div class="container">

                <div class="heading-text heading-section text-center m-b-40 edit-section" data-animate="fadeInUp">
                 <i class="fa fa-edit edit" data-componentId="{{$meetExperience_components[0]->id}}" data-edit="header" data-target="header_data"></i>                   
                    <h2 id="elt_{{$meetExperience_components[0]->ElementsModel[0]->id}}">{{$meetExperience_components[0]->ElementsModel[0]->content}}</h2>
                </div>
                <div class="row" data-animate="fadeInUp">
                    <div class="col-lg-7 m-auto order-2-mob edit-section">
                        <i class="fa fa-edit edit" data-componentId="{{$meetExperience_components[1]->id}}" data-edit="header" data-target="header_data"></i>  
                        <span class="lead" id="elt_{{$meetExperience_components[1]->ElementsModel[0]->id}}">{{$meetExperience_components[1]->ElementsModel[0]->content}}</span>
                        <div class="text-center my-4"><a href="#" class="btn scroll-to" id="elt_{{$meetExperience_components[1]->ElementsModel[1]->id}}">{{$meetExperience_components[1]->ElementsModel[1]->content}}</a></div>
                    </div>
                    <div class="col-lg-4 m-auto">
                        <img class="img-fluid lazy" src="" data-src="{{asset($meetExperience_components[2]->ElementsModel[0]->content)}}" alt="" id="elt_{{$meetExperience_components[2]->ElementsModel[0]->id}}">
                             <form class="update_component_form"  enctype="multipart/form-data">
                                    @csrf
                                <label for="upload_photom" class="update-photo about-img">
                                <i class="fa fa-camera"></i>
                                </label>
                                <input class="hidden-input change_photo" id="upload_photom" type="file" name="{{$meetExperience_components[2]->ElementsModel[0]->id}}">
                            </form> 
                    </div>
                </div>
            </div>
        </section>
        <!-- end: WELCOME -->

        <!-- CHARTS -->
        <section class="background-colored">
            <div id="particles-dots" class="particles"></div>
            <div class="container">
                    <div class="heading-text heading-section text-center edit-section">
                        <i class="fa fa-edit edit" data-componentId="{{$marketShare_components[0]->id}}" data-edit="header" data-target="header_data"></i>                        
                        <h2 class="white-dash text-white" id="elt_{{$marketShare_components[0]->ElementsModel[0]->id}}">{{$marketShare_components[0]->ElementsModel[0]->content}}</h2>
                        <p class="text-white" id="elt_{{$marketShare_components[0]->ElementsModel[1]->id}}">{{$marketShare_components[0]->ElementsModel[1]->content}}</p>
                    </div>
      

                <div class="p-4 text-right" style="position: relative;">
                    <button class="btn btn-inverse add_card" data-cardName="marketShare">
                        <i class="fa fa-plus"></i> 
                    </button>
                </div>

                    <div class="row">

                        @foreach($marketShare_cards as $card)
                            <div class="col-md-3 col-6 edit-section" id="{{$card->id}}_card">
                                <i class="fa fa-ellipsis-h edit2 text-white" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="right: 15px; top: 25px; color: black;"></i>    
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item pointer edit_card" data-cardId="{{$card->id}}">
                                        <i class="fa fa-edit text-success"></i> Edit</a>
                                <a class="dropdown-item pointer card_remove" data-cardId="{{$card->id}}">
                                        <i class="fa fa-trash text-danger"></i> Remove</a>
                                </div>                            
                                <div class="text-center">
                                <div class="icon"><img id="crd_{{$card->CardsElementsModel[2]->id}}" width="60" src="{{asset($card->CardsElementsModel[2]->content)}}"></div>
                                <div class="counter text-white"> <span data-speed="500" data-refresh-interval="50" data-to="{{$card->CardsElementsModel[0]->content}}" data-from="1000" data-seperator="true" id="crd_{{$card->CardsElementsModel[0]->id}}">{{$card->CardsElementsModel[0]->content}}</span> </div>
                                <div class="seperator seperator-small"></div>
                                <h4 class="text-white" id="crd_{{$card->CardsElementsModel[1]->id}}">{{$card->CardsElementsModel[1]->content}}</h4>
                                </div>
                            </div>
                        @endforeach 
                      
                    </div>

                <div class="text-center mt-4"><a href="#" class="btn btn-inverse">EXPLORE MORE!</a></div>

            </div>
        </section>
        <!-- end: CHARTS -->

        <!-- CLIENTS -->
        <section class="p-t-60">
            <div class="container">
                <div class="heading-text heading-section text-center edit-section">
                    <i class="fa fa-edit edit" data-componentId="{{$Clients_components[0]->id}}" data-edit="header" data-target="header_data"></i>
                    <h2 id="elt_{{$Clients_components[0]->ElementsModel[0]->id}}">{{$Clients_components[0]->ElementsModel[0]->content}}</h2>
                    <span class="lead" id="elt_{{$Clients_components[0]->ElementsModel[1]->id}}">{{$Clients_components[0]->ElementsModel[1]->content}}</span>
                </div>
                
                <div class="edit-section">
                    <i class="fa fa-edit edit client-check"></i>
                    <div class="carousel client-logos" data-items="6" data-items-sm="4" data-items-xs="3" data-items-xxs="2" data-margin="20" data-arrows="false" data-autoplay="true" data-autoplay="3000" data-loop="true">
                        @foreach($clients as $client)
                            <div>
                                <a href="#"><img alt="" class="lazy" data-src="{{asset($client->image)}}"> </a>
                            </div>
                        @endforeach                    
                    </div>
                </div>
                <div class="text-center my-4 pt-5"><a href="#" class="btn scroll-to">Awards & Achievement</a></div>

            </div>
        </section>
        <!-- end: CLIENTS -->

        <!-- BLOG -->
        <section class="content background-grey mb-0">
            <div class="container">
                <div class="heading-text heading-section">
                    <h2>OUR BLOG</h2>
                    <span class="lead">The most happiest time of the day!. Morbi sagittis, sem quis lacinia faucibus,
                        orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id
                        molestie ipsum volutpat quis. A true story, that never been told!. Fusce id mi diam, non ornare
                        orci. Pellentesque ipsum erat, facilisis ut venenatis eu, sodales vel dolor. </span>
                </div>
                <div id="blog" class="grid-layout post-3-columns" data-item="post-item">
                    
                    @foreach ($blogs as $blog)
                        <!-- Post item-->
                        <div class="post-item border">
                            <div class="post-item-wrap">
                                <div class="post-image">
                                    <a href="/blog/{{ $blog->url}}">
                                        <div class="blog-img" style="background-image:url({{ asset('storage/'.$blog->image) }})"> </div>
                                    </a>
                                    <span class="post-meta-category"><a href="/blog/{{ $blog->url}}">{{  date('j M, Y', strtotime($blog->created_at))  }}</a></span>
                                </div>
                                <div class="post-item-description">
                                    <h2><a href="/blog/{{ $blog->url}}">{{ $blog->title}}
                                        </a></h2>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 100, '...') }}</p>
                                    <a href="/blog/{{ $blog->url}}" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end: Post item-->
                    @endforeach
                    
                </div>
            </div>
        </section>





<div id="client_check_modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      <div class="tabs">
                    
                    


        </div>

    </div>
  </div>
</div>


<!-- Sliders Modal -->	

<div id="slider_modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update Photos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              
              <div class="modal-body" id="slider_body">
                  
              </div>
          
      </div>
    </div>
  </div>
 
@endsection        


@section('script')

    <!-- Partical js base file  -->
    <script src="{{ asset('plugins/particles/particles.js') }}" type="text/javascript"></script>

    <!--Particles-->
    <script src="{{ asset('plugins/particles/particles-dots.js') }}" type="text/javascript"></script>



    <script >

        	
        $(document).on('click', '.get_slider_modal', function()
            {
                $('#slider_body').html('<img class="d-flex m-auto" src="/images/load.gif" width="50">');
                $('#slider_modal').modal('show');
            
                $.ajax({
                    url: 		"{{route('get-slider')}}",
                    method: 	'POST',
                    dataType: 	'text',
                    data:		{ 
                                    get_sliders : 1
                                }	,
                    success : function(response)
                            {
                                $('#slider_body').html(response);
                            }
                });

            });

            // ==========================  Remove Item ==========================

            $(document).on('click', '.slider-del', function() 
            {
                
            var item 	= $(this).attr('data-id');

                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => 
            {
                if (result.isConfirmed) 
                {
                Swal.fire(
                    'Deleted!',
                    'Item has been deleted.',
                    'success'
                )

                $.ajax({
                        url: 		"{{route('remove-slider')}}",
                        method: 	'POST',
                        dataType: 	'json',
                        data:		{id: item}	
                });

                $(this).parents('.parent').remove();
                }
            })

            });


        $(document).ready(function(){
    
            $(document).on('click','.select_client',function(){
    
                var clientId = $(this).attr("data-clientId");
                console.log(clientId);
                
                    $.ajax({
                        url:'client/check',
                        method:'POST',
                        dataType:'text',
                        data:{clientId:clientId,
                        "_token": "{{ csrf_token() }}"  } ,
                        success:function(data)
                        {
    
                        }
                    })
            });
    
            $(document).on('click','.select_product',function(){

                var productId = $(this).attr("data-productid");
                
                    $.ajax({
                        url:'product/select',
                        method:'POST',
                        dataType:'text',
                        data:{productId:productId,
                        "_token": "{{ csrf_token() }}"  } ,
                        success:function(data)
                        {

                        }
                    })
            });
        });
     </script>

@endsection

