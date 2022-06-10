<form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="delete-form">
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger">Delete</button>
</form>