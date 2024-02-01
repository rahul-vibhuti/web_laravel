@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> {{ $title }} Services
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('services.index') }}" class="btn btn-primary">View Services</a>
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
                    <form class="forms-sample" id="reviewForm" method="post" action="{{ route('services.store') }}" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="servicesId" id="servicesId" value="{{ ($data)?$data->id :'' }}">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name*</label>
                                    <input type="text" class="form-control my-input" id="name" name="name" value="{{ ($data)?$data->name:'' }}" placeholder="Service name" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title*</label>
                                    <input type="text" class="form-control my-input" id="title" name="title" value="{{ ($data)?$data->title:'' }}" placeholder="Title " autocomplete="off" required>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="name">Description*</label>
                            <textarea name="description" id="description" class="form-control my-input" cols="30" rows="3" placeholder="Description" required>{{ ($data)?$data->description:'' }}</textarea>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6  mt-2">
                                    @if ($data)
                                    <label for="image" class="imageLabel">Click here to change Image*</label>
                                    @else
                                    <label for="image">Feature Image*</label>
                                    @endif
                                    <input type="file" class="form-control my-input @if($data) d-none @endif" onchange="imagePreview('previewImage')" id="image" name="image" value="">
                                </div>

                                <div class="col-md-6 d-flex justify-content-center">
                                    @if($data)
                                    <img width="200px" class="img img-thumbnail mt-3" id="previewImage" height="100px" src="{{ asset($data->feature_image) }}" alt="">
                                    @endif
                                    <img width="200px" class="img img-thumbnail mt-3 d-none" id="previewImage" height="100px" src="" alt="">
                                </div>
                            </div>
                        </div>

                        @if(!$data)
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label for="image">Details Page Images (multiple)*</label>
                                    <input type="file" class="form-control my-input " id="images" name="images[]" multiple value="" required>
                                </div>

                            </div>
                        </div>
                        @endif

                        <div class="form-group " id="servicesDiv">
                            @if($data)
                            <label for="image">title *</label>
                            @foreach($data->skills as $skills)
                            <div class="row d-flex justify-between mt-4" id="servicesDiv_{{$skills->id }}">
                                <div class="col-md-10">
                                    <input type="text" class="form-control my-input " id="skills" name="skills[]" multiple value="{{ $skills->name }}" required>
                                </div>
                                <div class="col-md-2">
                                    <div class="">
                                        <button type="button" onclick="removeFeilds('{{ $skills->id }}')" class=" btn btn-dark btn-icon-text btn-sm"><i class="mdi mdi-bookmark-remove"></i> Remove</button>

                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @else
                            <div class="row d-flex justify-between">
                                <div class="col-md-5">
                                    <label for="titles">Title *</label>
                                    <input type="text" class="form-control my-input " id="titles" name="data[0][title]" multiple value="" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="descriptions">Description*</label>
                                    <textarea name="data[0][desc]" id="descriptions" class="form-control my-input" cols="30" rows="2" placeholder="Short description" required>{{ ($data)?$data->short_desc:'' }}</textarea>
                                </div>
                                <div class="col-md-2">
                                    <div class="mt-4">
                                        <button type="button" onclick="addMoreFeilds()" class=" btn btn-primary btn-icon-text"> <i class="mdi mdi-bookmark-plus"></i>More</button>
                                    </div>
                                </div>
                            </div>

                            @endif
                        </div>

                        @if($data)
                        <div class="col-md-2">
                            <div class="mt-4 mb-4">
                                <button type="button" onclick="addMoreFeilds()" class=" btn btn-primary btn-icon-text"> <i class="mdi mdi-bookmark-plus"></i>More</button>
                            </div>
                        </div>
                        @endif


                        <div class="modal-footer d-flex justify-content-center">

                            <button type="submit" class="btn btn-primary" id="addReviewBtn"><i class="mdi mdi-file-check btn-icon-prepend"></i> {{$title}}</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection


@section('script')
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
                name: {
                    required: true
                },
                title: {
                    required: true
                },
                titles: {
                    required: true
                },
                descriptions: {
                    required: true
                },
                images: {
                    required: true
                }
            }
        });
    });




    function addMoreFeilds() {

        let id = document.getElementById('servicesDiv').children.length;
        let html = `<div class="row d-flex justify-between mt-4" id="servicesDiv_${id}">
                                <div class="col-md-5">
                                    <label for="titles_${id}">Title *</label>
                                    <input type="text" class="form-control my-input " id="titles_${id}" name="data[${id}][title]" multiple value="" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="descriptions_${id}">Description*</label>
                                    <textarea name="data[${id}][desc]" id="descriptions_${id}" class="form-control my-input" cols="30" rows="2" placeholder="Short description" required>{{ ($data)?$data->short_desc:'' }}</textarea>
                                </div>
                                <div class="col-md-2 mt-4">
                                    <div class="">
                                        <button type="button" onclick="removeFeilds(${id})" class=" btn btn-dark btn-icon-text btn-sm"><i class="mdi mdi-bookmark-remove"></i> Remove</button>
                                    </div>
                                </div>
                            </div>`;

        $('#servicesDiv').append(html);
    }

    function removeFeilds(id) {
        $('#servicesDiv_' + id).remove();
    }
</script>
@endsection