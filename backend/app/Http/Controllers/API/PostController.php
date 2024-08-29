<?php

namespace App\Http\Controllers\API;

use App\Models\PostTag;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Post;
use App\Models\Tag;
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

        $itemsPerPage = 12;
        if (isset($request['itemsPerPage'])) {
            if (!is_null($itemsPerPage) || $itemsPerPage !== 0 || $itemsPerPage !== '') {
                $itemsPerPage = $request['itemsPerPage'];
            }
        }
        $posts = Post::paginate($itemsPerPage);

        if (isset($request->keyword)) {
            if ($request->keyword !== "") {
                $posts = Post::where('title', 'LIKE', '%' . $request->keyword . '%')->paginate($itemsPerPage);
            }
        }
        $posts = Pagination::data($posts);
        return $this->sendResponse($posts, 'Posts retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();



        $validator = Validator::make($input['form'], [
            'publish_date' => 'required',
            'body' => 'required',
            'title' => 'required',
            'published' => 'required',
            'excerpt' => 'required',
            'description' => 'required',
            'tags' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $form = $input['form'];
        $form['user_id'] = 1;
        $form['thumbnail_id'] = 1;
        $post = Post::create($form);
        if (!is_null($post)) {
            $tags = $form['tags'];
            $tags = explode(',', $tags);
            if (count($tags)) {
                foreach ($tags as $key => $tag) {
                    $validateTag = Tag::where('tag', $tag)->first();
                    $postTagsArr[$key]['tag_id'] = false;
                    $postTagsArr[$key]['post_id'] = $post->id;
                    if (is_null($validateTag)) {
                        $newTag = new Tag();
                        $newTag->tag = $tag;
                        $newTag->save();
                        $postTagsArr[$key]['tag_id'] = $newTag->id;
                    } else {
                        $postTagsArr[$key]['tag_id'] = $validateTag->id;
                    }

                    $postTag = PostTag::where('tag_id', $postTagsArr[$key]['tag_id'])->where('post_id', $post->id)->first();
                    if (is_null($postTag)) {
                        $postTag = new PostTag();
                        $postTag->post_id = $post->id;
                        $postTag->tag_id = $postTagsArr[$key]['tag_id'];
                        $postTag->save();
                    }
                }
            }

            $tags = PostTag::where('post_id', $post->id)->get('tag_id');
            if (count($tags)) {
                foreach ($tags as $key => $tag) {
                    $activeTags[] =  Tag::find($tag->tag_id)->tag . ',';
                }
            }
            $post->tags = implode(',', $activeTags);

            return $this->sendResponse(new PostResource($post), 'Post created successfully.');
        }
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
