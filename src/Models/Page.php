<?php

namespace Oxygencms\OxyNova\Models;

use Illuminate\Support\Facades\File;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasTranslations, SoftDeletes;

    /**
     * @var array $guarded
     */
    public $fillable = [
        'active',
        'name',
        'layout',
        'template',
        'slug',
        'title',
        'meta_keywords',
        'meta_description',
        'meta_tags',
        'summary',
        'body',
    ];

    /**
     * @var array $translatable
     */
    public $translatable = [
        'slug',
        'title',
        'summary',
        'body',
        'meta_keywords',
        'meta_description',
        'meta_tags',
    ];

    /**
     * Query the Slug json column of the model to get a page.
     *
     * @param string  $locale
     * @param Builder $query
     * @param string  $slug
     *
     * @return Builder
     */
    public function scopeBySlug(Builder $query, string $slug, string $locale = null)
    {
        $locale = $locale ?: app()->getLocale();

        return $query->where("slug->$locale", $slug);
    }

    /**
     * Get a list of all layouts and their root.
     *
     * @return array
     */
    public static function getLayouts()
    {
        return self::getViewsList('layout');
    }

    /**
     * Get a list of all page templates and their root.
     *
     * @return array
     */
    public static function getTemplates()
    {
        return self::getViewsList('template');
    }

    /**
     * @param $string
     * @return array
     */
    public static function getViewsList($string): array
    {
        $list = [];

        $path = file_exists($dir = config('oxygen.page_' . $string . 's_path'))
            ? $dir
            : config('oxygen.page_' . $string . 's_package_path');

        foreach (File::files($path) as $view) {
            array_push($list, substr($view->getFilename(), 0, -10));
        }

        return array_combine($list, $list);
    }

    /**
     * Do not allow the home page to be deleted
     * and soft delete all page sections.
     *
     * @return bool|null|void
     * @throws \Exception
     */
    public function delete()
    {
        if ($this->name == 'home') {
            throw new \Exception('Cannot delete the home page!');
        }
        $this->sections->each->delete();

        parent::delete();
    }

    /**
     * When restoring a page restore it's sections as well.
     */
    public function restore()
    {
        $sections = PageSection::onlyTrashed()->where('page_id', $this->id)->get();

        if ($sections->isNotEmpty()) {
            $sections->each->restore();
        }

        parent::restore();
    }

    /**
     * @return HasMany
     */
    public function sections(): HasMany
    {
        return $this->hasMany(config('oxygen.page_section_model'));
    }
}