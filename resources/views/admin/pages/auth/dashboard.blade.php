@extends('admin.layouts.admin_main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard
        </h3>
        {{-- <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav> --}}
    </div>
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Weekly Sales <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">$ 15,0000</h2>
                    <h6 class="card-text">Increased by 60%</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Weekly Orders <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">45,6334</h2>
                    <h6 class="card-text">Decreased by 10%</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">95,5741</h2>
                    <h6 class="card-text">Increased by 5%</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Project Status</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Name </th>
                                    <th> Due Date </th>
                                    <th> Progress </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td> Herman Beck </td>
                                    <td> May 15, 2015 </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td> Messsy Adam </td>
                                    <td> Jul 01, 2015 </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 3 </td>
                                    <td> John Richards </td>
                                    <td> Apr 12, 2015 </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 4 </td>
                                    <td> Peter Meggik </td>
                                    <td> May 15, 2015 </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 5 </td>
                                    <td> Edward </td>
                                    <td> May 03, 2015 </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 5 </td>
                                    <td> Ronald </td>
                                    <td> Jun 05, 2015 </td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
         <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-white">Todo</h4>
                    <div class="add-items d-flex">
                        <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?" id="todoInput">
                        <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn" id="add-task">Add</button>
                    </div>
                    <div class="list-wrapper">
                        <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                            @forelse ($data as $row)
                            <li class="{{ $row->is_completed == 1 ? 'completed' : '' }}">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox" data-id="{{ $row->id }} " {{ $row->is_completed == 1 ? 'checked' : '' }}>
                                        {{ $row->description }} </label>
                                </div>
                                <i class="remove mdi mdi-close-circle-outline" data-id="{{ $row->id }} "></i>
                            </li>


                            @empty
                            @endforelse

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    (function($) {
        'use strict';
        $(function() {
            var todoListItem = $('.todo-list');
            var todoListInput = $('.todo-list-input');

            $('.todo-list-add-btn').on("click", function(event) {
                event.preventDefault();

                var item = $('#todoInput').val();

                if (item) {

                    $.ajax({
                        url: `{{ route('store.todo') }}`,
                        method: 'POST',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'item': item
                        },
                        success: function(result) {
                            if (result.status == 200) {

                                todoListItem.append(
                                    "<li><div class='form-check'><label class='form-check-label'><input class='checkbox' type='checkbox' data-id=" + result.data.id + "/>" +
                                    item +
                                    "<i class='input-helper'></i></label></div><i class='remove mdi mdi-close-circle-outline' data-id=" + result.data.id + "></i></li>"
                                );
                                todoListInput.val("");
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                });
                            }
                        }
                    });
                } else {
                    todoListInput.addClass('is-invalid');
                }

            });

            todoListInput.on('focus', function() {
                todoListInput.removeClass('is-invalid');
            });


            todoListItem.on('change', '.checkbox', function() {
                let status = '';

                if ($(this).attr('checked')) {
                    $(this).removeAttr('checked');
                    status = 0;
                } else {
                    $(this).attr('checked', 'checked');
                    status = 1;
                }

                $(this).closest("li").toggleClass('completed');

                $.ajax({
                    url: "{{ route('update.todo') }}",
                    method: 'POST',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': $(this).attr('data-id'),
                        'status': status
                    },
                    success: function(result) {

                    }
                });

            });

            todoListItem.on('click', '.remove', function() {
                $(this).parent().remove();
                $.ajax({
                    url: "{{ route('remove.todo') }}",
                    method: 'POST',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': $(this).attr('data-id')
                    },
                    success: function(result) {

                    }
                });
            });

        });
    })(jQuery);
</script>
@endsection