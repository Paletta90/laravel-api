@extends('layouts.app')

@section('content')

<div class="w-50 m-auto">
    {{-- Errori validazioen --}}
    @if ( $errors -> any() )
    {{-- Se sono presenti errori backend --}}
    <div class="alert alert-danger">

        <ul>
            @foreach ($errors -> all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>

    </div>
    @endif
</div>

<form class="w-25 m-auto" action="{{ route('admin.posts.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content" placeholder="Content" cols="50" rows="5">{{ old('content') }}</textarea>
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <div>
            <select name="category_id" id="category">

                <option value="">Nessuna categoria</option>

                @foreach ($categories as $category)

                <option 
                @if ( old('category_id') == $category->id ) selected @endif
                value="{{ $category->id}}">{{$category->name}}
                </option>

                @endforeach

            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="text" class="form-control" id="image" name="image" placeholder="Url image" value="{{ old('image') }}">
    </div>

    <div class="form-group">
        <label for="firm">Firm</label>
        <input type="text" class="form-control" id="firm" name="firm" placeholder="Firm" value="{{ old('firm') }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Create</button>
    </div>

</form>
@endsection
