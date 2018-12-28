<?php

namespace Oxygencms\OxyNova\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class Model extends EloquentModel
{
    /**
     * Define the default conversions in one place
     * and call the function from child models.
     *
     * @return void
     */
    public function registerDefaultMediaConversions(): void
    {
        //
    }
}
