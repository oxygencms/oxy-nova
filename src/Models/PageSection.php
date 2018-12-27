<?php

namespace Oxygencms\OxyNova\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model
{
    use HasTranslations, SoftDeletes;

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
        return $this->belongsTo(config('oxygen.page_model'));
    }
}
