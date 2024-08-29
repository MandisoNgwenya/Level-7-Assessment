<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Services\Pagination;


class UserController extends BaseController
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
       $users = User::paginate($itemsPerPage);

        if (isset($request->keyword)) {
            if ($request->keyword !== "") {
               $users = User::where('title', 'LIKE', '%' . $request->keyword . '%')->paginate($itemsPerPage);
            }
        }
       $users = Pagination::data($users);
        return $this->sendResponse($users, 'Users retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user->name = $input['name'];
        $user->detail = $input['detail'];
        $user->save();

        return $this->sendResponse(new PostResource($user), 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return $this->sendResponse([], 'User deleted successfully.');
    }
}
