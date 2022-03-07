<?php

namespace Tests\Unit;

use Kukulis\Math\Fun\PolynomialFunction;
use PHPUnit\Framework\TestCase;

class PolynomialFunctionTest extends TestCase
{
    public function testFunction()
    {
        $function = PolynomialFunction::builder()
            ->addPoint(-PHP_FLOAT_MAX, 0)
            ->addPoint(0.25, 0)
            ->addPoint(1, 0.5)
            ->addPoint(4, 1)
            ->addPoint(PHP_FLOAT_MAX, 1)
            ->build();

        $this->assertEquals(0, $function->calculate(0));
        $this->assertEquals(0, $function->calculate(0.25));
        $this->assertGreaterThan(0, $function->calculate(0.5));
        $this->assertLessThan(0.5, $function->calculate(0.5));

        $this->assertEquals(0.5, $function->calculate(1));
        $this->assertGreaterThan(0.5, $function->calculate(2));
        $this->assertLessThan(1, $function->calculate(2));

        $this->assertEquals(1, $function->calculate(4));
        $this->assertEquals(1, $function->calculate(10));
    }

}