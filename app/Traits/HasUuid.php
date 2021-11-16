<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{

    protected $isLockedUuid = true;

    public function getKeyType()
    {
        return 'string';
    }

    public function getIncrementing()
    {
        return false;
    }

    public static function bootHasUuid()
    {
        static::creating(function (Model $model) {
            $model->keyType = 'string';
            $model->incrementing = false;

            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string)Str::uuid();
            }
        });

        static::saving(function (Model $model) {
            $original_id = $model->getOriginal('id');
            if (!is_null($original_id) && $model->isLockedUuid) {
                if ($original_id !== $model->id) {
                    $model->id = $original_id;
                }
            }
        });
    }
}
