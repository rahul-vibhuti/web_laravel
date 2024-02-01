@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Teams
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">

                    <!-- Button trigger modal -->

                    <a href="{{ route('create.team') }}" class="btn btn-primary"><i class="mdi mdi-bookmark-plus"></i>Add</a>

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
                                    <th>User Name</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($data as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td> <img src="{{ asset($row->image) }}" alt="" srcset=""></td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->role }}</td>
                                    <td>
                                        @if ($row->status == 0)
                                        <label class="badge badge-danger">Inactive</label>
                                        @else
                                        <label class="badge badge-success">Active</label>
                                        @endif
                                    </td>


                                    <td>
                                        <div class="d-flex justify-content-evenly">

                                            <a href="{{ route('edit.team',$row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <a onclick="deleteTeam('{{ $row->id }}')" class="btn btn-danger btn-sm">Delete</a>
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
</div>


@endsection


@section('script')
<script>
    function deleteTeam(id) {
        Swal.fire({
            title: "Do you want to delete?",
            showDenyButton: true,
            confirmButtonText: "yes",
            denyButtonText: `No`
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ route('team.destroy') }}",
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