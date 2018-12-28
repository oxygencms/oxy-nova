<?php

namespace Oxygencms\OxyNova\Models;

use Oxygencms\OxyNova\MediaCollections;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model implements HasMedia
{
    use HasTranslations, SoftDeletes, HasMediaTrait;

    /**
     * @var array $fillable
     */
    protected $fillable = ['name', 'body', 'page_id'];

    /**
     * @var array $translatable
     */
    protected $translatable = ['body'];

    /**
     * @var array $touches
     */
    protected $touches = ['page'];

    /**
     * The page that owns this section.
     *
     * @return BelongsTo
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(OXYGEN_PAGE);
    }

    /**
     * @return void
     */
    public function registerMediaCollections()
    {
        MediaCollections::images($this);
    }
}
