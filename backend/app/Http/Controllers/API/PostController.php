<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Post;
use Validator;
use App\Http\Resources\PostResource;
use Illuminate\Http\JsonResponse;
use App\Services\Pagination;


class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse
    {
        // $posts = Post::all();

        $itemsPerPage = 4;
        if (isset($request['itemsPerPage'])) {
            if (!is_null($itemsPerPage) || $itemsPerPage !== 0 || $itemsPerPage !== '') {
                $itemsPerPage = $request['itemsPerPage'];
            }
        }
        $posts = Post::paginate($itemsPerPage);
        // $resource = PostResource::collection($posts);

        $posts = Pagination::data($posts);

        // dd($posts, $resource);
    
        return $this->sendResponse($posts, 'Posts retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $post = Post::create($input);

        return $this->sendResponse(new PostResource($post), 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $post = Post::find($id);

        if (is_null($post)) {
            return $this->sendError('Post not found.');
        }

        return $this->sendResponse(new PostResource($post), 'Post retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $post->name = $input['name'];
        $post->detail = $input['detail'];
        $post->save();

        return $this->sendResponse(new PostResource($post), 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return $this->sendResponse([], 'Post deleted successfully.');
    }
}
