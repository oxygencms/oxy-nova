<?php

namespace Oxygencms\OxyNova\Models;

use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Oxygencms\OxyNova\Traits\DefaultMediaConversions;

class Page extends Model implements HasMedia
{
    use HasTranslations,
        SoftDeletes,
        HasMediaTrait;

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
        return self::getViewsList('layouts');
    }

    /**
     * Get a list of all page templates and their root.
     *
     * @return array
     */
    public static function getTemplates()
    {
        return self::getViewsList('pages');
    }

    /**
     * @param $string
     * @return array
     */
    public static function getViewsList($string): array
    {
        $list = [];

        foreach (File::files(self::getViewsPath($string)) as $view) {
            array_push($list, substr($view->getFilename(), 0, -10));
        }

        return array_combine($list, $list);
    }

    /**
     * Get the path to the views.
     *
     * @param string $string
     * @return string
     */
    public static function getViewsPath(string $string): string
    {
        return file_exists($dir = resource_path("views/vendor/oxygen/$string"))
            ? $dir
            : base_path("vendor/oxygencms/oxy-nova/resources/views/$string");
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
        return $this->hasMany(OXYGEN_PAGE_SECTION);
    }

    /**
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('images')
             ->acceptsFile(function ($file) {
                 return in_array($file->mimeType, ['image/jpeg', 'image/bmp', 'image/png', 'image/svg+xml']);
             })
             ->registerMediaConversions(function (Media $media) {
                 $this->addMediaConversion('thumb')->width(160);
//                 $this->addMediaConversion('xs')->width(320);
//                 $this->addMediaConversion('sm')->width(640);
//                 $this->addMediaConversion('md')->width(1280);
                 $this->addMediaConversion('lg')->width(1920);
             });
    }
}
