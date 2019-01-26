<div class="jumbotron">
    <h1 class="display-4">Page title: {{ $page->title }}</h1>
    <br>
    <p class="lead">Page summary: {{ $page->summary }}</p>

    <hr class="my-4">
    <p class="lead">Page body</p> {!! $page->body !!}

    <hr class="my-4">
    <p class="lead">Page information</p>

    <dl class="row">
        <dt class="col-sm-2">App locale:</dt>
        <dd class="col-sm-10">{{ app()->getLocale() }}</dd>

        <dt class="col-sm-2">Page name:</dt>
        <dd class="col-sm-10">{{ $page->name }}</dd>

        <dt class="col-sm-2">Page layout:</dt>
        <dd class="col-sm-10">{{ $page::getViewsPath('layouts') .'/'. $page->layout .'.blade.php' }}</dd>

        <dt class="col-sm-2">Page template:</dt>
        <dd class="col-sm-10">{{ $page::getViewsPath('pages') .'/'. $page->template .'.blade.php' }}</dd>

        <dt class="col-sm-2">Page SEO:</dt>
        <dd class="col-sm-10">
            <br>
            <dl class="row">
                <dt class="col-sm-2">Slug:</dt>
                <dd class="col-sm-10">{{ $page->slug }}</dd>

                <dt class="col-sm-2">Title:</dt>
                <dd class="col-sm-10">{{ $page->title }}</dd>

                <dt class="col-sm-2">Meta description:</dt>
                <dd class="col-sm-10">{{ $page->meta_description }}</dd>

                <dt class="col-sm-2">Meta keywords:</dt>
                <dd class="col-sm-10">{{ $page->meta_keywords }}</dd>
            </dl>
        </dd>

        <dt class="col-sm-2">Page media collections:</dt>
        <dd class="col-sm-10">
            <br>
            <dl class="row">
                <dt class="col-sm-2">Images:</dt>
                <dd class="col-sm-10">
                    <div class="row">
                        @forelse($page->getMedia('images') as $image)
                            <div class="col-sm-2">
                                <img class="img-fluid" src="{{ $image->getFullUrl('thumb') }}" alt="image">
                            </div>
                        @empty
                            <div class="col-sm-12">
                                <p>The media collection is empty!</p>
                            </div>
                        @endforelse
                    </div>
                </dd>
            </dl>
        </dd>

        <dt class="col-sm-2">Page sections:</dt>
        <dd class="col-sm-10">
            <br>
            @foreach($page->sections as $section)
                <dl class="row">
                    <dt class="col-sm-2">Name:</dt>
                    <dd class="col-sm-10">{{ $section->name }}</dd>

                    <dt class="col-sm-2">Active:</dt>
                    <dd class="col-sm-10">{{ $section->active ? 'true' : 'false' }}</dd>

                    <dt class="col-sm-2">Section media:</dt>
                    <dd class="col-sm-10">
                        <dl class="row">
                            <dt class="col-sm-2">Images:</dt>
                            <dd class="col-sm-10">
                                <div class="row">
                                    @forelse($section->getMedia('images') as $image)
                                        <div class="col-sm-2">
                                            <img class="img-fluid" src="{{ $image->getFullUrl('thumb') }}" alt="image">
                                        </div>
                                    @empty
                                        <div class="col-sm-12">
                                            <p>The media collection is empty!</p>
                                        </div>
                                    @endforelse
                                </div>
                            </dd>
                        </dl>
                    </dd>
                </dl>
            @endforeach
        </dd>
    </dl>
</div>