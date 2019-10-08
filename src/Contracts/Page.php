<?php

namespace Oxygencms\OxyNova\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface Page
{
    /**
     * Query the Slug json column of the model to get a page.
     *
     * @param string $locale
     * @param Builder $query
     * @param string $slug
     *
     * @return Builder
     */
    public function scopeBySlug(Builder $query, string $slug, string $locale = null): Builder;

    /**
     * Get a list of all layouts and their root.
     *
     * @return array
     */
    public static function getLayouts(): array;

    /**
     * Get a list of all page templates and their root.
     *
     * @return array
     */
    public static function getTemplates(): array;

    /**
     * @param $string
     * @return array
     */
    public static function getViewsList($string): array;

    /**
     * Get the path to the views.
     *
     * @param string $string
     * @return string
     */
    public static function getViewsPath(string $string): string;

    /**
     * @return bool|null|void
     * @throws \Exception
     */
    public function delete();

    /**
     * When restoring a page restore it's sections as well.
     */
    public function restore();

    /**
     * @return HasMany
     */
    public function sections(): HasMany;

    /**
     * @return void
     */
    public function registerMediaCollections(): void;
}
