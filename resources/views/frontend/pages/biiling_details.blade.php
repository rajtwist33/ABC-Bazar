<h4>Billing Details Information </h4>
<div class="col-md-6">
    <strong for="validationCustom01" class="form-label">Your Name</strong>
    <input type="text" name="name" class="form-control" id="validationCustom01" value="" required>
    <div class="invalid-feedback" id="name-error"></div>
    <div class="valid-feedback">
        Looks good!
    </div>

</div>
<div class="col-md-6">
    <strong for="validationCustom02" class="form-label">You Phone / Whats App Number </strong>
    <input type="tel" class="form-control" name="phone" id="validationCustom02" value="" required>
    <div class="invalid-feedback" id="phone-error"></div>
    <div class="valid-feedback">
        Looks good!
    </div>
</div>


<div class="col-md-6">
    <strong for="validationDefault04" class="form-label">Choose Your Province</strong>
    <select class="form-select" id="validationDefault04" name="province" required>
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
    <input type="text" class="form-control" name="city" id="validationCustom03" required>
    <div class="invalid-feedback" id="city-error"></div>
    <div class="valid-feedback">
        Looks good!
    </div>

</div>

<div class="col-12">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="true" name="agreed" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
            Agree to terms and conditions
        </label>
        <div class="invalid-feedback">
            You must agree before submitting.
        </div>
    </div>
</div>
