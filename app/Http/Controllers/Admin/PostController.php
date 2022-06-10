<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\Category;
use App\Models\Platform;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::orderBy('updated_at', 'DESC') -> paginate(4);

        return view('admin.posts.index', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $platforms = Platform::all();
        
        return view('admin.posts.create', compact('categories', 'platforms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validazione
        $request -> validate(
            [
                'title' => 'required',
                'content' => 'required',
                'firm' => 'required',
            ]
        );

        $data = $request->all();

        $post = new Post();

        $post -> fill($data);
        $post -> slug = Str::slug($post->title, '-');
        
        $post -> save();
        
        $post -> platforms() -> attach($data['platforms']);

        return redirect() -> route('admin.posts.index') -> with('message', "Hai creato con successo il post di <span class='font-italic'>$post->firm</span>");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Validazione
        $request -> validate(
            [
                'title' => 'required',
                'content' => 'required',
                'firm' => 'required',
            ]
        );
        
        $data = $request->all();
        $post['slug'] = Str::slug($post->title, '-');
        $post -> update($data);

        return redirect() -> route('admin.posts.index') -> with('message', "Hai modificato con successo il post di <span class='font-italic'>$post->firm</span>");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect() -> route('admin.posts.index') -> with('message', "Hai cancellato con successo il post di <span class='font-italic'>$post->firm</span>");
    }
}
