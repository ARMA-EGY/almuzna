
            


        @foreach ($photos as $photo)
                        
            <div class="col-md-3 edit-section p-3 parent">
                <i class="fas fa-times-circle edit2 text-danger slider-del" data-id="{{$photo->id}}"></i>
                <img class="rounded" src="{{asset('storage/'.$photo->image)}}" width="100%">
            </div>
            
        @endforeach
