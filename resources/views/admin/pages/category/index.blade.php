@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Category
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" onclick="toggleModal()"><i class="mdi mdi-bookmark-plus"></i> Add </button>

                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th class="text-center">Sub-Category</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        @if ($row->status == 0)
                                        <label class="badge badge-danger">Inactive</label>
                                        @else
                                        <label class="badge badge-success">Active</label>
                                        @endif
                                    </td>
                                    <td class="text-center viewBtn">

                                        <a href="{{ route('subcategories.show', $row->id) }}">View</a>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-evenly">
                                            <button class="btn btn-sm btn-warning" onclick="editCategory('{{ $row->id }}')">Edit</button>
                                            <a onclick="deleteCategory('{{ $row->id }}')" class="btn btn-danger btn-sm">Delete</a>
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



        <!-- Modal -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalTitle">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="toggleModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample" id="catAddForm">

                            @csrf
                            <input type="hidden" name="category_id" id="category_id" value="">

                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input type="text" class="form-control my-input" id="name" name="name" value="" placeholder="Name" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" id="statusBox" name="status" value="1"> Check
                                        for show in Header </label>
                                </div>

                            </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">

                        <button type="submit" class="btn btn-primary" id="addCategoryBtn"><i class="mdi mdi-file-check btn-icon-prepend"></i>Save</button>

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

        let catForm = $('#catAddForm');
        catForm.validate();

        catForm.submit((e) => {
            e.preventDefault();

            if (catForm.valid()) {

                let checkState = $("#statusBox").is(":checked") ? "1" : "0";
                let formData = new FormData(document.getElementById('catAddForm'));
                formData.append('status', checkState);

                $.ajax({
                    url: "{{ route('categories.store') }}",
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(result) {
                        if (result.status == 200) {
                            toastr.success(result.message);
                            toggleModal();
                            catForm[0].reset();
                            reloadWindow();
                        }

                        if (result.status == 403) {

                            toastr.success(result.message);
                        }
                    }
                });

            }
        });

    });


    function toggleModal() {
        $('#addCategoryModal').modal('toggle');

    }

    function deleteCategory(id) {
        Swal.fire({
            title: "Do you want to delete?",
            showDenyButton: true,
            confirmButtonText: "yes",
            denyButtonText: `No`
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('admin/subcategories') }}/" + id,
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

    function editCategory(id) {
        $.ajax({
            url: "{{ url('admin/categories') }}",
            method: 'Get',
            data: {
                id: id
            },

            success: function(result) {
                if (result.status == 200) {

                    $('#category_id').val(result.data.id);
                    $('#name').val(result.data.name);

                    if (result.data.status == 1) {
                        $('#statusBox').attr('checked', true);

                    } else {
                        $('#statusBox').attr('checked', false);

                    }
                    toggleModal();

                }

                if (result.status == 403) {
                    Swal.fire(result.message, "", "warning");
                }
            }
        });
    }
</script>
@endsection