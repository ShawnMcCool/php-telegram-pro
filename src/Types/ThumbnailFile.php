<?php namespace TelegramPro\Types;

use CURLFile;
use TelegramPro\Collections\Collection;

/**
 * Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More info on Sending Files »
 */
final class ThumbnailFile extends InputFile
{
    public static function fromFilePath(FilePath $filePath): InputFile
    {
        if (is_null($filePath)) {
            return null;
        }

        $filePathString = realpath($filePath);
        
        if (bytesToKilobytes(filesize($filePathString)) > 200) {
            throw ThumbnailFileNotSupported::fileSizeIsGreaterThan200Kilobytes($filePathString);
        }

        [$width, $height, $type, $attr] = getimagesize($filePathString);

        if ($width > 320 || $height > 320) {
            throw ThumbnailFileNotSupported::fileDimensionsAreNotValid($width, $height);
        }
        
        return parent::fromFilePath($filePath);
    }
    
    public function __toString()
    {
        return $this->inputFileString();
    }
}