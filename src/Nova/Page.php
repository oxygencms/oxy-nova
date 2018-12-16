<?php

namespace Oxygencms\OxyNova\Nova;

use App\Rules\RequiredTranslations;
use App\Rules\UniqueTranslations;
use Illuminate\Support\Facades\Validator;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use MrMonat\Translatable\Translatable;

class Page extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Oxygencms\OxyNova\Models\Page';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['name', 'title', 'slug'];

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string
     */
    public function subtitle()
    {
        return "Slug: {$this->slug}";
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     * @throws \Exception
     */
    public function fields(Request $request)
    {
        $layouts     = $this::getLayouts();
        $templates   = $this::getTemplates();
        $name_format = '/^[a-z_-]+$/u';

        return [
            ID::make('id')->onlyOnDetail(),

            Boolean::make('Active'),

            Text::make('System name', 'name')
                ->rules('required', 'string', "regex:$name_format", 'max:140')
                ->creationRules('unique:pages')
                ->updateRules("unique:pages,name,{{resourceId}}"),

            Select::make('Layout')
                  ->options($layouts)
                  ->rules('required', 'string', 'in:' . implode(',', $layouts))
                  ->hideFromIndex(),

            Select::make('Template')
                  ->options($templates)
                  ->rules('required', 'string', 'in:' . implode(',', $templates))
                  ->hideFromIndex(),

            new Panel('SEO', $this->getSeoPanelFields($request)),

            new Panel('Content', $this->getContentPanelFields()),
        ];
    }

    /**
     * Define the SEO panel's fields.
     *
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    private function getSeoPanelFields(Request $request)
    {
        return [
            Translatable::make('Slug')
                        ->rules('required', 'array', 'distinct', function ($attribute, $value, $fail) use ($request) {
                            $slug_format = '/^[а-я0-9a-z-\/]+$/u';

                            $slug_rules = ['required', 'string', 'max:140', "regex:$slug_format"];

                            $request->isMethod('post')
                                ? array_push($slug_rules, "unique_translation:pages")
                                : array_push($slug_rules, "unique_translation:pages,slug,$request->resourceId");

                            $validator = Validator::make([$attribute => $value], ["{$attribute}.*" => $slug_rules]);

                            if ($validator->fails())
                                $fail($validator->errors()->first());
                        })
                        ->singleLine(),

            Translatable::make('Title')
                        ->singleLine()
                        ->hideFromIndex(),

            Translatable::make('Meta description')
                        ->singleLine()
                        ->hideFromIndex(),

            Translatable::make('Meta keywords')
                        ->singleLine()
                        ->hideFromIndex(),
        ];
    }

    /**
     * Define the content panel's fields.
     *
     * @return array
     */
    private function getContentPanelFields()
    {
        return [
            Translatable::make('Summary')
                        ->hideFromIndex(),

            Translatable::make('Body')
                        ->trix()
                        ->hideFromIndex()
                        ->hideFromDetail(),

            Translatable::make('Body')->onlyOnDetail()->asHtml(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
