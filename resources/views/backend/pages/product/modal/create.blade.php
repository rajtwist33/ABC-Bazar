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
                <form id="accept_form">

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label><br>
                        <span class="text-danger error" id="error_title"></span>
                        <input type="text" class="form-control" name="title" id="title"
                            aria-describedby="emailHelp">
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


