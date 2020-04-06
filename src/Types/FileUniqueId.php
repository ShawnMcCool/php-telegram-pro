<?php namespace TelegramPro\Types;

/**
 * Unique identifier for a file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 */
final class FileUniqueId extends ApiReadString
{
}