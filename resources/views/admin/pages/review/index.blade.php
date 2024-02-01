@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Reviews
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">

                    <!-- Button trigger modal -->

                    <a href="{{ route('reviews.index') }}" class="btn btn-primary">View Reviews</a>

                </li>
            </ul>
        </nav>
    </div>
    <div class="row">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                @if($errors->any())
                <div class="alert alert-danger">
                    <p><strong>Opps Something went wrong</strong></p>

                    @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                    @endforeach

                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif

                <div class="card-body">

                    <form class="forms-sample" id="reviewForm" method="post" action="{{ route('reviews.store') }}" enctype="multipart/form-data">


                        @csrf
                        <input type="hidden" name="review_id" id="review_id" value="{{ ($data)?$data->id :'' }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rating">Rating*</label>
                                    <input type="number" min="1" max="5" class="form-control my-input" id="rating" name="rating" value="{{ ($data)?$data->rating:'' }}" placeholder="Rating" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="name">User Name*</label>
                                    <input type="text" class="form-control my-input" id="name" name="name" value="{{ ($data)?$data->user_name:'' }}" placeholder="Review By User Name" autocomplete="off" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="title">Title*</label>
                            <input type="text" class="form-control my-input" id="title" name="title" value="{{ ($data)?$data->title:'' }}" placeholder="Title" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Description*</label>
                            <textarea name="description" id="description" class="form-control my-input" cols="30" rows="2" placeholder="Description">{{ ($data)?$data->description:'' }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6  mt-5">
                                    @if ($data)
                                    <label for="image" class="imageLabel">Click here to change Image*</label>
                                    @else
                                    <label for="image">Image*</label>
                                    @endif
                                    <input type="file" class="form-control my-input @if($data) d-none @endif" onchange="imagePreview('previewImage')" id="image" name="image" value="">
                                </div>

                                <div class="col-md-6 d-flex justify-content-center">
                                    @if($data)
                                    <img width="250px" class="img img-thumbnail mt-3" id="previewImage" height="150px" src="{{ asset($data->image) }}" alt="">
                                    @endif
                                    <img width="250px" class="img img-thumbnail mt-3 d-none" id="previewImage" height="150px" src="" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="hidden" name="status" value="{{ ($data)?$data->status:0 }}" />

                                    <input type="checkbox" class="form-check-input" id="statusBox" name="status" value="1" {{ ($data?($data->status == 1 ?'checked':'' ):'checked') }}>Check for Active </label>

                            </div>


                        </div>


                        <div class="modal-footer d-flex justify-content-center">

                            <button type="submit" class="btn btn-primary" id="addReviewBtn"><i class="mdi mdi-file-check btn-icon-prepend"></i>Save</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection


@section('script')
<script src="https://cdn.tiny.cloud/1/8vdkxxio5n3q076mx5nq2xgtwqo4pzx76v4xtlj1k1c3emye/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#description', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
        menubar: 'file edit view insert format tools table',
        toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",

    });
</script>
<script>
    $(document).ready(() => {
        $('.table').DataTable({
            "pagingType": "numbers"
        });

        let catForm = $('#reviewForm');
        catForm.validate({
            rules: {
                description: {
                    required: true
                },
                image: {
                    required: true
                },
                description: {
                    required: true
                },
                title: {
                    required: true
                },
            }
        });
    });
</script>
@endsection