@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Profile
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <!-- <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li> -->
            </ul>

            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
        </nav>
    </div>
    <div class="row">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Profile </h4>
                    <!-- <p class="card-description"> Basic form elements </p> -->
                    <form class="forms-sample" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">First Name*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="first_name" value="{{ $user->first_name }}" name="first_name" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Last Name*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="last_name" value="{{ $user->last_name }}" name="last_name" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email address*</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" value="" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="bio">Bio*</label>
                            <input type="text" class="form-control" id="bio" value="{{ $user->bio }}" name="bio" placeholder="Location">
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            
                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
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

        $('.file-upload-browse').on('click', function() {
            var file = $(this).parent().parent().parent().find('.file-upload-default');
            file.trigger('click');
        });
        $('.file-upload-default').on('change', function() {
            $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });
    });
</script>
@endsection