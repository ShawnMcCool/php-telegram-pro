<?php namespace TelegramPro;

final class MaskPosition
***REMOVED***
    private string $point;
    private float $xShift;
    private float $yShift;
    private float $scale;

    public function __construct(
        string $point,
        float $xShift,
        float $yShift,
        float $scale
    ) ***REMOVED***
        $this->point = $point;
        $this->xShift = $xShift;
        $this->yShift = $yShift;
        $this->scale = $scale;
    ***REMOVED***

    public static function fromRequest($maskPosition): ?MaskPosition
    ***REMOVED***
        if ( ! $maskPosition) return null;

        return new static(
            $maskPosition->point,
            $maskPosition->x_shift,
            $maskPosition->y_shift,
            $maskPosition->scale,
        );
    ***REMOVED***
***REMOVED***