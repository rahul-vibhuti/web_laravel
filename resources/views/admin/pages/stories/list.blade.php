@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Success Stories
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('stories.create') }}" class="btn btn-primary"><i class="mdi mdi-bookmark-plus"></i>Add</a>
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
                                    <th>Project Name</th>
                                    <th>Client Name</th>
                                    <th>Challanges</th>
                                    <th>Issues</th>
                                    <th>Tasks</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($data as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->project_name }}</td>
                                    <td>{{ $row->client_name }}</td>
                                    <td>{{ $row->challanges }}</td>
                                    <td>{{ $row->issues }}</td>
                                    <td>{{ $row->tasks }}</td>
                                    <td>
                                        <div class="d-flex justify-content-evenly">

                                            <a href="{{ route('stories.edit',$row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <a onclick="deletePortfolio('{{ $row->id }}')" class="btn btn-danger btn-sm">Delete</a>
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
    $(document).ready(() => {
        $('.table').DataTable({
            "pagingType": "simple"
        });
    });


    function deletePortfolio(id) {
        Swal.fire({
            title: "Do you want to delete?",
            showDenyButton: true,
            confirmButtonText: "yes",
            denyButtonText: `No`
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('admin/portfolios') }}/" + id,
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