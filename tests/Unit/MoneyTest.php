<?php

namespace Tests\Unit;

use AutoKit\Components\Money\Currency;
use AutoKit\Components\Money\Money;
use AutoKit\Exceptions\DifferentCurrencies;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoneyTest extends TestCase
{
    /**
     * @throws \AutoKit\Exceptions\UnknownCurrency
     */
    public function testEquals()
    {
        $m1 = new Money(100, new Currency('USD'));
        $m2 = new Money(200,  new Currency('USD'));
        $m3 = new Money(100,  new Currency('EUR'));
        $m4 = new Money(100,  new Currency('USD'));
        $this->assertTrue($m1->equals($m4));
        $this->assertFalse($m1->equals($m2));
        $this->assertFalse($m1->equals($m3));
    }

    /**
     * @throws \AutoKit\Exceptions\UnknownCurrency
     */
    public function testGreaterThan()
    {
        $m1 = new Money(100,  new Currency('USD'));
        $m2 = new Money(200,  new Currency('USD'));
        $m3 = new Money(100,  new Currency('EUR'));
        $m4 = new Money(100,  new Currency('UAH'));
        $this->assertTrue($m2->greaterThan($m1));
        $this->assertFalse($m1->greaterThan($m3));
        $this->assertFalse($m2->greaterThan($m4));
    }

    /**
     * @throws \AutoKit\Exceptions\UnknownCurrency
     */
    public function testGreaterThanOrEquals()
    {
        $m1 = new Money(100,  new Currency('USD'));
        $m2 = new Money(200,  new Currency('USD'));
        $m3 = new Money(100,  new Currency('EUR'));
        $m4 = new Money(100,  new Currency('UAH'));
        $m5 = new Money(100,  new Currency('UAH'));
        $this->assertTrue($m4->greaterThanOrEquals($m5));
        $this->assertTrue($m2->greaterThanOrEquals($m1));
        $this->assertFalse($m3->greaterThanOrEquals($m5));
        $this->assertFalse($m3->greaterThanOrEquals($m2));
        $this->assertFalse($m3->greaterThanOrEquals($m1));
    }

    /**
     * @throws \AutoKit\Exceptions\UnknownCurrency
     */
    public function testLessThanOrEquals()
    {
        $m1 = new Money(100,  new Currency('USD'));
        $m2 = new Money(200,  new Currency('USD'));
        $m3 = new Money(100,  new Currency('EUR'));
        $m4 = new Money(100,  new Currency('UAH'));
        $m5 = new Money(100,  new Currency('UAH'));
        $this->assertTrue($m4->lessThanOrEquals($m5));
        $this->assertTrue($m1->lessThanOrEquals($m2));
        $this->assertFalse($m4->lessThanOrEquals($m1));
        $this->assertFalse($m3->lessThanOrEquals($m2));
    }

    /**
     * @throws \AutoKit\Exceptions\UnknownCurrency
     */
    public function testLessThan()
    {
        $m1 = new Money(100,  new Currency('USD'));
        $m2 = new Money(200,  new Currency('USD'));
        $m3 = new Money(100,  new Currency('EUR'));
        $m4 = new Money(100,  new Currency('UAH'));
        $m5 = new Money(100,  new Currency('UAH'));
        $this->assertFalse($m4->lessThan($m5));
        $this->assertTrue($m1->lessThan($m2));
        $this->assertFalse($m4->lessThan($m1));
        $this->assertFalse($m3->lessThan($m2));
    }

    /**
     * @throws \AutoKit\Exceptions\DifferentCurrencies
     * @throws \AutoKit\Exceptions\UnknownCurrency
     */
    public function testAdd()
    {
        $m1 = new Money(100,  new Currency('USD'));
        $m2 = new Money(200,  new Currency('USD'));
        $m3 = new Money(300,  new Currency('USD'));
        $this->assertTrue($m3->equals($m2->add($m1)));
    }

    /**
     * @throws DifferentCurrencies
     * @throws \AutoKit\Exceptions\ImpossibleSubtracts
     * @throws \AutoKit\Exceptions\UnknownCurrency
     */
    public function testSub()
    {
        $m1 = new Money(100,  new Currency('USD'));
        $m2 = new Money(200,  new Currency('USD'));
        $m3 = new Money(300,  new Currency('USD'));
        $this->assertTrue($m1->equals($m3->sub($m2)));
    }

    /**
     * @throws \AutoKit\Exceptions\UnknownCurrency
     */
    public function testMul()
    {
        $m1 = new Money(100,  new Currency('USD'));
        $m2 = new Money(200,  new Currency('USD'));
        $m3 = new Money(300,  new Currency('USD'));
        $this->assertTrue($m3->equals($m1->mul(3)));
        $this->assertTrue($m3->equals($m2->mul(1.5)));
        $this->assertTrue($m2->equals($m1->mul(2)));
    }

    /**
     * @throws \AutoKit\Exceptions\UnknownCurrency
     */
    public function testDiv()
    {
        $m1 = new Money(100,  new Currency('USD'));
        $m2 = new Money(200,  new Currency('USD'));
        $m3 = new Money(300,  new Currency('USD'));
        $this->assertTrue($m1->equals($m3->div(3)));
        $this->assertTrue($m2->equals($m3->div(1.5)));
        $this->assertTrue($m1->equals($m2->div(2)));
    }
}
