@extends('layout.layout')
@section('title', 'Bài viết')
@section('content')
    <!-- START MAIN -->
    <div class="container py-5">
        <div class="container_blog">
            {!! $article->description !!}
        </div>
    </div>
    <!-- END MAIN -->
@endsection
