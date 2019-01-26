@extends("oxygen::layouts.$page->layout")

@section('title', $page->title)

@section('content')

    <div class="container">
        @include('oxygen::pages._page_info')
    </div>

@endsection