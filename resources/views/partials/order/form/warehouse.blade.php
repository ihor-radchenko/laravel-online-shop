
@include('partials.order.form.warehouse_info')

@isset($tarifs)
    <div class="row margin-top25">
        <div class="form-group">
            <div class="col-sm-4 text-right">
                <label for="scheme_delivery">@lang('delivery_auto.tarif_delivery')</label>
            </div>
            <div class="col-sm-8">
                <select name="scheme_delivery" id="scheme_delivery" class="form-control">
                    @include('partials.order.form.item_list', ['items' => $tarifs])
                </select>
            </div>
        </div>
    </div>
@endisset

@isset($schemes)
    <div class="row margin-top25">
        <div class="form-group">
            <div class="col-sm-4 text-right">
                <label for="scheme_delivery">@lang('delivery_auto.scheme_delivery')</label>
            </div>
            <div class="col-sm-8">
                <select name="scheme_delivery" id="scheme_delivery" class="form-control">
                    @include('partials.order.form.item_list', ['items' => $schemes])
                </select>
            </div>
        </div>
    </div>
@endisset