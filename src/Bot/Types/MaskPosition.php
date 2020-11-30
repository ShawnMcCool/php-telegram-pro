<?php namespace TelegramPro\Bot\Types;

use TelegramPro\Bot\Methods\Types\ApiReadType;

/**
 * This object describes the position on faces where a mask should be placed by default.
 */
final class MaskPosition implements ApiReadType
{
    private string $point;
    private float $xShift;
    private float $yShift;
    private float $scale;

    private function __construct(
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

    /**
     * @internal Construct with data received from the Telegram bot api.
     */
    public static function fromApi($maskPosition): ?static
    {
        if ( ! $maskPosition) return null;

        return new static(
            $maskPosition->point,
            $maskPosition->x_shift,
            $maskPosition->y_shift,
            $maskPosition->scale,
        );
    }

    /**
     * The part of the face relative to which the mask should be placed. One of “forehead”, “eyes”, “mouth”, or “chin”.
     */
    public function point(): string
    {
        return $this->point;
    }

    /**
     * Shift by X-axis measured in widths of the mask scaled to the face size, from left to right. For example, choosing -1.0 will place mask just to the left of the default mask position.
     */
    public function xShift(): float
    {
        return $this->xShift;
    }

    /**
     * Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom. For example, 1.0 will place the mask just below the default mask position.
     */
    public function yShift(): float
    {
        return $this->yShift;
    }

    /**
     * Mask scaling coefficient. For example, 2.0 means double size.
     */
    public function scale(): float
    {
        return $this->scale;
    }
}