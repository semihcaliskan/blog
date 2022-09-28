@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Posts') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                            <div class="mb-3">
                              <label for="inpName" class="form-label">{{ __('Post Title') }}</label>
                              <input type="text" name="title" class="form-control" id="inpName" value="{{ old('title') }}">
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inpContent" class="form-label">{{ __('Post Content') }}</label>
                                <textarea type="text" name="content" class="form-control" id="inpContent" row="2">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                              </div>

                              <div class="mb-3">
                                <label for="inpTags" class="form-label">{{ __('Post Tags') }}</label>
                                <input type="text" name="tags" class="form-control" id="inpTags" value="{{ old('tags') }}"
                                    aria-describedby="tagsHelp">
                                <div id="tagsHelp" class="form-text">{{  __('Seperate with commas.') }}</div>
                                    </div>

                                @error('tags')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                  @enderror
                              </div>


                              <div class="mb-3">
                                <label for="inpName" class="form-label">{{ __('Select Category') }}</label>
                              <select class="form-select" name="category_id">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                              </select>
                              @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Create post') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
