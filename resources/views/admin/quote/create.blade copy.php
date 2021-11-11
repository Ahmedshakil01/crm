@extends('admin.include.master')
@section('title') New Contact - Aleshamart @endsection
@section('content')
    <style>
        .required {
            color: red;
            font-size: 16px;
        }

    </style>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="page-header" style="border:none">
                            <h3 class="page-title">Create New Quote</h3>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">New Quote</li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class=""><a  href=" {{ route('contact.index') }}"
                                style="color: #fff; margin-right:20px" class="btn btn-info btn-sm">
                                <i class="fa fa-list"></i> View Contact List</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create</h3>
                </div>
                <div class="card-body p-0" style="margin-top: 30px;margin-bottom: 30px;">
                    <table class="table table-striped projects">
                        <form method="POST" action="{{ route('quote.store') }}" enctype="multipart/form-data"
                            id="quoteForm">
                            @csrf
                            <h3 class="text-center py-3 mb-4 border border-bottom">Quote Information</h3>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="quote_owner"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Quote Owner') }}<span
                                                class="required">*</span></label>
                                        <div class="col-md-8">

                                            <input id="quote_owner" type="text"
                                                class="form-control"
                                                name="quote_owner"
                                                value="{{ Auth::guard('administration')->user()->fullname }}" readonly>


                                            <div id="quote_owner-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="subject"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Subject') }}<span
                                                class="required">*</span></label>
                                        <div class="col-md-8">
                                            <input id="subject" type="text" class="form-control" name="subject"
                                                value="{{ old('subject') }}">

                                            <div id="subject-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Status') }}</label>
                                        <div class="col-md-8">
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>


                                            <div id="status-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="team"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Team') }}</label>
                                        <div class="col-md-8">
                                            <input id="team" type="text"
                                                class="form-control"
                                                name="team" value="{{ old('team') }}">


                                            <div id="team-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="deal_name"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Deal Name') }}</label>
                                        <div class="col-md-8">
                                            <input id="deal_name" type="deal_name"
                                                class="form-control"
                                                name="deal_name" value="{{ old('deal_name') }}">


                                            <div id="deal_name-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="valid_until"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Valid Until') }}</label>
                                        <div class="col-md-8">
                                            <input id="valid_until" type="date"
                                                class="form-control"
                                                name="valid_until" value="{{ old('valid_until') }}">


                                            <div id="valid_until-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="details"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Company Name') }}</label>

                                        <div class="col-md-8">
                                            <input id="contact" type="text"
                                                class="form-control"
                                                value="{{ $contact->company }}" readonly>
                                            <div id="contact-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="contact"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Contact Name') }}</label>
                                        <div class="col-md-8">
                                            <input id="contact" type="text"
                                                class="form-control"
                                                value="{{ $contact->owner_name }}" readonly>

                                            <div id="contact-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="contact_id" id="contact_id" value="{{ $contact->id }}">
                                </div>
                            </div>

                            <h3 class="text-center py-3 mb-4 border border-bottom">Address Information</h3>

                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group row">
                                        <label for="billing_street"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Billing Street') }}<span
                                                class="required">*</span></label>
                                        <div class="col-md-8">

                                            <input id="billing_street" type="text"
                                                class="form-control"
                                                name="billing_street" value="{{ old('billing_street') }}">

                                            <div id="billing_street-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="billing_city"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Billing City') }}<span
                                                class="required">*</span></label>
                                        <div class="col-md-8">

                                            <input id="billing_city" type="text"
                                                class="form-control"
                                                name="billing_city" value="{{ old('billing_city') }}">

                                            <div id="billing_city-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="billing_state"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Billing State') }}<span
                                                class="required">*</span></label>
                                        <div class="col-md-8">

                                            <input id="billing_state" type="text"
                                                class="form-control"
                                                name="billing_state" value="{{ old('billing_state') }}">

                                            <div id="billing_state-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="billing_code"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Billing Code') }}<span
                                                class="required">*</span></label>
                                        <div class="col-md-8">

                                            <input id="billing_code" type="text"
                                                class="form-control"
                                                name="billing_code" value="{{ old('billing_code') }}">

                                            <div id="billing_code-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="billing_country"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Billing Country') }}<span
                                                class="required">*</span></label>
                                        <div class="col-md-8">

                                            <input id="billing_country" type="text"
                                                class="form-control"
                                                name="billing_country" value="{{ old('billing_country') }}">

                                            <div id="billing_country-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">

                                    <div class="form-group row">
                                        <label for="shipping_street"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Shipping Street') }}<span
                                                class="required">*</span></label>
                                        <div class="col-md-8">

                                            <input id="shipping_street" type="text"
                                                class="form-control"
                                                name="shipping_street" value="{{ old('shipping_street') }}">

                                            <div id="shipping_street-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="shipping_city"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Shipping City') }}<span
                                                class="required">*</span></label>
                                        <div class="col-md-8">

                                            <input id="shipping_city" type="text"
                                                class="form-control"
                                                name="shipping_city" value="{{ old('shipping_city') }}">

                                            <div id="shipping_city-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="shipping_state"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Shipping State') }}<span
                                                class="required">*</span></label>
                                        <div class="col-md-8">

                                            <input id="shipping_state" type="text"
                                                class="form-control"
                                                name="shipping_state" value="{{ old('shipping_state') }}">

                                            <div id="shipping_state-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="shipping_code"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Shipping Code') }}<span
                                                class="required">*</span></label>
                                        <div class="col-md-8">

                                            <input id="shipping_code" type="text"
                                                class="form-control"
                                                name="shipping_code" value="{{ old('shipping_code') }}">

                                            <div id="shipping_code-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="shipping_country"
                                            class="col-md-3 col-form-label text-md-right">{{ __('Shipping Country') }}<span
                                                class="required">*</span></label>
                                        <div class="col-md-8">

                                            <input id="shipping_country" type="text"
                                                class="form-control"
                                                name="shipping_country" value="{{ old('shipping_country') }}">
                                            <div id="shipping_country-message">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-10 offset-md-1">
                                        <table class="table table-border">
                                            <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Amount</th>
                                                    <th>Discount</th>
                                                    <th>Tax</th>
                                                    <th>Total</th>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody id="product">

                                            </tbody>

                                        </table>
                                        <div class="add-new m-5">
                                            <a class="btn btn-success" id="addNewBtn">Add New</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-0 my-5 py-5">
                                    <div class="col-md-4 offset-md-4">
                                        <button type="submit" class="btn btn-primary form-control">
                                            {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    </div>









    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js"
        integrity="sha512-m2ssMAtdCEYGWXQ8hXVG4Q39uKYtbfaJL5QMTbhl2kc6vYyubrKHhr6aLLXW4ITeXSywQLn1AhsAaqrJl8Acfg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let x = 0;
        $('#addNewBtn').click(function() {
            x++;
            let html = ` <tr id="productRow">
                            <td>${x}</td>
                            <td><input class="form-control" type="text" name="product_name[]" id="product_name${x}"  placeholder="Product Name"></td>
                            <td><input class="form-control" type="number" name="quantity[]" id="quantity${x}" placeholder="Quantity" onkeyup="quantityAdd(${x})"></td>
                            <td><input class="form-control" type="number" name="price[]" id="price${x}" placeholder="Price" onkeyup="quantityAdd(${x})"></td>
                            <td><input class="form-control" type="number" name="amount[]" id="amount${x}" placeholder="Amount" readonly></td>
                            <td><input class="form-control" type="number" name="discount[]" id="discount${x}" placeholder="Discount" onkeyup="quantityAdd(${x})"></td>
                            <td><input class="form-control" type="number" name="tax[]"  id="tax${x}" placeholder="Tax" onkeyup="quantityAdd(${x})"></td>
                            <td><input class="form-control" type="number" name="total[]"  id="total${x}"  placeholder="Total" readonly></td>
                            <td><a id="removeRow" class="btn btn-danger"><i class="fas fa-minus-circle"></i></a></td>
                        </tr> `;
            $('#product').append(html)
        });

        $(document).on('click', '#removeRow', function() {
            $(this).closest('#productRow').remove();
        });


        function quantityAdd(x) {
            $('#product_name' + x).prop("required", true);
            var quantityVal = $("#quantity" + x).val();
            var price = $("#price" + x).val();
            var amount = quantityVal * price;
            $('#amount' + x).val(amount);
            var discount = $('#discount' + x).val();
            let discountValue = (amount * discount) / 100;
            let afterDiscount = amount - discountValue;
            $('#total' + x).val(afterDiscount)
            var taxValue = $('#tax' + x).val();
            let tax = (amount * taxValue) / 100;
            let afterTax = parseInt(afterDiscount) + tax;
            $('#total' + x).val(afterTax)

        }


        $('#quoteForm').submit(function(e) {
            e.preventDefault();
            let quote_owner = $("#quote_owner").val()
            let status = $("#status").val()
            let subject = $("#subject").val()
            let team = $("#team").val()
            let deal_name = $("#deal_name").val()
            let valid_until = $("#valid_until").val()
            let contact_id = $("#contact_id").val()
            let billing_street = $("#billing_street").val()
            let billing_city = $("#billing_city").val()
            let billing_state = $("#billing_state").val()
            let billing_code = $("#billing_code").val()
            let billing_country = $("#billing_country").val()
            let shipping_street = $("#shipping_street").val()
            let shipping_city = $("#shipping_city").val()
            let shipping_state = $("#shipping_state").val()
            let shipping_code = $("#shipping_code").val()
            let shipping_country = $("#shipping_country").val()
            let product_name = $("input[name='product_name[]']").map(function() {
                return $(this).val();
            }).get();
            let quantity = $("input[name='quantity[]']").map(function() {
                return $(this).val();
            }).get();
            let price = $("input[name='price[]']").map(function() {
                return $(this).val();
            }).get();
            let amount = $("input[name='amount[]']").map(function() {
                return $(this).val();
            }).get();
            let discount = $("input[name='discount[]']").map(function() {
                return $(this).val();
            }).get();
            let tax = $("input[name='tax[]']").map(function() {
                return $(this).val();
            }).get();
            let total = $("input[name='total[]']").map(function() {
                return $(this).val();
            }).get();
            store(quote_owner, status, subject, team, deal_name, valid_until, contact_id, billing_street,
                billing_city, billing_state, billing_code, billing_country, shipping_street, shipping_city,
                shipping_state, shipping_code, shipping_country, product_name, quantity, price, amount,
                discount, tax, total)
        })

        function store(quote_owner, status, subject, team, deal_name, valid_until, contact_id, billing_street, billing_city,
            billing_state, billing_code, billing_country, shipping_street, shipping_city, shipping_state, shipping_code,
            shipping_country, product_name, quantity, price, amount, discount, tax, total) {
                if (quote_owner.length == 0) {
                $('#quote_owner').addClass('is-invalid');
                $('#quote_owner-message .invalid-feedback').css('display', 'block');
                $('#quote_owner-message strong').html(' Quote Owner Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (subject.length == 0) {
                $('#subject').addClass('is-invalid');
                $('#subject-message .invalid-feedback').css('display', 'block');
                $('#subject-message strong').html(' Subject Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (status.length == 0) {
                $('#status').addClass('is-invalid');
                $('#status-message .invalid-feedback').css('display', 'block');
                $('#status-message strong').html(' Status Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (team.length == 0) {
                $('#team').addClass('is-invalid');
                $('#team-message .invalid-feedback').css('display', 'block');
                $('#team-message strong').html(' Team Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (deal_name.length == 0) {
                $('#deal_name').addClass('is-invalid');
                $('#deal_name-message .invalid-feedback').css('display', 'block');
                $('#deal_name-message strong').html(' Deal Name Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (valid_until.length == 0) {
                $('#valid_until').addClass('is-invalid');
                $('#valid_until-message .invalid-feedback').css('display', 'block');
                $('#valid_until-message strong').html(' Valid Until Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (contact_id.length == 0) {
                $('#contact_id').addClass('is-invalid');
                $('#contact_id-message .invalid-feedback').css('display', 'block');
                $('#contact_id-message strong').html(' Contact Id Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (billing_street.length == 0) {
                $('#billing_street').addClass('is-invalid');
                $('#billing_street-message .invalid-feedback').css('display', 'block');
                $('#billing_street-message strong').html(' Billing Street Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (billing_city.length == 0) {
                $('#billing_city').addClass('is-invalid');
                $('#billing_city-message .invalid-feedback').css('display', 'block');
                $('#billing_city-message strong').html(' Billing City Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (billing_state.length == 0) {
                $('#billing_state').addClass('is-invalid');
                $('#billing_state-message .invalid-feedback').css('display', 'block');
                $('#billing_state-message strong').html(' Billing State Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (billing_code.length == 0) {
                $('#billing_code').addClass('is-invalid');
                $('#billing_code-message .invalid-feedback').css('display', 'block');
                $('#billing_code-message strong').html(' Billing Code Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (billing_country.length == 0) {
                $('#billing_country').addClass('is-invalid');
                $('#billing_country-message .invalid-feedback').css('display', 'block');
                $('#billing_country-message strong').html(' Billing Country Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (shipping_street.length == 0) {
                $('#shipping_street').addClass('is-invalid');
                $('#shipping_street-message .invalid-feedback').css('display', 'block');
                $('#shipping_street-message strong').html(' Shipping Street Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (shipping_city.length == 0) {
                $('#shipping_city').addClass('is-invalid');
                $('#shipping_city-message .invalid-feedback').css('display', 'block');
                $('#shipping_city-message strong').html(' Shipping City Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (shipping_state.length == 0) {
                $('#shipping_state').addClass('is-invalid');
                $('#shipping_state-message .invalid-feedback').css('display', 'block');
                $('#shipping_state-message strong').html(' Shipping State Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (shipping_code.length == 0) {
                $('#shipping_code').addClass('is-invalid');
                $('#shipping_code-message .invalid-feedback').css('display', 'block');
                $('#shipping_code-message strong').html(' Shipping Code Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (shipping_country.length == 0) {
                $('#shipping_country').addClass('is-invalid');
                $('#shipping_country-message .invalid-feedback').css('display', 'block');
                $('#shipping_country-message strong').html(' Shipping Country Field is empty!');
                toastr.error('Subject Field is empty!', 'error', {
                    closeButton: true,
                    progressBar: true,
                });
            } else if (product_name.length == 0) {
                $('#addNewBtn').css('border', '2px solid red');
                toastr.error('Please Add a Product...', 'error', {
                    closeButton: true,
                    progressBar: true,
                });

            } else if (product_name.length != 0) {
                 $('#addNewBtn').css('border', '');
                for (let index = 0; index < product_name.length; index++) {
                    let productName = '#'+'product_name' + (index+1);
                    let productValue = $(productName).val();
                    if (!productValue) {  
                        $(productName).addClass('is-invalid');
                        toastr.error('Product Field is empty!', 'error', {
                                closeButton: true,
                                progressBar: true,
                        });
                    }
                }
                return false;
            }  else {
                updateData = [{
                    quote_owner: quote_owner,
                    status: status,
                    subject: subject,
                    team: team,
                    deal_name: deal_name,
                    valid_until: valid_until,
                    contact_id: contact_id,
                    billing_street: billing_street,
                    billing_city: billing_city,
                    billing_state: billing_state,
                    billing_code: billing_code,
                    billing_country: billing_country,
                    shipping_street: shipping_street,
                    shipping_city: shipping_city,
                    shipping_state: shipping_state,
                    shipping_code: shipping_code,
                    shipping_country: shipping_country,
                    product_name: product_name,
                    quantity: quantity,
                    price: price,
                    amount: amount,
                    discount: discount,
                    tax: tax,
                    total: total,
                }];
                var formData = new FormData();
                formData.append('data', JSON.stringify(updateData));
                axios.post("{{ route('quote.store') }}", formData)
                    .then((response) => {
                        if (response.status = 200) {
                            if (response.data == 1) {
                                toastr.success('Created Successfully.', 'Success', {
                                    closeButton: true,
                                    progressBar: true,
                                });
                                window.location.href = "{{ route('admin.contact.details', $contact->id) }}";
                            }
                        } else {
                            toastr.error('Updated Failed.', 'error', {
                                closeButton: true,
                                progressBar: true,
                            });
                        }


                    }, (error) => {
                        console.log(error);
                        toastr.error(error, 'error', {
                            closeButton: true,
                            progressBar: true,
                        });
                    });
            }

        }
    </script>
@endsection
