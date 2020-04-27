<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
use Session;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:web');
    }
    
    public function index()
    {
        $posts = Post::orderBy('created_at', 'asc')->paginate(5);
        return view('blog.index', ['posts'=>$posts, 'layout'=>'index']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::orderBy('created_at', 'asc')->paginate(5);
        return view('blog.index', ['posts'=>$posts, 'layout'=>'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->desc = $request->desc;

        if($request->hasFile('image'))
        {
            $ext = $request->file('image')->getClientOriginalExtension();
            $filename = time().'_'.$ext;
            $path = $request->file('image')->storeAs('public/images', $filename);
        }else{
            $filename = 'noimage.jpg';
        }
        
        $post->user_id = Auth::id();
        $post->image = $filename;

        $post->save();
        Session::flash('msg', 'New Post Created Successfully');
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::orderBy('created_at', 'asc')->paginate(5);
        $post = Post::find($id);
        return view('blog.index', ['layout'=>'show', 'posts'=>$posts, 'post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::orderBy('created_at', 'asc')->paginate(5);
        $post = Post::find($id);
        return view('blog.index', ['layout'=>'edit', 'posts'=>$posts, 'post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $posts = Post::orderBy('created_at', 'asc')->paginate(5);
        $post = Post::find($id);

        if(Auth::id() == $post->user_id)
        {
            if($request->hasFile('image'))
            {
                $ext = $request->file('image')->getClientOriginalExtension();
                $filename = time().'_'.$ext;
                $path = $request->file('image')->storeAs('public/images', $filename);
                $post->image = $filename;
            }
    
            $post->title = $request->title;
            $post->desc = $request->desc;
    
            $post->save();
            Session::flash('msg', 'Post Updated Successfully');
            return redirect('/posts');
        }
        else
        {
        Session::flash('error', 'This post does not belong to the current user');
        return redirect('/posts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::Find($id);
        if(Auth::id() == $post->user_id)
        {
            if($post->image != 'noimage.jpg')
            {
                Storage::delete('public/images/'.$post->image);
            }
            $post->delete();
            Session::flash('msg', 'Post Deleted Successfully');
            return redirect('/posts');
        }
        else
        {
            Session::flash('error', 'This post does not belong to the current user');
            return redirect('/posts');
        }
    }
}