@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Meta
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

                <div class="card-body">
                    <form class="forms-sample" id="metaForm" method="post" action="#" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="1">
                        <input type="hidden" name="title" value="metaPage">
                        @csrf

                        <h4>Social links</h4>
                        <hr class="w-25">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="skype">Skype*</label>
                                    <input type="text" class="form-control my-input" id="skype" name="skype" value="" placeholder="skype id" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gmail">Gmail *</label>
                                    <input type="text" class="form-control my-input" id="gmail" name="gmail" value="" placeholder="Gmail id" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="whatsapp">Whatsapp *</label>
                                    <input type="text" class="form-control my-input" id="whatsapp" name="whatsapp" value="" placeholder="Whatsapp" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="instagram">Instagram *</label>
                                    <input type="text" class="form-control my-input" id="instagram" name="instagram" value="" placeholder="Instagram" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="name"><strong>Main Title Home page* </strong></label>
                            <textarea name="description[{{ Config::get('constants.INDEX_PAGE_MAIN_TITLE') }}][]" class="form-control my-input description" cols="30" rows="3" placeholder="Description">
                            @isset($data[Config::get('constants.INDEX_PAGE_MAIN_TITLE')])
                            {{ $data[Config::get('constants.INDEX_PAGE_MAIN_TITLE')] }}
                            @endisset
                            </textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <strong><label for="name">Sub Description Home page*</label></strong>
                            <textarea name="description[{{ Config::get('constants.INDEX_PAGE_SUB_DESC') }}][]" class="form-control my-input description" cols="30" rows="3" placeholder="Description">
                            @isset($data[Config::get('constants.INDEX_PAGE_SUB_DESC')])
                            {{ $data[Config::get('constants.INDEX_PAGE_SUB_DESC')] }}
                            @endisset
                            </textarea>
                        </div>
                        {{-- <div class="form-group">
                            <label for="name">Description*</label>
                            <textarea name="description[]" class="form-control my-input description" cols="30" rows="1" placeholder="Description">{{ ($data)?$data->description:'' }}</textarea>
                </div> --}}

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
    tinymce.init({
        selector: 'textarea.description', // Replace this CSS selector to match the placeholder element for TinyMCE
    });
</script>
<script>
    $(document).ready(() => {
        $('.table').DataTable({
            "pagingType": "numbers"
        });


        $('#metaForm').submit((e) => {
            e.preventDefault();
            var myForm = document.getElementById('metaForm');
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
            });
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