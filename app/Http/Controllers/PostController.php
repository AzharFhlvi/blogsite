<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('post');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function home()
    {
        $posts = Post::where('published', 1)->orderBy('published_at', 'desc')->paginate(5);
        return view('blog', compact('posts'));
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', auth()->user()->id)->orderBy('published_at', 'desc')->paginate(5);
        
        return view('post.my-posts', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {;
        $validated = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
        ]);
         
        $validated['image'] = $request->file('image')->store('images');
        $validated['body'] = $request->body;
        $validated['slug'] = \Str::slug($validated['title']);
        $validated['user_id'] = auth()->user()->id;
        if($request->publish){
            $validated['published'] = 1;
            $validated['published_at'] = Carbon::now();
        }

        $post = Post::create($validated);
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $post->addMediaFromRequest('image')->toMediaCollection('image');
        }

        flash()->addSuccess('Post created successfully!');

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $media = $post->getFirstMedia('image');
        
        return view('post.show', compact('post', 'media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $media = $post->getFirstMedia('image');
        
        return view('post.edit', compact('post', 'media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $validated = $request->validate([
            'title' => 'required|max:255|unique:posts,title,'.$post->id,
            'subtitle' => 'required|max:255',
        ]);

        $validated['body'] = $request->body;
        $validated['slug'] = \Str::slug($validated['title']);
        $validated['user_id'] = auth()->user()->id;
        if($request->publish){
            $validated['published'] = 1;
            $validated['published_at'] = Carbon::now();
        } else {
            $validated['published'] = 0;
            $validated['published_at'] = null;
        }

        $post->update($validated);

        if($request->hasFile('image') && $request->file('image')->isValid()){
            // remove the previous image
            $post->clearMediaCollection('image');
            // then add new image
            $post->addMediaFromRequest('image')->toMediaCollection('image');
        }

        flash()->addSuccess('Post updated successfully!');

        return redirect()->route('posts.my-posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $media = $post->getFirstMedia('image');
        $media->delete();
        $post->delete();

        flash()->addSuccess('Post deleted successfully!');

        return redirect()->route('posts.my-posts');
    }

    public function publish(Post $post)
    {
        if($post->published){
            $post->published = 0;
            $post->published_at = null;
        } else {
            $post->published = 1;
            $post->published_at = Carbon::now();
        }

        $post->save();

        flash()->addSuccess('Post published successfully!');

        return redirect()->route('posts.my-posts');
    }
}
