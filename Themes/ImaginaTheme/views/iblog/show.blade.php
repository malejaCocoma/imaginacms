@extends('layouts.master')
@section('meta')
    @if(isset($category->id))
        @include('iblog::frontend.partials.category.metas')
    @endif
@stop
@section('title')
    {{isset($category->title)? $category->title: trans("iblog::routes.blog.index.index")}}  | @parent
@stop
@section('content')
    @include('partials.main-breadcrumb')
    <div class="container show-post my-4">
        <div class="content">
            @if (!empty($post->files[0]->path))
                <div>
                    <h3>{{$post->title}}</h3>
                    <div class="main-img-post text-center py-3">
                        <x-media::single-image :isMedia="true" :mediaFiles="$post->mediaFiles()"/>
                    </div>
                </div>
                <div>
                    {!!$post->description!!}
                </div>
            @else
                <div class="col-12">
                    <h3>{{$post->title}}</h3>
                    {!!$post->description!!}
                </div>
            @endif
        </div>
    </div>
@stop