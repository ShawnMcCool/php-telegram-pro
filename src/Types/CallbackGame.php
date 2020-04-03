<?php namespace TelegramPro\Types;

/**
 * A placeholder, currently holds no information. Use BotFather to set up your game.
 */
final class CallbackGame implements ApiReadType
{
    /**
     * 
     * @param $callbackGame
     * @return CallbackGame|null
     */
    public static function fromApi($callbackGame): ?CallbackGame
    {
        if ( ! $callbackGame) {
            return null;
        }
        
        return new static();
    }
}