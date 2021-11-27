<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WidgetKey extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'key',
    ];

    public static function generate()
    {
        do {
            $key = "widget" . Str::random(58);
        } while (self::keyExists($key));

        return $key;
    }

    public static function keyExists($key)
    {
        return self::where('key', $key)->withTrashed()->first() instanceof self;
    }

    public static function getByKey($key)
    {
        return self::where([
            'key'    => $key,
            'active' => 1
        ])->first();
    }

    public static function isValidKey($key)
    {
        return self::getByKey($key) instanceof self;
    }

    public function user()
    {
        return $this->belongsTo(WidgetKey::class);
    }
}
