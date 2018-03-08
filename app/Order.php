<?php

namespace AutoKit;

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
 */
class Order extends Model
{
    protected $fillable = [
        'customer_name', 'customer_email', 'customer_phone_number', 'user_id', 'is_self_delivery',
        'warehouse_id', 'payment_id', 'cart', 'shipping_price'
    ];

    protected $dispatchesEvents = [
        'created' => NewOrder::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCartAttribute(string $value): Collection
    {
        return unserialize($value);
    }

    public function getShippingPriceAttribute(int $value): Money
    {
        $exchanger = app(Exchanger::class);
        return $exchanger->convert(Money::USD($value), app(Currency::class));
    }

    public function confirmPayment(ApiResource $charge): self
    {
        $this->payment_id = $charge->id;
        $this->save();
        return $this;
    }
}
