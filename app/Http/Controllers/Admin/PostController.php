<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Category;
use App\Models\Platform;
use App\Mail\SendEditMail;
use App\Mail\SendCreateMail;

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
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(5);

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
        // Recupero dati user loggato
        $user = Auth::user();

        // Reucpero dati form
        $data = $request->all();
        // dd($data);

        // Se è stata caricata un immagine...
        if( array_key_exists('image', $data) ){
            $img_path = Storage::put('post_images', $data['image']);
            $data['image'] = $img_path;
        }

        $post = new Post();

        // Riempio i campi della tabella posts
        $post -> fill($data);
        $post -> slug = Str::slug($post->title, '-');

        // Salvo i dati
        $post -> save();
        
        // Se presenti delle piattaforme allora riprendo i rispettivi campi
        if( array_key_exists( 'platforms', $data ) ) $post -> platforms() -> attach($data['platforms']);

        // Invio email
        $new_email = new SendCreateMail($post);
        Mail::to($user->email)->send($new_email);

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
        $platforms = Platform::all();
        $posts_platform_id = $post -> platforms->pluck('id')->toArray();

        return view('admin.posts.edit', compact('post', 'categories', 'platforms', 'posts_platform_id'));
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
        // Recupero dati user loggato
        $user = Auth::user();

        // Recupero dati del form
        $data = $request->all();

        if( array_key_exists('image', $data) ){
            if($post->image) Storage::delete($post->image);
            $img_path = Storage::put('post_images', $data['image']);
            $data['image'] = $img_path;
        }

        $post['slug'] = Str::slug($post->title, '-');

        // Aggiorno i dati
        $post -> update($data);
        
        if( array_key_exists( 'platforms', $data ) ) $post -> platforms() -> sync($data['platforms']);
        else $post -> platforms() -> detach();
        
        // Invio email
        $new_email = new SendEditMail($post);
        Mail::to($user->email)->send($new_email);
        
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
