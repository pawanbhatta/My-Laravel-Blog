<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

use Symfony\Component\HttpFoundation\Response;

use App\Post;

use Auth;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api')->except('show', 'index');
    }
    public function index()
    {
        return PostCollection::collection(Post::paginate(10));
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

        if($request->hasFile('image'))
        {
            $ext = $request->file('image')->getClientOriginalExtension();
            $filename = time().'_'.$ext;
            $path = $request->file('image')->storeAs('public/images', $filename);
        }else{
            $filename = 'noimage.jpg';
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->desc = $request->desc;
        $post->image = $filename;

        $post->save();
        
        return Response([
            'message'   =>  'Post Created Successfully',
            'data'  =>  new PostResource($post),
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        if(Auth::id() == $post->user_id)//change id to user_id after refresh migration
        {
            $post->title = $request->title;
            $post->desc  =  $request->desc;
            if($request->hasFile('image'))
            {
                $ext = $request->file('image')->getClientOriginalExtension();
                $filename = time.'_'.$ext;
                $path = $request->file('image')->storeAs('public/images', $filename);
                $post->image = $filename;
            }
            $post->save();

            return Response([
                'message'   =>  'Post Updated Successfully',
                'data'  =>  new PostResource($post),
            ], Response::HTTP_CREATED);
        }else{
            return Response([
                'error' =>  'This Post does not belong to current user'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Auth::id() == $post->user_id)
        {
            $post->delete();
            return Response(null, Response::HTTP_NO_CONTENT);
        }else{
            return Response([
                'message'   =>  'Post Deleted Successfully',
                'error' =>  'This Post does not belong to current user'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}