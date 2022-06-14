@extends('layouts.app')

@section('content')

<div class="p-3">
    @if (session('message'))
    <div class="alert alert-primary">
        {!!session('message')!!}
    </div>
    @endif
    
    <a href="{{ route('admin.posts.create') }}" class="btn btn-success mb-3">New Post</a>

    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Content</th>
                <th scope="col">Image</th>
                <th scope="col">Platforms</th>
                <th scope="col">Firm</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr>

                <td>
                    <p>{{ $post->title }}</p>
                </td>

                <td>
                    @if ($post->Category)
                    <span class="badge badge-{{$post->Category->color}}">{{$post->Category->name}}</span>
                    @else
                    ----
                    @endif
                </td>

                <td>
                    <p>{{ $post->content }}</p>
                </td>

                <td>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="" width="50px">
                </td>

                <td>
                    @foreach ($post->platforms as $platform)
                        <img src="{{$platform->icon}}" alt="" class="mr-2" width="20px">
                    @endforeach
                </td>

                <td>
                    <p class="font-italic">{{ $post->firm }}</p>
                </td>

                <td class="d-flex">
                    <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary mr-2">View</a>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-success mr-2">Edit</a>
                    @include('includes.deletePost')
                </td>

            </tr>
            @empty
            <h2 class="text-center py-5">Non ci sono post da visualizzate</h2>
            @endforelse
        </tbody>
    </table>

    @if ( $posts -> hasPages() )
    {{ $posts -> links() }}
    @endif
    
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/deleteForm.js') }}"></script>
@endsection
