<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'value'])]
class SystemSetting extends Model
{
    use HasFactory;

    /**
     * Get system setting value by key, with dynamic fallback.
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        if ($setting) {
            return $setting->value;
        }

        // Try falling back to company config if applicable
        if (config()->has("company.{$key}")) {
            return config("company.{$key}");
        }

        return $default;
    }
}
