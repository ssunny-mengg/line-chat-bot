<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->get('title');
        $post->description = $request->get('description') ?? "ไม่ระบุรายละเอียดเพิ่มเติม";
        $post->is_saleable = $request->get('is_saleable');
        $post->price = $request->get('price');
        $post->favorite_count = $request->get('favorite_count');
        $post->view_count = $request->get('view_count');
//        $post->user_id = $request->get('user_id');
        if ($post->save()) {
            Artisan::call('push:message', [
                'userId' => "U5b0e5d266e45ed20ebb219ef389a6ac0",
                'message' => $post->title
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Post saved successfully with id ' . $post->id,
                'post_id' => $post->id
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'success' => false,
            'message' => 'Post saved failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::find($id);
        return $posts;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if ($request->has('title')) $post->title = $request->get('title');
        if ($request->has('description')) $post->description = $request->get('description');
        if ($request->has('is_saleable')) $post->is_saleable = $request->get('is_saleable');
        if ($request->has('price')) $post->price = $request->get('price');
        if ($request->has('favorite_count')) $post->favorite_count = $request->get('favorite_count');
        if ($request->has('view_count')) $post->view_count = $request->get('view_count');
        if ($post->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully with id ' . $post->id,
                'post_id' => $post->id
            ], Response::HTTP_OK);
        }
        return response()->json([
            'success' => false,
            'message' => 'Post updated failed'
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post_title = $post->title;
        if ($post->delete()) {
            return response()->json([
                'success' => true,
                'message' => "Post {$post_title} deleted successfully"
            ], Response::HTTP_OK);
        }
        return response()->json([
            'success' => false,
            'message' => "Post {$post_title} deleted failed"
        ], Response::HTTP_BAD_REQUEST);
    }
}
