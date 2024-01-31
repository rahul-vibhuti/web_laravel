@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> {{ $title }} Story
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('stories.index') }}" class="btn btn-primary">View stories</a>

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

                    <form class="forms-sample" id="storyForm" method="post" action="{{ route('stories.store') }}" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="storyId" id="storyId" value="{{ ($data)?$data->id :'' }}">
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="project_name">Project Name*</label>
                                    <input type="text" class="form-control my-input" id="project_name" name="project_name" value="{{ ($data)?$data->project_name:'' }}" placeholder="Porject  Name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="client_name">Client Name*</label>
                                    <input type="text" class="form-control my-input" id="client_name" name="client_name" value="{{ ($data)?$data->client_name:'' }}" placeholder="Client Name" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="challanges">Challanges *</label>
                                    <input type="number" class="form-control my-input" id="challanges" name="challanges" value="{{ ($data)?$data->challanges:'' }}" placeholder="Number of Challanges" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="issues">Issues *</label>
                                    <input type="number" class="form-control my-input" id="issues" name="issues" value="{{ ($data)?$data->issues:'' }}" placeholder="Number of Issues" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="tasks">Tasks *</label>
                                    <input type="number" class="form-control my-input" id="tasks" name="tasks" value="{{ ($data)?$data->tasks:'' }}" placeholder="number of tasks" autocomplete="off" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="feedback">Feedback*</label>
                            <textarea name="feedback" id="feedback" class="form-control my-input" cols="30" rows="2" placeholder="Feedback or description">{{ ($data)?$data->feedback:'' }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="form-check">


                            </div>
                        </div>


                        <div class="modal-footer d-flex justify-content-center">

                            <button type="submit" class="btn btn-primary" id="addReviewBtn"><i class="mdi mdi-file-check btn-icon-prepend"></i>{{ $title }}</button>

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

        let catForm = $('#storyForm');
        catForm.validate({
            rules: {
                challanges: {
                    required: true
                },
                client_name: {
                    required: true
                },
                project_name: {
                    required: true
                },
                issues: {
                    required: true
                },
                tasks: {
                    required: true
                },
                feedback: {
                    required: true
                },
            }
        });
    });
</script>
@endsection