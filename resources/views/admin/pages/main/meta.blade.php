@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span>  Meta 
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <!-- Button trigger modal -->
                    Meta Data 
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

                    <form class="forms-sample" id="reviewForm" method="post" action="{{ route('portfolios.store') }}" enctype="multipart/form-data">


                        @csrf
                        <div class="row">

                        
                        <div class="form-group " id="skillsDiv">
                            @if($data)
                            <label for="image">Skills *</label>
                            @foreach($data->skills as $skills)
                            <div class="row d-flex justify-between mt-4" id="skillsDiv_{{$skills->id }}">
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
                                <div class="col-md-10">
                                    <label for="image">Skills *</label>
                                    <input type="text" class="form-control my-input " id="skills" name="skills[]" multiple value="" required>
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

                    
                        <div class="form-group">
                            <label for="name">Description*</label>
                            <textarea name="description" id="description" class="form-control my-input" cols="30" rows="3" placeholder="Description">{{ ($data)?$data->description:'' }}</textarea>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">

                            <button type="submit" class="btn btn-primary" id="addReviewBtn"><i class="mdi mdi-file-check btn-icon-prepend"></i> Create</button>

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
                description: {
                    required: true
                },
                title: {
                    required: true
                },
                short_title: {
                    required: true
                },
                short_description: {
                    required: true
                },
                images: {
                    required: true
                }
            }
        });
    });




    function addMoreFeilds() {

        let id = document.getElementById('skillsDiv').children.length;
        let html = `<div class="row d-flex justify-between mt-4" id="skillsDiv_${id}">
                                <div class="col-md-10">
                                    <input type="text" class="form-control my-input " id="skills" name="skills[]" multiple value="" required>
                                </div>
                                <div class="col-md-2">
                                    <div class="">
                                        <button type="button" onclick="removeFeilds(${id})" class=" btn btn-dark btn-icon-text btn-sm"><i class="mdi mdi-bookmark-remove"></i> Remove</button>
                                    </div>
                                </div>

                            </div>`;

        $('#skillsDiv').append(html);
    }

    function removeFeilds(id) {
        $('#skillsDiv_' + id).remove();
    }
</script>
@endsection