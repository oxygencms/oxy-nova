<?php

namespace Oxygencms\OxyNova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Spatie\MediaLibrary\HasMedia;

abstract class MediaCollections
{
    public static $defaultConversions = [
        'thumb' => 160,
        'xs' => 320,
        'sm' => 640,
        'md' => 1280,
        'lg' => 1920,
    ];

    public static $mimes = [
        'image/jpeg', 'image/bmp', 'image/png', 'image/svg+xml'
    ];

    /**
     * Add images media collection to a model.
     *
     * @param HasMedia $model
     * @return void
     */
    public static function images(HasMedia $model): void
    {
        $model->addMediaCollection('images')
              ->acceptsFile(function ($file) {
                  return in_array($file->mimeType, self::$mimes);
              })
              ->registerMediaConversions(function () use ($model) {
                  foreach (self::$defaultConversions as $name => $width) {
                      $model->addMediaConversion($name)->width($width);
                  }
              });
    }

    /**
     * Add a main single image media collection to a model.
     *
     * @param HasMedia $model
     * @return void
     */
    public static function mainImage(HasMedia $model): void
    {
        $model->addMediaCollection('main')
              ->singleFile()
              ->acceptsFile(function ($file) {
                  return in_array($file->mimeType, self::$mimes);
              })
              ->registerMediaConversions(function () use ($model) {
                  foreach (self::$defaultConversions as $name => $width) {
                      $model->addMediaConversion($name)->width($width);
                  }
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
                  ->hideFromIndex()
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
                  });
    }

    /**
     * Get the field for the 'main' image media collection.
     *
     * @param string $fieldName
     * @param bool   $hideFromIndex
     * @return Images
     */
    public static function mainImageField(string $fieldName, bool $hideFromIndex = false): Images
    {
        $field = Images::make($fieldName, 'main')
                       ->conversionOnView('thumb')
                       ->thumbnail('thumb')
                       ->singleImageRules('');

        if ($hideFromIndex) {
            $field->hideFromIndex();
        }

        return $field;
    }
}
