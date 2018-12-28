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
                        <br>
                        <strong>Application info</strong>
                        <hr>
                        <pre>app locale: {{ app()->getLocale() }}</pre>
                        <pre>session locale: {{ session('app_locale') }}</pre>


                        <br>
                        <strong>Page system info</strong>
                        <hr>
                        <pre>name: {{ $page->name }}</pre>
                        <pre>layout: {{ $page::getViewsPath('layouts') .'/'. $page->layout .'.blade.php' }}</pre>
                        <pre>template: {{ $page::getViewsPath('pages') .'/'. $page->template .'.blade.php' }}</pre>


                        <br>
                        <strong>Page SEO data</strong>
                        <hr>
                        <pre>slug: {{ $page->slug }}</pre>
                        <pre>title: {{ $page->title }}</pre>
                        <pre>meta description: {{ $page->meta_description }}</pre>
                        <pre>meta keywords: {{ $page->meta_keywords }}</pre>


                        <br>
                        <strong>Page content</strong>
                        <hr>
                        <pre>summary: {{ $page->summary }}</pre>
                        <pre>body:</pre> {!! $page->body !!}


                        <br>
                        <strong>Page media</strong>
                        <hr>
                        <pre><u>images</u> collection:</pre>
                        <div class="row">
                            @foreach($page->getMedia('images') as $image)
                                <div class="col-2">
                                    <img class="img-fluid" src="{{ $image->getFullUrl('thumb') }}" alt="image">
                                </div>
                            @endforeach
                        </div>


                        <br>
                        <strong>Page Sections</strong>
                        <hr>
                        @foreach($page->sections as $section)
                            <section>
                                <pre>active: {{ $section->active ? 'true' : 'false' }}</pre>
                                <pre>name: {{ $section->name }}</pre>
                                <div class="row">
                                    @foreach($section->getMedia('images') as $image)
                                        <div class="col-2">
                                            <img class="img-fluid" src="{{ $image->getFullUrl('thumb') }}" alt="image">
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection