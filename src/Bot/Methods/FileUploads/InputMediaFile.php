<?php namespace TelegramPro\Bot\Methods\FileUploads;

use function TelegramPro\optional;

/**
 * Interface InputMediaFile
 * @package TelegramPro\Methods\FileUploads
 *
 * This object represents the content of a media message to be sent. It should be one of
 *
 * InputMediaAnimation
 * InputMediaDocument
 * InputMediaAudio
 * InputMediaPhoto
 * InputMediaVideo
 */
interface InputMediaFile
{
    public function toApi(): array;

    public function filesToUpload(): ?FilesToUpload;
}