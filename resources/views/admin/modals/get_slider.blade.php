
		<div class="container mb-3">
			<div class="row" style="justify-content: flex-end;">

				<form class="upload_photo_form upload_form" action="{{route('update-slider')}}" method="POST" enctype="multipart/form-data">

					<label for="upload_banner" class="btn btn-primary" ><i class="fa fa-plus"></i> Add Photo</label>

					<input class="hidden-input change_photo" id="upload_banner" type="file" name="photo[]" multiple>

				</form>
				
			</div>
		</div>
	
		<div class="row" id="slider_photos">
	
            @foreach ($photos as $photo)
                
                <div class="col-md-3 edit-section p-3 parent">
                    <i class="fas fa-times-circle edit2 text-danger slider-del" data-id="{{$photo->id}}"></i>
                    <img class="rounded" src="{{asset('storage/'.$photo->image)}}" width="100%">
                </div>
            @endforeach
		

        </div>


		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary reload">Save</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>



<script type="text/javascript">


    $(function() {
         $(document).ready(function()
         {
            var bar = $('.bar');
            var percent = $('.percent');
	        var status  = $('.status');

      $('.upload_photo_form').ajaxForm({
        beforeSend: function() {
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
            $('#upload_modal').modal('show');
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        success : function(response)
        {
            $('#upload_modal').modal('hide');
            $('#slider_photos').html(response);
        }
      });
   }); 
 });
</script>