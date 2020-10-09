<?php namespace TelegramPro\Bot\Methods\Types;

final class ActionType implements ApiWriteType
{
    private string $actionType;

    private function __construct(string $actionType)
    {
        $this->actionType = $actionType;
    }

    function toApi()
    {
        return $this->actionType;
    }

    public static function typing()
    {
        return new static('typing');
    }

    public static function uploadPhoto()
    {
        return new static('upload_photo');
    }

    public static function recordVideo()
    {
        return new static('record_video');
    }

    public static function uploadVideo()
    {
        return new static('upload_video');
    }

    public static function recordAudio()
    {
        return new static('record_audio');
    }

    public static function uploadAudio()
    {
        return new static('upload_audio');
    }

    public static function uploadDocument()
    {
        return new static('upload_document');
    }

    public static function findLocation()
    {
        return new static('find_location');
    }

    public static function recordVideoNote()
    {
        return new static('record_video_note');
    }

    public static function uploadVideoNote()
    {
        return new static('upload_video_note');
    }
}