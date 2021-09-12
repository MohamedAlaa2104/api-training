<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\posts\StoreRequest;
use App\Http\Requests\Api\posts\UpdateRequest;
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

        return response($this->ApiResponse($data, 'ok'), 200);
    }

    public function show (Post $post) {

        $data = new PostsResource($post);

        return response($this->ApiResponse($data, 'ok'), 200);

    }

    public function store (StoreRequest $request) {

        $post = Post::create( $request->all() );

        return response( $this->ApiResponse( new PostsResource( $post ), 'Post created successfully' ), 201);

    }

    public function update (UpdateRequest $request, Post $post) {

        $post->update( $request->all() );

        return response ( $this->ApiResponse( new PostsResource( $post ), 'Post updated successfully' ), 201 );

    }

    public function destroy (Post $post) {

        $post->delete();

        return response ( $this->ApiResponse( null, 'Post deleted successfully' ), 200 );
    }
}
