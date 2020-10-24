<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

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

    function class_short_name($object): string
    {
        $className = get_class($object);
        return (substr($className, strrpos($className, '\\') + 1));
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
    /**
     * Returns the first match of a pattern in the haystack.
     */
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

    /**
     * Returns true if the haystack matches the pattern.
     */
    function matches($pattern, $haystack, $autoDelimiter = true): bool
    {
        if (
            $autoDelimiter &&
            ! \string\starts_with($haystack, '/')
        ) {
            $pattern = '/' . $pattern . '/';
        }

        preg_match($pattern, $haystack, $matches);

        return ! empty($matches);
    }

    /** 
     * Returns true if characters exist in the haystack that do not match the pattern.
     *
     * A valid set of character classes looks like this: a-zA-Z0-9_\s  
     */
    function has_unmatched_characters($characterClasses, $haystack): bool
    {
        preg_match("([^{$characterClasses}])", $haystack, $matches);
        return ! empty($matches);
    }
}