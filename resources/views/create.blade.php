@extends('layouts.app')

@section('content')
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

                    <form action="{{ route("Add-Center") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name of Sport Center</label>
                            <input type="text" class="form-control" id="name" name="name">

                        </div>
                        <div class="form-group">
                            <label for="description">Description of sport Center</label>
                            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="address">Address of Sport Center</label>
                            <input type="text" class="form-control" id="address" name="address">

                        </div>
                        <div class="form-group ">
                            <label for="image">Upload Sport Center Image</label>
                            <div class="dropzone" id="file-dropzone"></div>
                            <!-- <input type="file" class="form-control" id="image" name="image"> -->

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
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
        },
        removedfile: function(file) {
            var name = file.upload.filename;
            $.ajax({
                type: 'POST',
                url: "{{ route('image-delete') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name
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