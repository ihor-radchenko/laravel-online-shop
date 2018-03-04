@if(! is_null($product->old_price))
    <span class="new-price">{{ $product->price }}</span>
    <span class="old-price">{{ $product->old_price }}</span>
@else
    <span class="price">{{ $product->price }}</span>
@endif