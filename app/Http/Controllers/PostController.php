<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StorePostRequest;
//use App\Http\Requests\UpdatePostRequest;
use \Illuminate\Http\Response;
use \Illuminate\Http\Request;
use App\Http\Policies\PostPolicy;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
        $this->middleware('can:update,post')->only(['edit','update']);
        $this->middleware('can:delete,post')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $postsQuery = Post::with(['user', 'category'])->latest();
        if ($request->query('category')) $postsQuery->where('category_id', (int)$request->query('category'));
        if ($request->query('user')) $postsQuery->where('user_id', (int)$request->query('user'));
        $posts = $postsQuery->paginate(10)->withQueryString();

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('post.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //

        $post = new Post;
        $post->user_id = $request->user()->id;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        $post->setTags($request->tags);
/*
        Post::create($request->all());
        //etiketleri ekleyeceğiz
        if($request->tags){
            $tagstoAttach = explode(",", $request->tags);
            foreach ($tagsToAttach as $tagName ) {
                $tagName = trim($tagName);
                $tag = Tag::firstOrCreate([
                   'name' => $tagName
                ]);
                $post->tags()->attach($tag->id);
            }
        }
*/

        session()->flash('status', __('Post Created !'));

        return redirect()->route('posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        //
        $post = Post::with(['category','user','tags'])->findOrFail($post);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //

        $post->user_id = $request->user()->id;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        $post->setTags($request->tags);

        session()->flash('status', __('Post updated !'));

        return \redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();

        session()->flash('status', __('Post deleted !'));

        return \redirect()->route('posts.index');
    }
}
