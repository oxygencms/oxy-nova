<?php

namespace Oxygencms\OxyNova\Services;

use Oxygencms\OxyNova\Models\Phrase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Translation\FileLoader;

class PhraseLoader extends FileLoader
{
    /**
     * Search for a group of phrases in the database and cache them then
     * fetch the translations from files and merge them in such a
     * way that phrases take precedence over the translations.
     *
     * @param string $locale
     * @param string $group
     * @param string $namespace
     *
     * @return array
     */
    public function load($locale, $group, $namespace = null)
    {
        $phrases = Cache::tags('phrases')
                        ->remember("phrases.{$group}.{$locale}", 60, function () use ($group) {
                            return Phrase::getGroup($group);
                        });

        $translations = parent::load($locale, $group, $namespace);

        return array_merge($translations, $phrases);
    }
}