
@include('partials.order.form.delivery.warehouse_info')

<h4 class="color-black">@lang('delivery_auto.arrival_date') {{ $arrivalDate->get('arrivalDateStr') }}</h4>

@isset($additionalServices)
    <div class="row margin-top25">
        <h4 class="color-black">@lang('delivery_auto.additional_services')</h4>
        <div class="panel-group" id="accordion">
            @foreach($additionalServices as $additionalService)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $additionalService->classification }}">
                                {{ $additionalService->name }}
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{ $additionalService->classification }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <table class="table table-condensed my-table">
                                    <tbody>
                                        @foreach($additionalService->dopUsluga as $dopUsluga)
                                            <tr>
                                                <td class="first-row"><input type="checkbox" name="dopUsluga[]" id="{{ $dopUsluga->uslugaId }}" value="{{ $dopUsluga->uslugaId }}" class="calc-item dopUsluga"></td>
                                                <td><label for="{{ $dopUsluga->uslugaId }}">{{ $dopUsluga->name }}</label></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
                <select name="scheme_delivery" id="scheme_delivery" class="form-control calc-item">
                    @include('partials.order.form.delivery.item_list', ['items' => $schemes])
                </select>
            </div>
        </div>
    </div>
@endisset

@isset($tarifs)
    <div class="row margin-top25">
        <div class="form-group">
            <div class="col-sm-4 text-right">
                <label for="tarif_delivery">@lang('delivery_auto.tarif_delivery')</label>
            </div>
            <div class="col-sm-8">
                <select name="tarif_delivery" id="tarif_delivery" class="form-control" data-route="{{ route('delivery.category') }}">
                    @include('partials.order.form.delivery.item_list', ['items' => $tarifs])
                </select>
            </div>
        </div>
    </div>
@endisset

<div id="forCategories"></div>