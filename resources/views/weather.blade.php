@extends('layouts.app')

@section('content')
<div class="container">
    Burası Weather
</div>

<div>
{{ dd($info); }}
</div>
@endsection
