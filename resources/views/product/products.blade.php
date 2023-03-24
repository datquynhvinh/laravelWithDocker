@extends('layouts.app')
@section('content')
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Shop here!</h1>
            </div>
        </div>
    </header>
    @foreach($products as $product => $item)
        <div style="display: flex; justify-content: center">
            <div>
                {{$item->name}}
            </div>
        </div>
    @endforeach
@endsection