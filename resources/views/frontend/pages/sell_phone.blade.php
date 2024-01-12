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
    <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="card-body">
            <form action="{{ route('sell_mobile') }}" method="post" class="row g-3 needs-validation" novalidate
                enctype="multipart/form-data">
                @csrf
                <div class="row" id="phone_details">
                    <h4>Phone Information </h4>
                    <div class="col-md-3">
                        <strong for="validationCustom01" class="form-label">Model Name</strong>
                        <input type="text" name="model_name" class="form-control" id="validationCustom01" value=""
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-3">
                        <strong for="validationCustom02" class="form-label">Storage</strong>
                        <input type="text" class="form-control" name="storage" id="validationCustom02" value=""
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-3">
                        <strong for="validationCustomUsername" class="form-label">Warrenty-Left</strong>
                        <div class="input-group has-validation">
                            <input type="date" class="form-control" name="warrenty-left" id="validationCustomUsername"
                                aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                Please enter Warrenty-left.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <strong for="validationCustom02" class="form-label">Battery percentage</strong>
                        <input type="text" class="form-control" name="battery_percenatge" id="validationCustom02"
                            value="" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6">
                        <strong for="validationDefault04" class="form-label">Choose Mobile Condition</strong>
                        <select class="form-select" id="validationDefault04" name="mobile_condition" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="Good">Good-Minor Scratches, No Dents, No Cracks.</option>
                            <option value="Average">Average-Major Scratches, Small Dents, No Cracks.</option>
                            <option value="Below-Average">Below Average -Heavy Dents, Cracks, Discoloration</option>
                        </select>
                    </div>
                    <hr>
                    <h4>About Phone</h4>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body feature-group">
                                        <strong> Is your Device Working Properly</strong> <br>

                                        <input class="form-check-input" type="radio" name="working_properly"
                                            value="on" id="working_properly1">
                                        <label class="form-check-label" for="working_properly1">
                                            Yes
                                        </label>
                                        <input class="form-check-input" type="radio" name="working_properly"
                                            value="off" id="working_properly2">
                                        <label class="form-check-label" for="working_properly2">
                                            No
                                        </label>


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body feature-group">
                                        <strong> Is your Screen Original</strong> <br>
                                        <input class="form-check-input" type="radio" name="screen_original" value="on"
                                            id="screen_original1">
                                        <label class="form-check-label" for="screen_original1">
                                            Yes
                                        </label>
                                        <input class="form-check-input" type="radio" name="screen_original"
                                            value="off" id="screen_original2">
                                        <label class="form-check-label" for="screen_original2">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body feature-group">
                                        <strong> Is your Phone UnOpened</strong> <br>
                                        <input class="form-check-input" type="radio" name="phone_unopened"
                                            value="on" id="phone_unopened1">
                                        <label class="form-check-label" for="phone_unopened1">
                                            Yes
                                        </label>
                                        <input class="form-check-input" type="radio" name="phone_unopened"
                                            value="off" id="phone_unopened2">
                                        <label class="form-check-label" for="phone_unopened2">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body feature-group">
                                        <strong> Is your Phone Battery Original</strong> <br>
                                        <input class="form-check-input" type="radio" name="battery_original"
                                            value="on" id="battery_original1">
                                        <label class="form-check-label" for="battery_original1">
                                            Yes
                                        </label>
                                        <input class="form-check-input" type="radio" name="battery_original"
                                            value="off" id="battery_original2">
                                        <label class="form-check-label" for="battery_original2">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="card">
                                    <div class="card-body feature-group">
                                        <strong> Is Your Phone MDMS Registered</strong> <br>
                                        <input class="form-check-input" type="radio" name="mdms_registered"
                                            value="on" id="mdms_registered1">
                                        <label class="form-check-label" for="mdms_registered1">
                                            Yes
                                        </label>
                                        <input class="form-check-input" type="radio" name="mdms_registered"
                                            value="off" id="mdms_registered2">
                                        <label class="form-check-label" for="mdms_registered2">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Upload Phone Images</h4>
                    <div class="col-md-3 mb-3">
                        <strong for=""> Front part</strong>
                        <input type="file" name="front_part" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong for=""> Back part</strong>
                        <input type="file" name="back_part" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong for=""> With Box</strong>
                        <input type="file" name="phone_with_box" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong for=""> With Battery Percentage</strong>
                        <input type="file" name="with_battery_percentage" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong for=""> With Warrenty</strong>
                        <input type="file" name="with_warrenty" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong for=""> With Model and Serial Number</strong>
                        <input type="file" name="with_model" class="dropify" id="input-file"
                            data-allowed-file-extensions="jpg jpeg png gif" />
                    </div>
                    <hr>
                    <div class="col-12">
                        <h4>About Phone Defect</h4>
                        <div class="col-md-12 mb-2">
                            <div class="card">
                                <div class="card-body feature-group">
                                    <strong> Is your Device Defected</strong> <br>
                                    <input class="form-check-input" type="radio" name="device_defect" value="on"
                                        id="device_defect1">
                                    <label class="form-check-label" for="device_defect1">
                                        Yes
                                    </label>
                                    <input class="form-check-input" type="radio" name="device_defect" value="off"
                                        id="device_defect2">
                                    <label class="form-check-label" for="device_defect2">
                                        No
                                    </label>
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
                    <div class="col-12 mt-2">
                        <button class="btn btn-primary float-end" type="submit">Next</button>
                    </div>
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

            //Dropify
            var dropify = $('.dropify').dropify();
            $('.needs-validation').on('submit', function(event) {
                var form = $(this);

                if (!form[0].checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.addClass('was-validated');
                var isValid = true;

                // Reset styles before re-validating
                $('.feature-group').removeClass('border-danger');
                $('input[type="radio"]').removeClass('is-invalid');

                // Loop through each feature group
                $('.feature-group').each(function() {
                    var featureGroup = $(this);
                    var radioButtons = featureGroup.find('input[type="radio"]');

                    // Check if at least one radio button is checked in the current feature group
                    if (radioButtons.filter(':checked').length === 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Please select an option for ' + featureGroup.find(
                                    'strong')
                                .text()
                                .trim(),
                        });
                        isValid = false;
                        featureGroup.addClass('border-danger');
                        radioButtons.addClass('is-invalid');
                        return false;
                    }
                });
                if (isValid) {
                    $('.dropify').each(function() {
                        var fileInput = $(this);
                        var file = fileInput[0].files[0];
                        if (!file) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Insert Image in ' + fileInput.attr('name')
                            });
                            isValid = false;
                            return false;
                        }
                    });
                }

                if (!isValid) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                if (isValid) {
                    event.preventDefault();
                    var formAction = form.attr('action');
                    var csrfToken = form.find('input[name="_token"]').val();
                    $.ajax({
                        url: formAction,
                        type: 'POST',
                        data: form.serialize(),
                        headers: {
                            'X-CSRF-Token': csrfToken
                        },
                        success: function(response) {
                            // Handle success response
                            console.log(response);
                        },
                        error: function(error) {
                            // Handle error response
                            console.error(error);
                        }
                    });
                }
            });

            $('input[name="device_defect"]').change(function() {
                // Check if the selected radio button is checked
                if ($(this).prop('checked')) {
                    // Get the value of the selected radio button
                    var value = $(this).val();
                    if (value == 'on') {
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
