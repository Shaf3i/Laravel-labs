<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

class PostsController extends Controller
{
    public function index()
    {
        return view("posts.index", ["posts" => Post::simplePaginate(5)]);
    }

    public function create()
    {
        return view("posts.create", ["users" => User::all()]);
    }

    public function store(StorePostRequest $request)
    {
        $path = Storage::putFile('posts', $request->file('image'));
        Post::create($request->only(['title' , 'description' , 'user_id']) +  ["image_name" => $path]);
        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Post $post, UpdatePostRequest $request)
    {
        $path = Storage::putFile('posts', $request->file('image'));
        Post::findOrFail($post->id)->update($request->only(['title' , 'description' , 'user_id']) + ["image_name" => $path]);
        Storage::delete($post->image_name);
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        Post::findOrFail($post->id)->delete();
        Storage::delete($post->image_name);
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }
}
