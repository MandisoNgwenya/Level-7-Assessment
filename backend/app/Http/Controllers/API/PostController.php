<?php

namespace App\Http\Controllers\API;

use App\Models\PostTag;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Post;
use App\Models\File;
use App\Models\Tag;
use Validator;
use App\Http\Resources\PostResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Services\Pagination;
use Illuminate\Support\Str;

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
        $posts['itemsPerPage'] = (int)$itemsPerPage;
        if (count($posts['items'])) {
            foreach ($posts['items'] as $key => $post) {
                $posts['items'][$key]->user = User::find($post->user_id);
                $posts['items'][$key]->publish_date = date('Y-m-d', strtotime($post->publish_date));
                $posts['items'][$key]->thumbnail ;
                
            }
        }


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

        $input = [];

        $input['form'] = (array)json_decode($request['form']);
        // dd($input,$request->all());
        // $input = $request->all();
        $validator = Validator::make($input['form'], [
            'publish_date' => 'required',
            'body' => 'required',
            'title' => 'required',
            'published' => 'required',
            'excerpt' => 'required',
            'description' => 'required',
            'keywords' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user =  auth('sanctum')->user();
        $form = $input['form'];
        $form['user_id'] = $user->id;

        $file = $request->file('file');
        $fileSave = null;
        if (isset($request->file)) {
            if ($file->isValid()) {

                $fileArr['ext'] = trim($file->getClientOriginalExtension());
                $fileArr['original_filename'] = str_replace("." . $fileArr['ext'], "", $file->getClientOriginalName());
                $fileArr['filename'] = md5(Str::random(10));
                if ($fileArr['ext'] === 'png' || $fileArr['ext'] === 'jpg' || $fileArr['ext'] === 'jpeg') {
                    $path = public_path() . '/720526039c7ddee22606ee5a8cb2a1b2/';
                    $file->move($path, $fileArr['filename'] . '.' . $fileArr['ext']);
                }

                $fileSave = File::create($fileArr);
            }
        }
        $form['thumbnail_id'] = 0;
        if (!is_null($fileSave)) {
            $form['thumbnail_id'] = $fileSave->id;;
        }

        if ($form['id'] == 0) {
            $post = Post::create($form);
        } else {
            $post = Post::find($form['id']);
            $post->publish_date = $form['publish_date'];
            $post->body = $form['body'];
            $post->title = $form['title'];
            $post->published = $form['published'];
            $post->excerpt = $form['excerpt'];
            $post->description = $form['description'];
            $post->description = $form['description'];
            $post->save();
        }


        if (!is_null($post)) {
            $tags = $form['keywords'];
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
            $post->thumbnail;

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

        $keywords = '';
        $tags = [];
        if (count($post->tags)) {
            foreach ($post->tags as $key => $tag) {
                if (!is_null($tag->tag)) {
                    $keywords .= $tag->tag->tag . ',';
                }
                $tags[] = $tag->tag;
            }
        }
        $post->keywords = $keywords;
        $post->tags = $tags;

        $post->thumbnail;
        // dd($post);
        return $this->sendResponse(new PostResource($post), 'Post retrieved successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse
    {

        $post = Post::find($request['form']['id']);
        $post->delete();
        $itemsPerPage = 12;
        if (isset($request['itemsPerPage'])) {
            if (!is_null($itemsPerPage) || $itemsPerPage !== 0 || $itemsPerPage !== '') {
                $itemsPerPage = $request['itemsPerPage'];
            }
        }
        $posts = Post::paginate($itemsPerPage);
        $posts = Pagination::data($posts);
        $posts['itemsPerPage'] = (int) $itemsPerPage;
        if (count($posts['items'])) {
            foreach ($posts['items'] as $key => $post) {
                $posts['items'][$key]->user = User::find($post->user_id);
                $posts['items'][$key]->publish_date = date('Y-m-d', strtotime($post->publish_date));
            }
        }


        return $this->sendResponse($posts, 'Posts deleted successfully.');
    }
}
