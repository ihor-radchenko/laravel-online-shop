
<form action="{{ route('payment') }}" method="post" class="orderForm" id="order-form">
    @include('partials.order.form.delivery.person_info')
    @include('partials.order.form.delivery.delivery')
    <div id="forAddress"></div>
    <input type="hidden" id="publish_key" value="{{ config('stripe.publishable_key') }}">
    {{ csrf_field() }}

<!-- Modal -->
    <div class="modal fade" id="paymentForm" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4>
                        <label for="card-element">@lang('form.payment_card')</label>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-row">

                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display Element errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="order-form" class="my-btn payment-btn">@lang('form.payment')</button>
                </div>
            </div>
        </div>
    </div>

</form>