<?php

namespace Tests\Unit;

use Kukulis\Math\Fun\PolynomialFunction;
use PHPUnit\Framework\TestCase;

class PolynomialFunctionTest extends TestCase
{
    public function testFunction()
    {
        $function = new PolynomialFunction();

        $function->addPoint(-PHP_FLOAT_MAX, 0);
        $function->addPoint(0.25, 0);
        $function->addPoint(1, 0.5);
        $function->addPoint(4, 1);
        $function->addPoint(PHP_FLOAT_MAX, 1);


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