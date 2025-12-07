<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value)
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    public static function getLogoUrl()
    {
        $logo = self::get('logo');
        return $logo ? asset('storage/logo/' . $logo) : null;
    }

    public static function getAboutImageUrl()
    {
        $image = self::get('about_image');
        return $image ? asset('storage/about/' . $image) : null;
    }

    public static function getQrisImageUrl()
    {
        $image = self::get('qris_image');
        return $image ? asset('storage/qris/' . $image) : null;
    }
}