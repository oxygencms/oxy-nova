<?php

namespace Oxygencms\OxyNova\Traits;

trait SortTranslatableFields
{
    /**
     * @param $query
     * @param array $orderings
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected static function applyOrderings($query, array $orderings)
    {
        $locale = app()->getLocale();
        $translatableAttributes = app(self::$model)->make()->getTranslatableAttributes();

        foreach ($orderings as $column => $direction) {
            if (in_array($column, $translatableAttributes)) {
                unset($orderings[$column]);
                $query->orderByRaw("`{$column}` -> '$.{$locale}' {$direction}");
            }
        }

        return parent::applyOrderings($query, $orderings);
    }
}
