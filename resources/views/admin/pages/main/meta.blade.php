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

                        <section id="banner_section">
                            <div class="row d-flex justify-content-center text-center">
                                <h4>For Home page Banner section</h4>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Happy Clients* </label>
                                        <input type="text" class="form-control my-input" id="" name="description[{{ Config::get('constants.CLIENTS') }}][]" value="@isset($data[Config::get('constants.CLIENTS')]) {{ $data[Config::get('constants.CLIENTS')] }}  @endisset" placeholder="Total Clients " autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Total Projects *</label>
                                        <input type="text" class="form-control my-input" name="description[{{ Config::get('constants.PROJECTS') }}][]" value="@isset($data[Config::get('constants.PROJECTS')])  {{ $data[Config::get('constants.PROJECTS')] }}  @endisset" placeholder="Total projects" autocomplete="off" required>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Revenue *</label>
                                        <input type="text" class="form-control my-input" id="Revenue" name="description[{{ Config::get('constants.REVENUE') }}][]" value="@isset($data[Config::get('constants.REVENUE')])   {{ $data[Config::get('constants.REVENUE')] }}  @endisset" placeholder="$Revenue" autocomplete="off" required>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for=""><strong>Main Title Home page* </strong></label>
                                <textarea name="description[{{ Config::get('constants.INDEX_PAGE_MAIN_TITLE') }}][]" class="form-control my-input description" cols="30" rows="3" placeholder="Description">
                            @isset($data[Config::get('constants.INDEX_PAGE_MAIN_TITLE')])
                            {{ $data[Config::get('constants.INDEX_PAGE_MAIN_TITLE')] }}
                            @endisset
                            </textarea>
                            </div>
                        </section>

                        <section id="sub_section">
                            <div class="row d-flex justify-content-center text-center">
                                <h4>For Second Section Home Page</h4>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Years Of Experience*</label>
                                        <input type="text" class="form-control my-input" name="description[{{ Config::get('constants.EXPERIENCE') }}][]" value="@isset($data[Config::get('constants.EXPERIENCE')])   {{ $data[Config::get('constants.EXPERIENCE')] }}  @endisset" placeholder="Years Of Experience " autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Talented Squad *</label>
                                        <input type="text" class="form-control my-input" id="" name="description[{{ Config::get('constants.TEAM') }}][]" value="@isset($data[Config::get('constants.TEAM')])  {{ $data[Config::get('constants.TEAM')] }}  @endisset" placeholder="Talented Squad" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Apps Developed *</label>
                                        <input type="text" class="form-control my-input" id="" name="description[{{ Config::get('constants.APP_DELIVERED') }}][]" value="@isset($data[Config::get('constants.APP_DELIVERED')])   {{ $data[Config::get('constants.APP_DELIVERED')] }}  @endisset" placeholder="Apps Developed" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Countries Served *</label>
                                        <input type="text" class="form-control my-input" id="" name="description[{{ Config::get('constants.COUNTRY_SERVED') }}][]" value="@isset($data[Config::get('constants.COUNTRY_SERVED')])   {{ $data[Config::get('constants.COUNTRY_SERVED')] }}  @endisset" placeholder="Countries Served" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for=""><strong>Sub Title Home page* </strong></label>
                                <textarea name="description[{{ Config::get('constants.INDEX_PAGE_SUB_TITLE') }}][]" class="form-control my-input description" cols="30" rows="3" placeholder="Description">
                            @isset($data[Config::get('constants.INDEX_PAGE_SUB_TITLE')])
                            {{ $data[Config::get('constants.INDEX_PAGE_SUB_TITLE')] }}
                            @endisset
                            </textarea>
                            </div>
                            <div class="form-group">
                                <strong><label for="">Sub Description Home page*</label></strong>
                                <textarea name="description[{{ Config::get('constants.INDEX_PAGE_SUB_DESC') }}][]" class="form-control my-input description" cols="30" rows="3" placeholder="Description">
                            @isset($data[Config::get('constants.INDEX_PAGE_SUB_DESC')])
                            {{ $data[Config::get('constants.INDEX_PAGE_SUB_DESC')] }}
                            @endisset
                            </textarea>
                            </div>
                        </section>
                        <hr>

                        <section id="query_section">
                            <div class="row d-flex justify-content-center text-center">
                                <h4>For Home page Query section</h4>
                            </div>
                            <hr>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="skype">Skype*</label>
                                        <input type="text" class="form-control my-input" id="skype" name="description[{{ Config::get('constants.SKYPE') }}][]" value="@isset($data[Config::get('constants.SKYPE')])   {{ $data[Config::get('constants.SKYPE')] }}  @endisset" placeholder="skype id" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gmail">Gmail *</label>
                                        <input type="text" class="form-control my-input" id="gmail" name="description[{{ Config::get('constants.GMAIL') }}][]" value="@isset($data[Config::get('constants.GMAIL')])  {{ $data[Config::get('constants.GMAIL')] }}  @endisset" placeholder="Gmail id" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="whatsapp">Whatsapp *</label>
                                        <input type="text" class="form-control my-input" id="whatsapp" name="description[{{ Config::get('constants.WHATSAPP') }}][]" value="@isset($data[Config::get('constants.WHATSAPP')])   {{ $data[Config::get('constants.WHATSAPP')] }}  @endisset" placeholder="Whatsapp" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instagram">Instagram *</label>
                                        <input type="text" class="form-control my-input" id="instagram" name="description[{{ Config::get('constants.INSTAGRAM') }}][]" value="@isset($data[Config::get('constants.INSTAGRAM')])   {{ $data[Config::get('constants.INSTAGRAM')] }}  @endisset" placeholder="Instagram" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Title For Query Section *</label>
                                        <input type="text" class="form-control my-input" name="description[{{ Config::get('constants.QUERY_TITLE') }}][]" value="@isset($data[Config::get('constants.QUERY_TITLE')])   {{ $data[Config::get('constants.QUERY_TITLE')] }}  @endisset" placeholder="Title For Query Section" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for=""><strong>Description* </strong></label>
                                    <textarea name="description[{{ Config::get('constants.QUERY_DESC') }}][]" class="form-control my-input description" cols="30" rows="3" placeholder="Description">
                            @isset($data[Config::get('constants.QUERY_DESC')])
                            {{ $data[Config::get('constants.QUERY_DESC')] }}
                            @endisset
                            </textarea>
                                </div>
                            </div>
                        </section>

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