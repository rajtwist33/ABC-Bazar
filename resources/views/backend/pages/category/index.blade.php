@extends('backend.layouts.main')
@section('style')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
@endsection
@section('main')
    @include('backend.pages.category.modal.create')
    <div class="container">
        <button type="button" class="float-right btn btn-success mb-2" id="category_btn">Add</button>
        <table class="table data-table">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th width="105px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dropify"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.category.index') }}",
                columns: [{
                        "className": "text-center",
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        "className": "text-center",
                        data: 'image',
                        name: 'image'
                    },
                    {
                        "className": "text-center",
                        data: 'title',
                        name: 'title'
                    },
                    {
                        "className": "text-center",
                        data: 'description',
                        name: 'description'
                    },

                    {
                        "className": "text-center",
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });



        $(document).ready(function() {
            //Summernote
            $('#summernote').summernote({
                height: 100,
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
            var table = $('.data-table').DataTable();

            function reloadTable() {
                table.ajax.reload();
            }

            function resetModal() {
                $('#staticBackdrop').modal('show'); // Show the modal
                $("#category_form")[0].reset(); // Reset the form fields
                $('#summernote').summernote('code', ''); // Clear Summernote content
                $('#error_title').text('');
                // Reset Dropify
                dropify.data('dropify').resetPreview();
                dropify.data('dropify').clearElement();

                $('#modal_title').text('Category : Create'); // Change modal title
            }
            $('#category_btn').on('click', function() {
                resetModal();
            })
            $('#modal_close, .btn-close').on('click', function() {
                $('#staticBackdrop').modal('hide');
                resetModal();
            })

            //Submit Form
            $('#submit_btn').on('click', function() {
                $('#submit_btn').text('wait');
                var formData = new FormData();
                formData.append('title', $('[name="title"]').val());
                formData.append('data_id', $('[name="data_id"]').val());
                formData.append('description', $('[name="description"]').val());
                var dropifyFile = $('.dropify')[0].files[0];
                formData.append('image', dropifyFile);

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.category.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-Token': csrfToken
                    },
                    success: function(response) {
                        $('#submit_btn').text('Submit');
                        toastr.success(response.success);
                        resetModal();
                        $('#staticBackdrop').modal('hide');
                        reloadTable();

                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr
                            .responseJSON.error.title : 'An error occurred. Please try again.';
                        toastr.error(errorMessage);
                        $('#error_title').text(errorMessage);
                    }
                });

                $('#submit_btn').text('Submit');
            })

            //Edit and Delete record
            $('.data-table').on('click', '.delete-btn, .edit-btn', function() {
                var category = $(this).data('id');
                var row = $(this).closest('tr');

                if ($(this).hasClass('delete-btn')) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You Data move to Trash!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Move it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Perform AJAX deletion
                            $.ajax({
                                type: 'DELETE',
                                url: 'category/' + category,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(response) {
                                    row.remove();
                                    toastr.success(response.success);
                                    reloadTable();
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                    Swal.fire('Error!',
                                        'There was an error deleting the item.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                } else if ($(this).hasClass('edit-btn')) {
                    console.log(category);
                    $.ajax({
                        type: 'GET',
                        url: 'category/' + category + '/edit',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            var data_lists = response.data_list;
                            console.log(data_lists);
                            resetModal();
                            $('#staticBackdrop').modal('show');
                            $('#modal_title').text('Category: Edit');
                            $('#title').val(data_lists.title);
                            $('#data_id').val(data_lists.id);
                            $('#summernote').summernote('code', data_lists.description);

                            var imageUrl = "http://127.0.0.1:8000/" + data_lists.file_path;
                            console.log(imageUrl);
                            var dropify = $('#input-file').dropify({
                                messages: {
                                    'default': 'Drag and drop a file here or click',
                                    'replace': 'Drag and drop or click to replace',
                                    'remove': 'Remove',
                                    'error': 'Ooops, something wrong happened.'
                                }
                            });
                            dropify = dropify.data('dropify'); // Retrieve dropify instance
                            dropify.settings.defaultFile = imageUrl;
                            dropify.destroy();
                            dropify.init();
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            Swal.fire('Error!',
                                'There was an error deleting the item.', 'error'
                            );
                        }
                    });
                }
            });


        });
    </script>
@endsection
