@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $category->name }}
                    @auth

                    <a href="{{ route('categories.edit', $category) }}"
                    class="btn btn-sm btn-warning">{{ __('Edit Category') }}</a>
                    @if($category->isFollowedBy(Auth::id()))
                    <a href="{{ route('categories.unfollow', $category) }}"
                    class="btn btn-sm btn-danger">{{ __('UnFollow Category') }}</a>
                    @else
                    <a href="{{ route('categories.follow', $category) }}"
                    class="btn btn-sm btn-success">{{ __('Follow Category') }}</a>

                    @endif
                    @endauth
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($category->posts as $post)

                        <a href="{{ route('posts.show', $post) }}">
                            {{ $post->title }}
                        </a><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
