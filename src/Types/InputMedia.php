<?php namespace TelegramPro\Types;

use JsonSerializable;

/**
 * This object represents the content of a media message to be sent. It should be one of
 *
 * - InputMediaAnimation
 * - InputMediaDocument
 * - InputMediaAudio
 * - InputMediaPhoto
 * - InputMediaVideo
 */
interface InputMedia extends JsonSerializable
{
    public function toApi(): array;
    public function filesToUpload(): array;
}