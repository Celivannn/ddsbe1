<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserJob;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use DB;

class UserController extends Controller
{
    use ApiResponser;

    public function getUsers()
    {
        $users = DB::connection('mysql')->select("SELECT * FROM tbluser");
        return $this->successResponse($users);
    }

    public function index()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    public function add(Request $request)
    {
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
            'jobid' => 'required|numeric|min:1|not_in:0',
        ];
        $this->validate($request, $rules);

        // Check if jobid exists in tbluserjob
        $userjob = UserJob::find($request->jobid);
        if (!$userjob) {
            return $this->errorResponse("Invalid jobid.", Response::HTTP_BAD_REQUEST);
        }

        $user = User::create($request->all());
        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->successResponse($user);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
            'gender' => 'in:Male,Female',
            'jobid' => 'numeric|min:1|not_in:0',
        ];
        $this->validate($request, $rules);

        $user = User::findOrFail($id);
        $user->fill($request->all());

        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
        return $this->successResponse($user);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $this->successResponse('User deleted successfully');
    }
}
