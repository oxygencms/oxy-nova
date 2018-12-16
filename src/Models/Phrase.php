<?php

namespace Oxygencms\OxyNova\Models;

use Spatie\Translatable\HasTranslations;

class Phrase extends Model
{
    use HasTranslations;

    /**
     * Attributes that should be mass assignable.
     *
     * @var array
     */
    public $fillable = ['group', 'key', 'message'];

    /**
     * Attributes that should be translatable.
     *
     * @var array
     */
    public $translatable = ['message'];

    /**
     * Get a group of phrases.
     *
     * @param string $group
     *
     * @return array
     */
    public static function getGroup(string $group): array
    {
        return static::query()
                     ->where('group', $group)
                     ->pluck('message', 'key')
                     ->all();
    }

    /**
     * Get the available phrase groups.
     *
     * @return array
     */
    public static function getGroups(): array
    {
        $groups = config('oxygen.phrase_groups');

        return array_combine($groups, $groups);
    }
}
