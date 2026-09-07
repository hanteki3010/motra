<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'label',
        'group',
    ];

    /**
     * Get a setting value by key with a fallback
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value, $label = null, $group = 'contact')
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'label' => $label, 'group' => $group]
        );
    }
}
