
@isset($categories)
    <div class="row margin-top25">
        <div class="form-group">
            <div class="col-sm-4 text-right">
                <label for="categories_delivery">@lang('delivery_auto.categories')</label>
            </div>
            <div class="col-sm-8">
                <select name="categories_delivery" id="categories_delivery" class="form-control">
                    @include('partials.order.form.delivery.item_list', ['items' => $categories])
                </select>
            </div>
        </div>
    </div>
@endisset