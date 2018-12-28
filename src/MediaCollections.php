<?php

namespace Oxygencms\OxyNova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;

abstract class MediaCollections
{
    /**
     * @var string $helpText
     */
    public static $helpText = '<strong>Note:</strong> Newly uploaded files may take a while to be processed in the background!';

    /**
     * Add images media collection to a model.
     *
     * @param HasMedia $model
     * @return void
     */
    public static function images(HasMedia $model)
    {
        $model->addMediaCollection('images')
              ->acceptsFile(function ($file) {
                  return in_array($file->mimeType, ['image/jpeg', 'image/bmp', 'image/png', 'image/svg+xml']);
              })
              ->registerMediaConversions(function () use ($model) {
                  $model->addMediaConversion('thumb')->width(160);
                  $model->addMediaConversion('xs')->width(320);
                  $model->addMediaConversion('sm')->width(640);
                  $model->addMediaConversion('md')->width(1280);
                  $model->addMediaConversion('lg')->width(1920);
              });
    }

    /**
     * Get the field for the 'images' media collection.
     *
     * @param Request $request
     * @return Images
     */
    public static function imagesField(Request $request): Images
    {
        return
            Images::make('Images', 'images')
                  ->conversionOnView('thumb')
                  ->thumbnail('thumb')
                  ->multiple()
                  ->fullSize()
                  ->rules('nullable', function ($attribute, $value, $fail) use ($request) {
                      $data = [$attribute => []];

                      if (is_array($value)) {
                          foreach ($value as $index => $val) {
                              if ( ! is_string($val)) {
                                  $data[$attribute][explode('.', $val->getClientOriginalName())[0]] = $value[$index];
                              }
                          }
                      } elseif ( ! is_string($value)) {
                          $data[$attribute][explode('.', $value->getClientOriginalName())[0]] = $value;
                      }

                      $validator = Validator::make($data, ["{$attribute}.*" => 'image']);

                      if ($validator->fails())
                          $fail($validator->errors()->first());
                  })
                  ->hideFromIndex()
                  ->help(self::$helpText);
    }
}