<?php

namespace Oxygencms\OxyNova\Observers;

use Oxygencms\OxyNova\Models\Phrase;
use Illuminate\Support\Facades\Cache;

class PhraseObserver
{
    /**
     * Handle the phrase "created" event.
     *
     * @param Phrase $phrase
     *
     * @return void
     */
    public function created(Phrase $phrase)
    {
        Cache::tags('phrases')->flush();
    }

    /**
     * Handle the phrase "updated" event.
     *
     * @param Phrase $phrase
     *
     * @return void
     */
    public function updated(Phrase $phrase)
    {
        Cache::tags('phrases')->flush();
    }

    /**
     * Handle the phrase "deleted" event.
     *
     * @param Phrase $phrase
     *
     * @return void
     */
    public function deleted(Phrase $phrase)
    {
        Cache::tags('phrases')->flush();
    }
}
