@extends('frontend.layouts.main')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <style>
        .dropify-wrapper .dropify-message p {
            display: none;
        }
    </style>
@endsection
@section('main')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sell Phone</li>
        </ol>
    </nav>
    <div class="card shadow-lg pt-2 mb-5 bg-body-tertiary rounded">
        <div class="card-body">
            <form id="storeData" action="{{ route('sell_mobile') }}" method="post" class="row g-3 needs-validation"
                novalidate enctype="multipart/form-data">
                @csrf
                <div id="phone_details">
                    <h4 class=" mt-2 mb-2">Product Code: <strong class="text-success">{{ $product_code }}</strong></h4>
                    <input type="hidden" name="product_code" value="{{ $product_code }}" readonly>
                    <hr>
                    <div class="row">
                        <h5>Phone Information </h5>
                        <div class="col-md-3">
                            <strong for="validationCustom01" class="form-label">Model Name</strong>
                            <input type="text" name="model_name" class="form-control" id="validationCustom01"
                                value="" required>
                            <span class="text-danger custom-error-text" id="error_model_name"></span>

                        </div>
                        <div class="col-md-3">
                            <strong for="validationCustom02" class="form-label">Storage <code>(GB)</code></strong>
                            <input type="text" class="form-control" name="storage" id="validationCustom02" value=""
                                required>
                            <span class="text-danger custom-error-text" id="error_storage"></span>
                        </div>

                        <div class="col-md-3">
                            <strong for="validationCustom02" class="form-label">Battery percentage</strong>
                            <input type="text" class="form-control" name="battery_percenatge" id="validationCustom02"
                                value="" required>
                            <span class="text-danger custom-error-text" id="error_battery_percenatge"></span>

                        </div>
                        <div class="col-md-3">
                            <strong for="validationDefault04" class="form-label">Choose Mobile Condition</strong>
                            <select class="form-select" id="validationDefault04" name="mobile_condition" required>
                                <option selected value="">Choose...</option>
                                <option value="Good">Good:Minor Scratches, No Dents, No Cracks.</option>
                                <option value="Average">Average: Major Scratches, Small Dents, No Cracks.</option>
                                <option value="Below-Average">Below Average: Heavy Dents, Cracks, Discoloration</option>
                            </select>
                            <span class="text-danger custom-error-text" id="error_mobile_condition"></span>
                        </div>
                        <div class="col-md-12 m-2">
                            <strong for="validationCustomUsername" class="form-label">Warrenty-Left
                                <code>(Optional)</code></strong>
                            <textarea class="summernote" name="warrenty_left">{{ old('warrenty_left') }}</textarea>

                        </div>
                    </div>
                    <hr class="mt-4">
                    <h5>About Phone</h5>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body feature-group">
                                        <strong> Is your Device Working Properly</strong> <br>

                                        <input class="form-check-input" type="radio" name="working_properly"
                                            value="yes" id="working_properly1">
                                        <label class="form-check-label" for="working_properly1">
                                            Yes
                                        </label>
                                        <input class="form-check-input" type="radio" name="working_properly"
                                            value="no" id="working_properly2">
                                        <label class="form-check-label" for="working_properly2">
                                            No
                                        </label>
                                        <div class="ml-2 mt-2">
                                            <span class="text-danger custom-error-text" id="error_working_properly"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body feature-group">
                                        <strong> Is your Screen Original</strong> <br>
                                        <input class="form-check-input" type="radio" name="original_screen"
                                            value="yes" id="screen_original1">
                                        <label class="form-check-label" for="screen_original1">
                                            Yes
                                        </label>
                                        <input class="form-check-input" type="radio" name="original_screen"
                                            value="no" id="screen_original2">
                                        <label class="form-check-label" for="screen_original2">
                                            No
                                        </label>
                                        <div class="ml-2 mt-2">
                                            <span class="text-danger custom-error-text" id="error_original_screen"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body feature-group">
                                        <strong> Is your Phone UnOpened</strong> <br>
                                        <input class="form-check-input" type="radio" name="phone_unopened"
                                            value="yes" id="phone_unopened1">
                                        <label class="form-check-label" for="phone_unopened1">
                                            Yes
                                        </label>
                                        <input class="form-check-input" type="radio" name="phone_unopened"
                                            value="no" id="phone_unopened2">
                                        <label class="form-check-label" for="phone_unopened2">
                                            No
                                        </label>
                                        <div class="ml-2 mt-2">
                                            <span class="text-danger custom-error-text" id="error_phone_unopened"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body feature-group">
                                        <strong> Is your Phone Battery Original</strong> <br>
                                        <input class="form-check-input" type="radio" name="battery_original"
                                            value="yes" id="battery_original1">
                                        <label class="form-check-label" for="battery_original1">
                                            Yes
                                        </label>
                                        <input class="form-check-input" type="radio" name="battery_original"
                                            value="no" id="battery_original2">
                                        <label class="form-check-label" for="battery_original2">
                                            No
                                        </label>
                                        <div class="ml-2 mt-2">
                                            <span class="text-danger custom-error-text"
                                                id="error_battery_original"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body feature-group">
                                        <strong> Is Your Phone MDMS Registered</strong> <br>
                                        <input class="form-check-input" type="radio" name="mdms_registered"
                                            value="yes" id="mdms_registered1">
                                        <label class="form-check-label" for="mdms_registered1">
                                            Yes
                                        </label>
                                        <input class="form-check-input" type="radio" name="mdms_registered"
                                            value="no" id="mdms_registered2">
                                        <label class="form-check-label" for="mdms_registered2">
                                            No
                                        </label>
                                        <div class="ml-2 mt-2">
                                            <span class="text-danger custom-error-text" id="error_mdms_registered"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-4">
                    <div class="col-12">
                        <h5>About Phone Defect</h5>
                        <div class="col-md-12 mb-2">
                            <div class="card">
                                <div class="card-body feature-group">
                                    <strong> Is your Device Defected</strong> <br>
                                    <input class="form-check-input" type="radio" name="device_defect" value="yes"
                                        id="device_defect1">
                                    <label class="form-check-label" for="device_defect1">
                                        Yes
                                    </label>
                                    <input class="form-check-input" type="radio" name="device_defect" value="no"
                                        id="device_defect2">
                                    <label class="form-check-label" for="device_defect2">
                                        No
                                    </label>
                                    <div class="ml-2 mt-2">
                                        <span class="text-danger custom-error-text" id="error_device_defect"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="defect-data mb-3 d-none">
                            <strong for="defect_description" class="form-strong">Defect
                                Description</label><code>*</code><br>
                                <textarea class="summernote" name="defect_description">{{ old('defect_description') }}</textarea>
                                @error('defect_description')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <hr class="mt-4">
                    <h5>Upload Phone Images</h5>
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-3">
                            <strong for=""> Front part</strong>
                            <input type="file" name="front_part" class="dropify" id="input-file"
                                data-allowed-file-extensions="jpg jpeg png gif" />
                            <div class="ml-2 mt-2">
                                <span class="text-danger custom-error-text" id="error_front_part"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <strong for=""> Back part</strong>
                            <input type="file" name="back_part" class="dropify" id="input-file"
                                data-allowed-file-extensions="jpg jpeg png gif" />
                            <div class="ml-2 mt-2">
                                <span class="text-danger custom-error-text" id="error_back_part"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <strong for=""> With Battery Percentage</strong>
                            <input type="file" name="with_battery_percentage" class="dropify" id="input-file"
                                data-allowed-file-extensions="jpg jpeg png gif" />
                            <div class="ml-2 mt-2">
                                <span class="text-danger custom-error-text" id="error_with_battery_percentage"></span>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong for=""> With Box</strong>
                            <input type="file" name="with_box" class="dropify" id="input-file"
                                data-allowed-file-extensions="jpg jpeg png gif" />
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong for=""> With Warrenty</strong>
                            <input type="file" name="with_warrenty" class="dropify" id="input-file"
                                data-allowed-file-extensions="jpg jpeg png gif" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <strong for=""> With Model and Serial Number</strong>
                            <input type="file" name="with_model" class="dropify" id="input-file"
                                data-allowed-file-extensions="jpg jpeg png gif" />
                        </div>
                        <hr class="mt-4">
                    </div>
                </div>
                <div class="row" id="billing_details">
                    @include('frontend.pages.biiling_details')
                </div>
                <div class="col-12 mt-2 ">
                    <div class="spinner-border text-info float-end" role="status" id="spinner">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <button class="btn btn-primary float-end" type="submit" id="submit_btn">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dropify"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            'use strict';
            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'strikethrough']],
                    ['font', ['fontsize', 'color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['misc', ['undo', 'redo']]
                ],
                placeholder: 'Start typing here...',
            });
            $('#spinner').hide();
            $('#billing_details').hide();
            $('#submit_btn').prop('disabled', false);
            //Dropify
            var dropify = $('.dropify').dropify();
            $('.needs-validation').on('submit', function(event) {
                event.preventDefault();
                var form = $('#storeData');
                $('#spinner').show();
                $('#submit_btn').text('Please Wait ...');
                $('#submit_btn').prop('disabled', true);
                // $('#phone_details').hide();
                $('#billing_details').show();
                $('#submit_btn').text('Wait...');
                var formAction = $('#storeData').attr('action');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: formAction,
                    type: 'POST',
                    headers: {
                        'X-CSRF-Token': csrfToken
                    },
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#submit_btn').prop('disabled', true);
                        var success = response.success;
                        toastr.success(response.success);
                        setTimeout(function() {
                            window.location.href = '/';
                        }, 3000);
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        console.log(errors);
                        $('.custom-error-text').text('');

                        $.each(errors, function(key, value) {
                            // Display errors in specific spans
                            $('#' + 'error_' + key).text(value[0]);
                        });
                        $('#submit_btn').prop('disabled', false);
                        $('#submit_btn').text('Submit');
                        $('#spinner').hide();
                    }

                });

            });

            $('input[name="device_defect"]').change(function() {
                // Check if the selected radio button is checked
                if ($(this).prop('checked')) {
                    // Get the value of the selected radio button
                    var value = $(this).val();
                    if (value == 'yes') {
                        $('.defect-data').addClass('d-block').removeClass('d-none');
                    } else {
                        $('.defect-data').addClass('d-none').removeClass('d-block');
                        $('textarea[name="defect_description"]').summernote('code', '');
                    }
                }
            });
        });
    </script>
@endsection
