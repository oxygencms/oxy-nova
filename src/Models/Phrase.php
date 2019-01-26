<?php

namespace Oxygencms\OxyNova\Models;

use Spatie\Translatable\HasTranslations;

class Phrase extends Model
{
    use HasTranslations;

    /**
     * @var array
     */
    public $fillable = ['group', 'key', 'message'];

    /**
     * @var array
     */
    public $translatable = ['message'];

    /**
     * Get a group of phrases.
     *
     * @param string $group
     * @param string $locale
     *
     * @return array
     */
    public static function getGroup(string $group, string $locale = null): array
    {
        $query = static::query()->where('group', $group);

        if (is_null($locale)) {
            return $query->pluck('message', 'key')->all();
        }

        return $query->get()->flatMap(function ($phrase) use ($locale) {
            return [$phrase->key => $phrase->getTranslation('message', $locale)];
        })->all();
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
