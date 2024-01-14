@extends('backend.layouts.main')
@section('style')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
@endsection
@section('main')
@include('backend.pages.product.modal.create')
    <div class="container">
        <a href="{{ route('admin.product.index') }}" class="float-right btn btn-dark mb-2">Back</a>
        <button class="float-right btn btn-primary mb-2" id="reload">Reload</button>
        <button type="button" class="float-end btn btn-success mb-2" id="accept">Accept</button>
        <div class="row" id="phone_details">
            <h4 class=" mt-2 mb-2">Product Code: <strong class="text-success">{{ $data_lists->product_code }}</strong></h4>
            <hr>
            <div class="row mt-2 mb-3">
                <h4>Billing Details Information </h4>
                <div class="col-md-6">
                    <strong for="validationCustom01" class="form-label">Your Name</strong>
                    <input type="text" name="name" class="form-control" id="validationCustom01"
                        value="{{ $data_lists->detail->name }}" readonly>
                    <div class="invalid-feedback" id="name-error"></div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>

                </div>
                <div class="col-md-6">
                    <strong for="validationCustom02" class="form-label">You Phone / Whats App Number </strong>
                    <input type="tel" class="form-control" name="phone"
                        id="validationCustom02"value="{{ $data_lists->detail->phone }}" readonly>
                    <div class="invalid-feedback" id="phone-error"></div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>


                <div class="col-md-6">
                    <strong for="validationDefault04" class="form-label">Choose Your Province</strong>
                    <select class="form-select" id="validationDefault04" name="province" readonly>
                        <option disabled value="">Choose...</option>
                        <option value="Koshi Province" selected>Koshi Province</option>
                        <option value="Madhesh  Province" disabled>Madhesh Province</option>
                        <option value="Bagmati  Province" disabled>Bagmati Province</option>
                        <option value="Gandaki  Province" disabled>Gandaki Province</option>
                        <option value="Lumbini  Province" disabled>Lumbini Province</option>
                        <option value="Karnali  Province" disabled>Karnali Province</option>
                        <option value="Sudurpaschim Province" disabled>Sudurpaschim Province</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid state.
                    </div>
                </div>
                <div class="col-md-6">
                    <strong for="validationCustom03" class="form-label">City</strong>
                    <input type="text" class="form-control" name="city" id="validationCustom03"
                        value="{{ $data_lists->detail->city }}" readonly>
                    <div class="invalid-feedback" id="city-error"></div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>
            <hr>
            <h5>Phone Information </h5>
            <div class="col-md-3">
                <strong for="validationCustom01" class="form-label">Model Name</strong>
                <input type="text" name="model_name" class="form-control" id="validationCustom01"
                    value="{{ $data_lists->model }}" readonly>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-3">
                <strong for="validationCustom02" class="form-label">Storage <code>(GB)</code></strong>
                <input type="text" class="form-control" name="storage" id="validationCustom02"
                    value="{{ $data_lists->storage }}" readonly>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-3">
                <strong for="validationCustomUsername" class="form-label">Warrenty-Left
                    <code>(Optional)</code></strong>
                <div class="input-group ">
                    <input type="date" class="form-control" name="warrenty_left" id="validationCustomUsername"
                        aria-describedby="inputGroupPrepend" value="{{ $data_lists->warenty_left ?? '' }}" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <strong for="validationCustom02" class="form-label">Battery percentage</strong>
                <input type="text" class="form-control" name="battery_percenatge"
                    value="{{ $data_lists->battery_percentage }}" id="validationCustom02" readonly>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-6">
                <strong for="validationDefault04" class="form-label">Choose Mobile Condition</strong>
                <select class="form-select" id="validationDefault04" name="mobile_condition" readonly>

                    <option value="Good" {{ $data_lists->mobile_condition == 'Good' ? 'selected' : 'disabled' }}>
                        Good:Minor Scratches, No Dents, No Cracks.</option>
                    <option value="Average" {{ $data_lists->mobile_condition == 'Average' ? 'selected' : 'disabled' }}>
                        Average: Major Scratches, Small Dents, No Cracks.</option>
                    <option value="Below-Average"
                        {{ $data_lists->mobile_condition == 'Below-Average' ? 'selected' : 'disabled' }}>Below Average:
                        Heavy Dents, Cracks, Discoloration</option>
                </select>
            </div>
            <hr class="mt-4">
            <h5>About Phone</h5>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <div class="card">
                            <div class="card-body feature-group">
                                <strong> Is your Device Working Properly</strong> <br>

                                <input class="form-check-input" type="radio" name="working_properly" value="yes"
                                    id="working_properly1" {{ $data_lists->working_properly = 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="working_properly1">
                                    Yes
                                </label>
                                <input class="form-check-input" type="radio" name="working_properly" value="no"
                                    id="working_properly2" {{ $data_lists->working_properly = 'no' ? 'checked' : '' }}>
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
                                <input class="form-check-input" type="radio" name="original_screen" value="yes"
                                    id="screen_original1" {{ $data_lists->original_screen = 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="screen_original1">
                                    Yes
                                </label>
                                <input class="form-check-input" type="radio" name="original_screen" value="no"
                                    id="screen_original2" {{ $data_lists->original_screen = 'no' ? 'checked' : '' }}>
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
                                <input class="form-check-input" type="radio" name="phone_unopened" value="yes"
                                    id="phone_unopened1" {{ $data_lists->phone_unopened = 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="phone_unopened1">
                                    Yes
                                </label>
                                <input class="form-check-input" type="radio" name="phone_unopened" value="no"
                                    id="phone_unopened2" {{ $data_lists->phone_unopened = 'yes' ? 'checked' : '' }}>
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
                                <input class="form-check-input" type="radio" name="battery_original" value="yes"
                                    id="battery_original1" {{ $data_lists->battery_original = 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="battery_original1">
                                    Yes
                                </label>
                                <input class="form-check-input" type="radio" name="battery_original" value="no"
                                    id="battery_original2" {{ $data_lists->battery_original = 'no' ? 'checked' : '' }}>
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
                                <input class="form-check-input" type="radio" name="mdms_registered" value="yes"
                                    id="mdms_registered1" {{ $data_lists->mdms_registered = 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="mdms_registered1">
                                    Yes
                                </label>
                                <input class="form-check-input" type="radio" name="mdms_registered" value="no"
                                    id="mdms_registered2" {{ $data_lists->mdms_registered = 'no' ? 'checked' : '' }}>
                                <label class="form-check-label" for="mdms_registered2">
                                    No
                                </label>
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
                                id="device_defect1" {{ $data_lists->device_defect = 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="device_defect1">
                                Yes
                            </label>
                            <input class="form-check-input" type="radio" name="device_defect" value="no"
                                id="device_defect2" {{ $data_lists->device_defect = 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="device_defect2">
                                No
                            </label>
                        </div>
                    </div>
                </div>
                @if ($data_lists->description)
                    <div class="defect-data mb-3">
                        <strong for="defect_description" class="form-strong">Defect
                            Description</label><code>*</code><br>
                            <textarea class="summernote" name="defect_description">{{ $data_lists->description }}</textarea>
                            @error('defect_description')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                    </div>
                @endif
            </div>
            <hr class="mt-4">
            <h5>Uploaded Phone Images</h5>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <strong for=""> Front part</strong>
                    <a href="{{ asset($data_lists->product_image->front_part) }}" target="_blank"
                        rel="noopener noreferrer"> <img src="{{ asset($data_lists->product_image->front_part) }}"
                            alt="Front Part Image" class="img-fluid"></a>
                </div>
                <div class="col-md-3 mb-3">
                    <strong for=""> Back part</strong>
                    <a href="{{ asset($data_lists->product_image->back_part) }}" target="_blank"
                        rel="noopener noreferrer"> <img src="{{ asset($data_lists->product_image->back_part) }}"
                            alt="Front Part Image" class="img-fluid"></a>
                </div>
                <div class="col-md-3 mb-3">
                    <strong for=""> With Box</strong>
                    <a href="{{ asset($data_lists->product_image->with_box) }}" target="_blank"
                        rel="noopener noreferrer"> <img src="{{ asset($data_lists->product_image->with_box) }}"
                            alt="Front Part Image" class="img-fluid"></a>
                </div>
                <div class="col-md-3 mb-3">
                    <strong for=""> With Battery Percentage</strong>
                    <a href="{{ asset($data_lists->product_image->with_battery_percentage) }}" target="_blank"
                        rel="noopener noreferrer"> <img
                            src="{{ asset($data_lists->product_image->with_battery_percentage) }}" alt="Front Part Image"
                            class="img-fluid"></a>

                </div>
                <div class="col-md-3 mb-3">
                    <strong for=""> With Warrenty</strong>
                    <a href="{{ asset($data_lists->product_image->with_warrenty) }}" target="_blank"
                        rel="noopener noreferrer"> <img src="{{ asset($data_lists->product_image->with_warrenty) }}"
                            alt="Front Part Image" class="img-fluid"></a>

                </div>
                <div class="col-md-4 mb-3">
                    <strong for=""> With Model and Serial Number</strong>
                    <a href="{{ asset($data_lists->product_image->with_model) }}" target="_blank"
                        rel="noopener noreferrer"> <img src="{{ asset($data_lists->product_image->with_model) }}"
                            alt="Front Part Image" class="img-fluid"></a>
                </div>
                <hr class="mt-4">
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/dropify"></script>

    <script>
        $(document).ready(function() {
            //Summernote
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

            $('#reload').on('click', function() {
                location.reload();
            });
            function resetModal() {
                $('#staticBackdrop').modal('show');
                $("#accept_form")[0].reset();
                $('#modal_title').text('Set Price For Product');
            }

            $('#accept').on('click', function(){
                $('#staticBackdrop').modal('show');
                resetModal();
            });

            $('#modal_close, .btn-close').on('click', function() {
                $('#staticBackdrop').modal('hide');
                resetModal();
            })

        });
    </script>
@endsection
