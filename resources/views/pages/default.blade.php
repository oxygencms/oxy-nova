@extends("oxygen::layouts.$page->layout")

@section('title', $page->title)

@section('content')

    <h1>Examples:</h1>

    <legend>Pages</legend>
    <ul>
        <li>
            <strong>Summary:</strong> {{ $page->summary }}
        </li>
        <li>
            <strong>Body:</strong> {!! $page->body !!}
        </li>
    </ul>

    <legend>Phrases</legend>
    <ul>
        <li>@lang('db.with @lang()')</li>
        <li>{{ __('db.with __()') }}</li>
        <li>{{ trans('db.with trans()') }}</li>
        <li>{{ trans_choice('db.with trans_choice()', rand(1, 2)) }}</li>
    </ul>

    <pre>app locale: {{ app()->getLocale() }}</pre>
    <pre>session locale: {{ session('app_locale') }}</pre>

@endsection