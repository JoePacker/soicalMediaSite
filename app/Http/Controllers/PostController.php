<?php

namespace App\Http\Controllers;

use App\Post;
use App\Services\Weather;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', ['posts' => Post::orderBy('created_at', 'desc')->paginate(9)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', 'App\Post');

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', 'App\Post');

        $request->validate([
            'title' => 'required|max:255',
            'city' => 'required|max:50',
            'body' => 'required|max:5000',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->city = $request->city;
        $post->body = $request->body;

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images/posts', 'public');
        }

        $request->user()->posts()->save($post);

        return redirect()->route('posts.show', ['post' => $post])->with('status', 'The post was successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @param  \App\Services\Weather $weather
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Weather $weather)
    {
        $data['post'] = $post;

//        $weather_data = $weather->getWeatherByCity($post->city);
//
//        if ($weather_data->cod === 200) {
//            $data['weather']['description'] = ucfirst(reset($weather_data->weather)->description);
//            $data['weather']['icon'] = reset($weather_data->weather)->icon;
//            $data['weather']['temperature'] = round($weather_data->main->temp - 273.15);
//        }

        return view('posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|max:255',
            'city' => 'required|max:50',
            'body' => 'required|max:5000',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post->title = $request->title;
        $post->city = $request->city;
        $post->body = $request->body;

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images/posts', 'public');
        }

        $post->save();

        return redirect()->route('posts.show', ['post' => $post])->with('status', 'The post was successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('status', 'The post was successfully deleted');
    }
}
