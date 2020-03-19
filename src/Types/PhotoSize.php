<?php namespace TelegramPro\Types;

final class PhotoSize
***REMOVED***
    private string $fileId;
    private string $fileUniqueId;
    private int $width;
    private int $height;
    private ?int $fileSize;

    public function __construct(
        string $fileId,
        string $fileUniqueId,
        int $width,
        int $height,
        ?int $fileSize
    ) ***REMOVED***
        $this->fileId = $fileId;
        $this->fileUniqueId = $fileUniqueId;
        $this->width = $width;
        $this->height = $height;
        $this->fileSize = $fileSize;
    ***REMOVED***

    public static function arrayfromApi(?array $photoSizes): ?array
    ***REMOVED***
        if ( ! $photoSizes) return null;
        
        $photoSizeArray = [];
        
        foreach ($photoSizes as $photoSize) ***REMOVED***
            $photoSizeArray[] = PhotoSize::fromApi($photoSize);
        ***REMOVED***
        
        return $photoSizeArray;
    ***REMOVED***

    public static function fromApi($thumb): ?PhotoSize
    ***REMOVED***
        if ( ! $thumb) return null;

        return new static(
            $thumb->file_id,
            $thumb->file_unique_id,
            $thumb->width,
            $thumb->height,
            $thumb->file_size
        );
    ***REMOVED***
***REMOVED***