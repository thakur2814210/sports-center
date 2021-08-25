@extends('layouts.app')

@section('content')
<style>
    .dz-image img {
        width: 100%;
        height: 100%;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add a Sports Center</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name of Sport Center</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $center->name }}">

                        </div>
                        <div class="form-group">
                            <label for="description">Description of sport Center</label>
                            <textarea class="form-control" id="description" rows="3" name="description">{{ $center->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="address">Address of Sport Center</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $center->address }}">

                        </div>
                        <div class="form-group">
                            <label for="image">Upload Sport Center Image</label>
                            <div class="dropzone" id="file-dropzone"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>

    Dropzone.options.fileDropzone = {
        url: "{{ route('image-upload') }}",
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        maxFilesize: 8,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },

        init: function() {
            var myDropzone = this;
            // Create the mock file:
            $.ajax({
                type: 'POST',
                url: "{{ route('image-fetch') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    center_id: "{{$center->id}}",
                },
                success: function(data) {
                    for (let index = 0; index < data.length; index++) {
                        var mockFile = {
                            name: data[index].name,
                        };

                        // Call the default addedfile event handler
                        myDropzone.emit("addedfile", mockFile);

                        // And optionally show the thumbnail of the file:
                        myDropzone.emit("thumbnail", mockFile, "{{asset('storage/uploads')}}"+'/'+data[index].name);
                        myDropzone.emit("complete", mockFile);
                        myDropzone.files.push(mockFile);
                    }
                },
                error: function(e) {
                    console.log(e); 
                }
            });
            
        },
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
        },
        removedfile: function(file) {
            var name = file.name;
            $.ajax({
                type: 'POST',
                url: "{{ route('image-delete') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name,
                    type : 'update'
                },
                success: function(data) {

                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }
            });
            var fileRef;
            return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response) {
            console.log(file)
            console.log(response.success)

            $('form').append('<input type="hidden" name="document[]" value="' + response.success + '">')

        },
    }
</script>
@stop