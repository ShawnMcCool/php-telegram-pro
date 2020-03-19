<?php namespace TelegramPro\Methods;

use TelegramPro\Types\User;

final class GetMeResponse
***REMOVED***
    private bool $ok;
    private ?User $result;

    public function __construct(bool $ok, ?User $result)
    ***REMOVED***
        $this->ok = $ok;
        $this->result = $result;
    ***REMOVED***

    public static function fromApi(string $jsonResponse): GetMeResponse
    ***REMOVED***
        $response = json_decode($jsonResponse);

        return new static(
            $response->ok,
            User::fromApi($response->result)
        );
    ***REMOVED***

    public function ok(): bool
    ***REMOVED***
        return $this->ok;
    ***REMOVED***

    public function result(): ?User
    ***REMOVED***
        return $this->result;
    ***REMOVED***
***REMOVED***