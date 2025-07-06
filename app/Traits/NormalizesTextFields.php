<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait NormalizesTextFields
{
    public static function normalizeString(string $value): string
    {
        return Str::title(Str::lower(trim($value)));
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (in_array($key, static::$normalizeTextFields ?? [])) {
            return is_string($value) ? self::normalizeString($value) : $value;
        }
        return $value;
    }

    public function normalizeField(string $field, string $value): void
    {
        $this->attributes[$field] = self::normalizeString($value);
    }
}
