@extends('layouts.app')

@section('title','Api Imagenes')

@section('content')

<div class="container">
    <div class="row">
        @foreach($resultados as $resultado)
            <div class="col-3">
                <div class="card mt-4">
                    <img src="{{ $resultado['thumbnailUrl'] }}" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $resultado['title'] }}</h5>
                        <p class="card-text">{{ $resultado['url'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection