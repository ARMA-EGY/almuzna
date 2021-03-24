

<div class="modal-content">
    <div class="modal-header bg-blue">
        <h4 class="modal-title text-white"><i class="fas fa-share-alt"></i> SEO Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>

    <div class="modal-body">	
        <form class="seo_form" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label >Title</label>
                <input type="text" name="title" class="form-control" placeholder="Page Title" value="{{ isset($seo->title) ? $seo->title : '' }}">
            </div>

            <div class="form-group">
                <label >Description</label>
                <textarea type="text" name="description" class="@error('description') is-invalid @enderror form-control note-editor2" placeholder="Page Description">{{ isset($seo->description ) ? $seo->description : ''  }}</textarea>
            </div>

            <div class="form-group">
                <label >Keywords</label>
                <textarea type="text" name="keywords" class="@error('keywords') is-invalid @enderror form-control" placeholder="Page Keywords">{{ isset($seo->keywords) ? $seo->keywords : ''  }}</textarea>
            </div>

            <div class="form-group">
                <label >Canonical</label>
                <input type="text" name="canonical" class="form-control" placeholder="Page Canonical" value="{{ isset($seo->canonical) ? $seo->canonical : ''  }}">
            </div>
        
            @if (isset($seo->image))
                <div class="form-group">
                    <label>Image</label>
                    <img src="{{ asset('storage/'.$seo->image) }}" class="d-flex m-auto" alt="" width="75%">
                </div>
            @endif

            <div class="form-group">
                <label>Change Image</label>
                <input type="file" name="image" class="@error('image') is-invalid @enderror form-control form-control-sm" >
            </div>

            <input type="hidden" name="page_token" value="{{$page_token}}">

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary submit">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>



<script>
    tinymce.init({
        selector:'textarea.note-editor2',
        toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | formatselect',
    });
</script>