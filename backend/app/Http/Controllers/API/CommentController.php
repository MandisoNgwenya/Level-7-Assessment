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

        $itemsPerPage = 5;
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
                $comments = Comment::where('post_id', $request->post_id)->paginate($itemsPerPage);
            }
        }

        $comments = Pagination::data($comments);
        $comments['itemsPerPage'] = $itemsPerPage;
        if (count($comments['items'])) {
            foreach ($comments['items'] as $key => $comment) {

                $comments['items'][$key]->user;
            }
        }
        // dd($comments);
        return $this->sendResponse($comments, 'Comments retrieved successfully.');
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
        $validator = Validator::make($input['form'], [
            'comment' => 'required',
            'post_id' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $form = $input['form'];
        $user =  auth('sanctum')->user();
        $form['user_id'] =  $user->id;

        $comment = Comment::create($form);
        if (!is_null($comment)) {

            $itemsPerPage = 5;
            if (isset($request['itemsPerPage'])) {
                if (!is_null($itemsPerPage) || $itemsPerPage !== 0 || $itemsPerPage !== '') {
                    $itemsPerPage = $request['itemsPerPage'];
                }
            }

            $comments = Comment::where('post_id', $form['post_id'])->paginate($itemsPerPage);
            $comments = Pagination::data($comments);
            $comments['itemsPerPage'] = $itemsPerPage;
            if (count($comments['items'])) {
                foreach ($comments['items'] as $key => $comment) {

                    $comments['items'][$key]->user;
                }
            }


            return $this->sendResponse($comments, 'Comment created successfully.');
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
    public function update(Request $request): JsonResponse
    {
        $input = $request->all();


        $validator = Validator::make($input['form'], [
            'comment' => 'required',
            'post_id' => 'required',
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $comment = Comment::find($input['form']['id']);
        $user =  auth('sanctum')->user();
        if ($comment->user_id == $user->id) {
            $comment->comment = $input['form']['comment'];
            $comment->user_id = $user->id;
            $comment->save();
        }

        $itemsPerPage = 5;
        if (isset($request['itemsPerPage'])) {
            if (!is_null($itemsPerPage) || $itemsPerPage !== 0 || $itemsPerPage !== '') {
                $itemsPerPage = $request['itemsPerPage'];
            }
        }
        $comments = Comment::where('post_id', $request['form']['post_id'])->paginate($itemsPerPage);
        $comments = Pagination::data($comments);
        $comments['itemsPerPage'] = $itemsPerPage;
        if (count($comments['items'])) {
            foreach ($comments['items'] as $key => $comment) {
                $comments['items'][$key]->user;
            }
        }
        return $this->sendResponse($comments, 'Comments updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse
    {

        // dd($request['form']);
        $user =  auth('sanctum')->user();
        $comment = Comment::find($request['form']['id']);

        if ($comment->user_id == $user->id) {
            $comment->delete();
            $message = 'Comment deleted successfully.';
            $success = true;
        } else {

            $message = 'You do not have the permission to peform this action, you can only delete comments created by you.';
            $success = false;
            if (isset($request['form']['source'])) {
                if ($request['form']['source']=== 'comments') {
                    $comment->delete();
                    $message = 'Comment deleted successfully.';
                    $success = true;
                }
            }
        
        }
        $itemsPerPage = 5;
        if (isset($request['itemsPerPage'])) {
            if (!is_null($itemsPerPage) || $itemsPerPage !== 0 || $itemsPerPage !== '') {
                $itemsPerPage = $request['itemsPerPage'];
            }
        }

        $comments = Comment::where('post_id', $request['form']['post_id'])->paginate($itemsPerPage);
        $comments = Pagination::data($comments);
        $comments['itemsPerPage'] = $itemsPerPage;
        if (count($comments['items'])) {
            foreach ($comments['items'] as $key => $comment) {
                $comments['items'][$key]->user;
            }
        }
        return $this->sendResponse($comments, $message, $success);
    }
}
