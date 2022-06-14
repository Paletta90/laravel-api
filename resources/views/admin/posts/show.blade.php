@extends('layouts.app')

@section('content')
<div class="card w-50 m-auto">
    <div class="card-body text-center">

        <img class="card-img-top" src="{{ asset('storage/' . $post->image) }}" alt="Card image cap">

        <h5 class="card-title">{{ $post -> title }}</h5>

        <p class="card-text">{{ $post -> content }}</p>

        @if ($post->Category)
        <span class="badge badge-{{$post->Category->color}} mb-4">{{$post->Category->name}}</span>
        @endif

        <div class="mb-3">
            @foreach ($post->platforms as $platform)
            <img src="{{$platform->icon}}" alt="" class="mr-2" width="20px">
            @endforeach
        </div>

        <p class="font-italic">{{ $post -> firm }}</p>
        @include('includes.deletePost')

    </div>
</div>
@endsection
