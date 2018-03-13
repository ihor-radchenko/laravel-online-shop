<?php

namespace AutoKit;

use Auth;
use AutoKit\Components\Cart\Calculator;
use AutoKit\Components\Delivery\Address;
use AutoKit\Components\Money\Currency;
use AutoKit\Components\Money\Exchanger;
use AutoKit\Components\Money\Money;
use AutoKit\Events\NewOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Stripe\ApiResource;

/**
 * AutoKit\Order
 *
 * @property int $id
 * @property string $customer_name
 * @property string $customer_email
 * @property string $customer_phone_number
 * @property int|null $user_id
 * @property int $is_self_delivery
 * @property string|null $payment_id
 * @property mixed $cart
 * @property int $shipping_price
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order whereCart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order whereCustomerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order whereCustomerPhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order whereIsSelfDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order whereShippingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $warehouse_id
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order whereWarehouseId($value)
 * @property-read \AutoKit\User|null $user
 * @property string|null $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Order whereWarehouse($value)
 * @property-read float $total_dimensions
 * @property-read Money|null $total_price
 * @property-read float $total_weight
 */
class Order extends Model
{
    protected $fillable = [
        'customer_name', 'customer_email', 'customer_phone_number', 'user_id', 'is_self_delivery',
        'warehouse', 'payment_id', 'cart', 'shipping_price'
    ];

    protected $dispatchesEvents = [
        'created' => NewOrder::class
    ];

    protected $appends = [
        'total_price', 'total_weight', 'total_dimensions'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCartAttribute(string $value): Collection
    {
        return unserialize($value);
    }

    public function getShippingPriceAttribute($value): ?Money
    {
        $exchanger = app(Exchanger::class);
        return $exchanger->convert(Money::USD($value), app(Currency::class));
    }

    public function getWarehouseAttribute($value): ?Collection
    {
        if (! is_null($value)) {
            $address = app(Address::class);
            return $address->getWarehousesInfo($value);
        }
        return null;
    }

    public function getTotalPriceAttribute(): Money
    {
        $calculator = app(Calculator::class);
        $currency = app(Currency::class);
        return $calculator->totalPrice($this->cart, $currency);
    }

    public function getTotalWeightAttribute(): float
    {
        $calculator = app(Calculator::class);
        return $calculator->totalWeight($this->cart);
    }

    public function getTotalDimensionsAttribute(): float
    {
        $calculator = app(Calculator::class);
        return $calculator->totalDimensions($this->cart);
    }

    public function confirmPayment(ApiResource $charge): self
    {
        $this->payment_id = $charge->id;
        $this->save();
        return $this;
    }

    public function getForUser(): Collection
    {
        return $this
            ->whereUserId(Auth::user()->id)
            ->orderByDesc('id')
            ->get();
    }
}
