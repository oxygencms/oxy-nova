<?php

namespace Oxygencms\OxyNova\Models;

use Oxygencms\OxyNova\MediaCollections;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model implements HasMedia
{
    use HasTranslations, SoftDeletes, InteractsWithMedia;

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
    public function registerMediaCollections(): void
    {
        MediaCollections::images($this);
    }
}
