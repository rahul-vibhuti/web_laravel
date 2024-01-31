@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Our Customers
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">

                    <!-- Button trigger modal -->

                    <a href="{{ route('clients.create') }}" class="btn btn-primary"><i class="mdi mdi-bookmark-plus"></i>Add</a>

                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Client Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($data as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td> <img src="{{ asset($row->image) }}" alt="" srcset=""></td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-evenly">

                                            <a href="{{ route('clients.edit',$row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <a onclick="deleteClient('{{ $row->id }}')" class="btn btn-danger btn-sm">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h4>Meta data for Our Clients section</h4>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" id="descriptionForm" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Our Happy Clients Description*</label>
                            <input type="hidden" name="title" value="{{Config::get('constants.CLIENT_TITLE')}}">
                            <textarea name="description" id="description" cols="30" rows="10">{{ ($metaData)?$metaData->value:'' }}</textarea>
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

<script>
    $(document).ready(() => {
        $('.table').DataTable({
            "pagingType": "simple"
        });


        $('#descriptionForm').submit((e) => {
            e.preventDefault();
            var myForm = document.getElementById('descriptionForm');
            let formData = new FormData(myForm);
            $.ajax({
                'url': '{{ route("update.meta.desc") }}',
                'method': 'POST',
                'processData': false,
                'contentType': false,
                'data': formData,
                success: function(result) {
                    if (result.status == 200) {
                        Swal.fire(result.message, "", "success");
                    }

                    if (result.status == 403) {
                        Swal.fire(result.message, "", "warning");
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            })
        })
    });


    function deleteClient(id) {
        Swal.fire({
            title: "Do you want to delete?",
            showDenyButton: true,
            confirmButtonText: "yes",
            denyButtonText: `No`
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ route('clients.destroy') }}",
                    method: 'DELETE',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(result) {
                        if (result.status == 200) {
                            Swal.fire(result.message, "", "success");
                            reloadWindow();
                        }

                        if (result.status == 403) {
                            Swal.fire(result.message, "", "warning");
                        }
                    }
                });
            }
        });
    }
</script>
@endsection