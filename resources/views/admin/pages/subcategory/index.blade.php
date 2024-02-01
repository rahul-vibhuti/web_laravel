@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Sub Category
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" onclick="toggleModal()"><i class="mdi mdi-bookmark-plus"></i>
                        Add
                    </button>

                </li>
            </ul>
        </nav>
    </div>
    <div class="row">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive">
                            <thead>
                                <tr class="table-heading">
                                    <th>ID</th>
                                    <th>Sub-Category Name</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->category->name }}</td>
                                    <td>
                                        @if ($row->status == 0)
                                        <label class="badge badge-danger">Inactive</label>
                                        @else
                                        <label class="badge badge-success">Active</label>
                                        @endif
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
        <div class="modal fade" id="addSubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addSubCategoryModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSubCategoryModalTitle">Add Sub-category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="toggleModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample" id="subCatAddForm">
                            @csrf

                            <input type="hidden" name="subcategory_id" id="subcategory_id" value="">
                            <div class="form-group">
                                <label for="category_id">Sub category*</label>
                                <select name="category_id" id="category_id" class="form-control my-input">
                                    @foreach ($categories as $row )
                                    <option value="{{ $row->id }}" {{ ($category == $row->id )? 'selected':'' }}> {{$row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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

        let subCatForm = $('#subCatAddForm');
        subCatForm.validate();

        subCatForm.submit((e) => {
            e.preventDefault();

            if (subCatForm.valid()) {

                let checkState = $("#statusBox").is(":checked") ? "1" : "0";

                let formData = new FormData(document.getElementById('subCatAddForm'));
                formData.append('status', checkState);

                $.ajax({
                    url: "{{ route('subcategories.store') }}",
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(result) {
                        if (result.status == 200) {
                            toastr.success(result.message);
                            toggleModal();
                            subCatForm[0].reset();
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
        $('#addSubCategoryModal').modal('toggle');

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
                        _token: '{{ csrf_token() }}',
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
            url: "{{ url('admin/subcategories') }}",
            method: 'Get',
            data: {
                id: id
            },

            success: function(result) {
                if (result.status == 200) {

                    $('#subcategory_id').val(result.data.id);
                    $('#name').val(result.data.name);
                    $('#category_id').val(result.data.category_id);

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