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
    <div class="container">
      <a href="{{ route('admin.product.trashed') }}" class="float-right btn btn-danger mb-2">Rejected</a>
      <h4>New Orders Arrived</h4>
      <table class="table data-table table-responsive">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Product Code</th>
                    <th>Image</th>
                    <th>Model</th>
                    <th>Mobile Condition</th>
                    <th>Seller Name</th>
                    <th>Seller Phone</th>
                    <th>City</th>
                    <th>Created Date</th>
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
        //Untrashed Category
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.product.index') }}",
                columns: [{
                        "className": "text-center",
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        "className": "text-center",
                        data: 'product_code',
                        name: 'product_code'
                    },
                    {
                        "className": "text-center",
                        data: 'image',
                        name: 'image'
                    },
                    {
                        "className": "text-center",
                        data: 'model',
                        name: 'model',
                    },
                    {
                        "className": "text-center",
                        data: 'mobile_condition',
                        name: 'mobile_condition',
                    },
                    {
                        "className": "text-center",
                        data: 'seller_name',
                        name: 'seller_name',
                    },
                    {
                        "className": "text-center",
                        data: 'seller_phone',
                        name: 'seller_phone',
                    },
                    {
                        "className": "text-center",
                        data: 'seller_city',
                        name: 'seller_city',
                    },
                    {
                        "className": "text-center",
                        data: 'date',
                        name: 'date',
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

            function reloadTable() {
                table.ajax.reload();
            }
            //Edit and Delete record
            $('.data-table').on('click', '.delete-btn, .edit-btn', function() {
                var product = $(this).data('id');
                var row = $(this).closest('tr');

                if ($(this).hasClass('delete-btn')) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You Want To Reject!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Reject it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Perform AJAX deletion
                            $.ajax({
                                type: 'DELETE',
                                url: 'product/' + product,
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
