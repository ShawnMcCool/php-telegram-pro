<?php

namespace {

    use TelegramPro\Collections\Collection;
    use TelegramPro\Bot\Methods\Types\ApiWriteType;
    use TelegramPro\Bot\Methods\Keyboards\ReplyMarkup;
    
    function bytesToMegabytes(int $bytes): int
    {
        return $bytes / 1000000;
    }

    function bytesToKilobytes(int $bytes): int
    {
        return $bytes / 1000;
    }

    function collect($items): Collection
    {
        if (is_null($items)) {
            return Collection::empty();
        }

        if ( ! is_array($items)) {
            $items = [$items];
        }
        return new Collection($items);
    }

    function optional($type)
    {
        if (is_null($type)) {
            return null;
        }

        if ($type instanceof ApiWriteType) {
            return $type->toApi();
        } elseif ($type instanceof ReplyMarkup) {
            return $type->toParameter();
        }

        return $type;
    }

    function float_is_equal(float $a, $b): bool
    {
        return abs($a - $b) < PHP_FLOAT_EPSILON;
    }

}

namespace arr {
    function only($keys, $array): array
    {
        return array_intersect_key($array, array_flip((array) $keys));
    }

    function last($array)
    {
        return end($array);
    }
}

namespace string {
    function contains($haystack, $needle): bool
    {
        return strpos($haystack, $needle) !== false;
    }

    function starts_with($haystack, $needle): bool
    {
        return \strncmp($haystack, $needle, \strlen($needle)) === 0;
    }

    function ends_with($haystack, $needle): bool
    {
        $found = false;

        if (is_array($needle)) {
            foreach ($needle as $query) {
                if ($query === '' || $query === \substr($haystack, -\strlen($query))) {
                    $found = true;
                    break;
                }
            }

            return $found;
        }

        return $needle === '' || $needle === \substr($haystack, -\strlen($needle));
    }
}

namespace regex {

    function first($pattern, $haystack, $autoDelimiter = true): ?string
    {
        if (
            $autoDelimiter &&
            ! \string\starts_with($haystack, '/')
        ) {
            $pattern = '/' . $pattern . '/';
        }

        preg_match($pattern, $haystack, $matches);

        if (empty($matches)) {
            return null;
        }

        return \arr\last($matches);
    }
}