@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Categories') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="inpName" class="form-label">{{ __('Category Name') }}</label>
                            <input type="text" name="title" class="form-control" id="inpName">
                          </div>

                            <button type="submit" class="btn btn-primary">{{ __('Create Category') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
