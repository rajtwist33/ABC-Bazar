<!-- Modal -->
<div class="modal fade" id="buy_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Buy {{ $products->hascategory->title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="buy_product_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="fs-1"><strong
                            class="mr-2">{{ $products->hascategory->title }}
                            Code:</strong>{{ $products->product_code }}</label>
                        </div>
                        <div class="col-md-4">
                            <label for="" class=" fs-1"><strong
                            class="mr-2">{{ $products->hascategory->title }} Model:
                           </strong>{{ $products->title }}</label>
                        </div>
                        <div class="col-md-4">
                            <label for="" class=" fs-1"><strong
                            class="mr-2">{{ $products->hascategory->title }} Price: </strong> Rs.
                           {{ $products->price }}</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="client-name" class="col-form-label">Name:</label>
                        <input type="text" name="client_name" class="form-control" id="client-name">
                        <span class="text-danger" id="client_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="client-phone" class="col-form-label">Phone:</label>
                        <input type="tel" name="client_phone" class="form-control" id="client-phone">
                        <span class="text-danger" id="client_phone_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="client-email" class="col-form-label">Email:</label>
                        <input type="email" name="client_email" class="form-control" id="client-email">
                        <span class="text-danger" id="client_email_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="client-address" class="col-form-label">Address:</label>
                        <input type="text" name="client_address" class="form-control" id="client-address">
                        <span class="text-danger" id="client_address_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="client-message" class="col-form-label">Message:</label>
                        <textarea class="form-control" name="client_message" id="client-message"></textarea>
                        <span class="text-danger" id="client_message_error"></span>
                    </div>
                    <input type="hidden" value="{{ $products->id }}" name="product_id" id="product_id">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="send_data">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
