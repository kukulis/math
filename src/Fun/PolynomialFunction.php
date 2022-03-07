<?php

namespace Kukulis\Math\Fun;

class PolynomialFunction implements FunctionInterface
{
    /** @var Point[] */
    protected array $points = [];

    /**
     * @param Point[] $points
     */
    private function __construct(array $points)
    {
        $this->points = $points;
    }

    public function calculate(float $x): float
    {
        list($pointFrom, $pointTo) = $this->findInterval($x);

        $dx = $pointTo->getX() - $pointFrom->getX();
        $dy = $pointTo->getY() - $pointFrom->getY();
        if ($dx == 0) {
            return $pointFrom->getY();
        }

        $alpha = $dy / $dx;

        $subDx = $x - $pointFrom->getX();
        $subDy = $subDx * $alpha;

        return $pointFrom->getY() + $subDy;
    }


    /**
     * @return Point[] array which consist of two points.
     */
    protected function findInterval(float $x): array
    {
        $firstPoint = $this->points[0];
        if ($x < $firstPoint->getX()) {
            return [new Point(-PHP_FLOAT_MAX, $firstPoint->getY()), $firstPoint];
        }

        for ($i = 0; $i < count($this->points) - 1; $i++) {
            $point = $this->points[$i];
            $nextPoint = $this->points[$i + 1];
            if ($x >= $point->getX() && $x < $nextPoint->getX()) {
                return [$point, $nextPoint];
            }
        }
        $lastPoint = $this->points[count($this->points)];

        return [$lastPoint, new Point(PHP_FLOAT_MAX, $lastPoint->getY())];
    }

    public static function builder(): PolynomialFunctionBuilder
    {
        return new PolynomialFunctionBuilder(function ($points) {
            return new PolynomialFunction($points);
        });
    }

}
