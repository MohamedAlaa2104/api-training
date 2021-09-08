<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostsResource;
use App\Http\Traits\ApiResponse;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    use ApiResponse;

    public function index () {
        $data = PostsResource::collection(Post::get());

        return response($this->ApiResponse($data, 'ok', 200), 200);
    }

    public function show ($id) {
        $post = Post::find($id);

        if ( !$post )
            return response($this->ApiResponse(null, 'Post not found', 404), 404);

        $data = new PostsResource($post);

        return response($this->ApiResponse($data, 'ok', 200), 200);

    }

    public function store (Request $request) {

        if ( $this->postValidator($request) )
            return $this->postValidator($request);

        $post = Post::create( $request->all() );

        return response( $this->ApiResponse( new PostsResource( $post ), 'Post created successfully', 201 ), 201);

    }

    public function update (Request $request, $id) {

        if ( $this->postValidator($request) )
            return $this->postValidator($request);

        $post = Post::find($id);

        if ( !$post )
            return response($this->ApiResponse(null, 'Post not found', 404), 404);

        $post->update( $request->all() );

        return response
            (
                $this->ApiResponse(new PostsResource( $post ), 'Post updated successfully', 201),
            201
            );

    }

    public function destroy ($id) {

        $post = Post::find($id);

        if ( !$post )
            return response($this->ApiResponse(null, 'Post not found', 404), 404);

        $post->delete();

        return response
        (
            $this->ApiResponse( null, 'Post deleted successfully', 200),
            200
        );
    }
}
