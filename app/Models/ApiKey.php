<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ApiKey extends Model
{
    use SoftDeletes;

    const EVENT_NAME_CREATED     = 'created';
    const EVENT_NAME_ACTIVATED   = 'activated';
    const EVENT_NAME_DEACTIVATED = 'deactivated';
    const EVENT_NAME_DELETED     = 'deleted';

    protected $table = 'api_keys';

    protected $fillable = [
        'user_id',
        'key',
    ];

    public function accessEvents()
    {
        return $this->hasMany(ApiKeyAccessEvent::class, 'api_key_id');
    }

    public function adminEvents()
    {
        return $this->hasMany(ApiKeyAdminEvent::class, 'api_key_id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (ApiKey $apiKey) {
            self::logApiKeyAdminEvent($apiKey, self::EVENT_NAME_CREATED);
        });

        static::updated(function ($apiKey) {

            $changed = $apiKey->getDirty();

            if (isset($changed) && $changed['active'] === 1) {
                self::logApiKeyAdminEvent($apiKey, self::EVENT_NAME_ACTIVATED);
            }

            if (isset($changed) && $changed['active'] === 0) {
                self::logApiKeyAdminEvent($apiKey, self::EVENT_NAME_DEACTIVATED);
            }
        });

        static::deleted(function ($apiKey) {
            self::logApiKeyAdminEvent($apiKey, self::EVENT_NAME_DELETED);
        });
    }

    public static function generate()
    {
        do {
            $key = "api" . Str::random(61);
        } while (self::keyExists($key));

        return $key;
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

    public static function keyExists($key)
    {
        return self::where('key', $key)->withTrashed()->first() instanceof self;
    }

    protected static function logApiKeyAdminEvent(ApiKey $apiKey, $eventName)
    {
        $event             = new ApiKeyAdminEvent;
        $event->api_key_id = $apiKey->id;
        $event->ip_address = request()->ip();
        $event->event      = $eventName;
        $event->save();
    }
}
