<?php namespace TelegramPro;

final class ChatType
***REMOVED***
    private string $type;

    private function __construct(string $type)
    ***REMOVED***
        $this->type = $type;
    ***REMOVED***

    public function toString(): string
    ***REMOVED***
        return $this->type;
    ***REMOVED***

    public static function private(): ChatType
    ***REMOVED***
        return new static('private');
    ***REMOVED***

    public static function group(): ChatType
    ***REMOVED***
        return new static('group');
    ***REMOVED***

    public static function supergroup(): ChatType
    ***REMOVED***
        return new static('supergroup');
    ***REMOVED***

    public static function channel(): ChatType
    ***REMOVED***
        return new static('channel');
    ***REMOVED***
***REMOVED***