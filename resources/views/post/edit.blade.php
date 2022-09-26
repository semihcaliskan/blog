@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Posts') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('posts.update', $post) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="inpName" class="form-label">{{ __('Post Title') }}</label>
                            <input type="text" name="title" class="form-control" id="inpName" value="{{ $post->title }}">
                              @error('title')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <div class="mb-3">
                              <label for="inpName" class="form-label">{{ __('Post Content') }}</label>
                              <textarea type="text" name="content" class="form-control" id="inpName" row="2">{{ $post->content }}</textarea>
                              @error('content')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>

                            <div class="mb-3">
                              <label for="inpName" class="form-label">{{ __('Select Category') }}</label>
                            <select class="form-select" name="category_id">

                                @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if($post->category_id == $category->id) selected
                                    @endif>
                                    {{ $category->name }}
                                </option>
                                @endforeach

                            </select>
                            @error('category_id')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                          </div>

                            <button type="submit" class="btn btn-primary">{{ __('Update Post') }}</button>

                    </form>

                    @can('delete', $post)
                    <hr>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Delete Post') }}</button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

