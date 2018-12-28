@extends("oxygen::layouts.$page->layout")

@section('title', $page->title)

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $page->title }}</h3>
                    </div>

                    <div class="card-body">
                        <strong>Application info</strong>
                        <hr>
                        <pre>app locale: {{ app()->getLocale() }}</pre>
                        <pre>session locale: {{ session('app_locale') }}</pre>

                        <strong>Page system info</strong>
                        <hr>
                        <pre>name: {{ $page->name }}</pre>
                        <pre>layout: {{ $page::getViewsPath('layouts') .'/'. $page->layout .'.blade.php' }}</pre>
                        <pre>template: {{ $page::getViewsPath('pages') .'/'. $page->template .'.blade.php' }}</pre>

                        <strong>Page meta data</strong>
                        <hr>
                        <pre>meta description: {{ $page->meta_description }}</pre>
                        <pre>meta keywords: {{ $page->meta_keywords }}</pre>

                        <strong>Page content</strong>
                        <hr>
                        <pre>sections: {{ $page->sections->pluck('name')->implode(', ') }}</pre>
                        <pre>summary: {{ $page->summary }}</pre>
                        <pre>body:</pre>{!! $page->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection