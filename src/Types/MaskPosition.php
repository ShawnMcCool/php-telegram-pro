<?php namespace TelegramPro\Types;

final class MaskPosition
{
    private string $point;
    private float $xShift;
    private float $yShift;
    private float $scale;

    public function __construct(
        string $point,
        float $xShift,
        float $yShift,
        float $scale
    ) {
        $this->point = $point;
        $this->xShift = $xShift;
        $this->yShift = $yShift;
        $this->scale = $scale;
    }

    public static function fromApi($maskPosition): ?MaskPosition
    {
        if ( ! $maskPosition) return null;

        return new static(
            $maskPosition->point,
            $maskPosition->x_shift,
            $maskPosition->y_shift,
            $maskPosition->scale,
        );
    }
}