@extends("oxygen::layouts.$page->layout")

@section('title', $page->title)

@section('content')

    <h1>{{ $page->title }}</h1>
    <h2>{{ $page->summary }}</h2>
    <h3>{{ $page->body }}</h3>
    <hr>

    <pre>app locale: {{ app()->getLocale() }}</pre>
    <pre>session locale: {{ session('app_locale') }}</pre>

@endsection