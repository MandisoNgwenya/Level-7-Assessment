<?php

namespace App\Http\Controllers\API;

use App\Models\PostTag;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Comment;
use App\Models\Tag;
use Validator;
use App\Http\Resources\CommentResource;
use Illuminate\Http\JsonResponse;
use App\Services\Pagination;


class CommentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse
    {

        $itemsPerPage =2;
        if (isset($request['itemsPerPage'])) {
            if (!is_null($itemsPerPage) || $itemsPerPage !== 0 || $itemsPerPage !== '') {
                $itemsPerPage = $request['itemsPerPage'];
            }
        }
        $comments = Comment::paginate($itemsPerPage);

        if (isset($request->keyword)) {
            if ($request->keyword !== "") {
                $comments = Comment::where('comment', 'LIKE', '%' . $request->keyword . '%')->paginate($itemsPerPage);
            }
        }

        if (isset($request->post_id)) {
            if ($request->post_id !== 0) {
                $comments = Comment::where('post_id',$request->post_id)->paginate($itemsPerPage);
            }
        }


        $comments = Pagination::data($comments);
        $comments['itemsPerPage'] = $itemsPerPage;
        return $this->sendResponse($comments, 'Comments retrieved successfully.');
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
            'comment' => 'required',
            'user_id' => 'required',
            'post_id' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $form = $input['form'];

        $comment = Comment::create($form);
        if (!is_null($comment)) {
         

            return $this->sendResponse(new CommentResource($comment), 'Comment created successfully.');
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
        $comment = Comment::find($id);

        if (is_null($comment)) {
            return $this->sendError('Comment not found.');
        }

        return $this->sendResponse(new CommentResource($comment), 'Comment retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $comment->name = $input['name'];
        $comment->detail = $input['detail'];
        $comment->save();

        return $this->sendResponse(new CommentResource($comment), 'Comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();

        return $this->sendResponse([], 'Comment deleted successfully.');
    }
}
