
@include('partials.order.form.warehouse_info')

@isset($additionalServices)
    <div class="row margin-top25">
        <h4 class="color-black">@lang('delivery_auto.additional_services')</h4>
        <div class="panel-group" id="accordion">
            @for($i = 0; $i < $additionalServices->count(); $i++)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $i }}">
                                {{ $additionalServices[$i]->name }}
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{ $i }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <table class="table table-condensed my-table">
                                    <tbody>
                                        @foreach($additionalServices[$i]->dopUsluga as $dopUsluga)
                                            <tr>
                                                <td class="first-row"><input type="checkbox" name="dopUsluga[]" id="{{ $dopUsluga->uslugaId }}" value="{{ $dopUsluga->uslugaId }}"></td>
                                                <td><label for="{{ $dopUsluga->uslugaId }}">{{ $dopUsluga->name }}</label></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
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

@isset($tarifs)
    <div class="row margin-top25">
        <div class="form-group">
            <div class="col-sm-4 text-right">
                <label for="tarif_delivery">@lang('delivery_auto.tarif_delivery')</label>
            </div>
            <div class="col-sm-8">
                <select name="tarif_delivery" id="tarif_delivery" class="form-control" data-route="{{ route('order.category') }}">
                    @include('partials.order.form.item_list', ['items' => $tarifs])
                </select>
            </div>
        </div>
    </div>
@endisset

@isset($insuranceCost)
    <input type="hidden" value="{{ $insuranceCost->get('value') }}">
@endisset

<div id="forCategories"></div>