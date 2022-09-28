@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="card-header">{{ $post->title }}
                    @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}"
                       class="btn btn-sm btn-warning">{{ __('Edit Post') }}</a>
                    @endcan
                </div>

                <div class="card-body">{{ $post->content }}</div>

                <div class="card-body">
                    {{ __('Tags') }} :
                    @foreach ($post->tags as $tag)
                    {{ $tag->name }}
                    @endforeach

                    <br>
                 {{ __('Category') }} : <a
                 href="{{ route('posts.index', ['category' => $post->category->id]) }}">{{ $post->category->name }}</a>
                    <br>
                {{ __('Author') }} : <a href="{{ route('posts.index', ['user' => $post->user->id]) }}">
                    {{ $post->user->name }}
                </a>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
