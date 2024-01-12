<!-- Modal1 -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_title"></h1>
                <button type="button" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <form id="category_form">
                    <div class="mb-3">
                        <label for="title" class="form-label">Select Category</label>
                        <select class="form-select" name="select_category" id="select_category"
                            aria-label="Default select example">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label><br>
                        <span class="text-danger error" id="error_title"></span>
                        <input type="text" class="form-control" name="title" id="title"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label><br>
                        <span class="text-danger error" id="error_description"></span>
                        <textarea class="summernote" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Specification</label><br>
                        <span class="text-danger error" id="error_specification"></span>
                        <textarea class="summernote" name="specification"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Imperfections</label>
                        <textarea class="summernote" name="imperfections"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label><br>
                        <span class="text-danger error" id="error_price"></span>
                        <input type="text" class="form-control" name="price" id="price"
                            aria-describedby="emailHelp">
                    </div>

                    <input type="hidden" class="form-control" name="data_id" id="data_id" value=""
                        aria-describedby="emailHelp">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal_close" >Close</button>
                <button type="button" class="btn btn-primary" id="submit_btn">Next</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal2 -->
<div class="modal fade" id="modal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_title"></h1>
                <button type="button" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Upload Product Images</label>
                    <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data"
                        id="image-upload" class="dropzone">
                        @csrf
                        <div>
                            <h3 class="text-center">Upload Multiple Image By Click On Box</h3>
                        </div>
                        <input type="hidden" class="form-control" name="product_id" id="product_id" value=""
                        aria-describedby="emailHelp">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal_close" >Close</button>
            </div>
        </div>
    </div>
</div>
