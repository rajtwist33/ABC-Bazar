<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_title"></h1>
                <button type="button" class="btn-close"></button>
            </div>
            <div class="modal-body">
                <form id="category_form">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                            aria-describedby="emailHelp">
                        <span class="text-danger" id="error_title"></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Image</label>
                        <input type="file" name="image" class="dropify" id="input-file"  data-allowed-file-extensions="jpg jpeg png gif"/>
                    </div>
                    <input type="hidden" class="form-control" name="data_id" id="data_id" value=""
                            aria-describedby="emailHelp">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="modal_close">Close</button>
                <button type="button" class="btn btn-primary" id="submit_btn">Submit</button>
            </div>
        </div>
    </div>
</div>
