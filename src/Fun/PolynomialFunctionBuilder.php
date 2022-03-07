<?php

namespace Kukulis\Math\Fun;

use Closure;

class PolynomialFunctionBuilder
{
    protected Closure $constructor;

    /** @var Point[] */
    protected array $points = [];

    public function __construct(Closure $constructor)
    {
        $this->constructor = $constructor;
    }

    public function addPoint(float $x, float $y): self
    {
        $this->points[] = new Point($x, $y);

        return $this;
    }


    public function build(): PolynomialFunction
    {
        usort($this->points, fn(Point $p1, Point $p2) => $p1->getX() <=> $p2->getX());

        return call_user_func( $this->constructor, $this->points);
    }
}