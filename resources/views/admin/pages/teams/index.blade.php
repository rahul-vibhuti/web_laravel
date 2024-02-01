@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> {{ $title}} Customers
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">

                    <!-- Button trigger modal -->

                    <a href="{{ route('our.team') }}" class="btn btn-primary">View Tems</a>

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
                    <form class="forms-sample" id="addTeamForm" method="post" action="{{ route('store.team') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="teamId" id="teamId" value="{{ ($data)?$data->id :'' }}">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input type="text" class="form-control my-input" id="name" name="name" value="{{ ($data)?$data->name:'' }}" placeholder="Employee Name" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role*</label>
                            <input type="text" class="form-control my-input" id="role" name="role" value="{{ ($data)?$data->role:'' }}" placeholder="Employee role" autocomplete="off" required>
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

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" id="addReviewBtn"><i class="mdi mdi-file-check btn-icon-prepend"></i>{{ $title}}</button>
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

        let catForm = $('#addTeamForm');
        catForm.validate({
            rules: {
                name: {
                    required: true
                },
                image: {
                    required: true
                },
                role: {
                    required: true
                }
            }
        });
    });
</script>
@endsection