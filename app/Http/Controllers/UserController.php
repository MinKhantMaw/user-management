<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Exports\Export;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $user = User::leftJoin('model_has_roles', function ($join) {
            $join->on('users.id', '=', 'model_has_roles.model_id');
             })
            ->leftJoin('roles', function ($join) {
                $join->on('roles.id', '=', 'model_has_roles.role_id');
            })
            ->select('users.*')
            ->where('roles.guard_name', 'web')
            ->orderBy('users.id', 'DESC')
            ->paginate(5);
        return view('user.index', compact('user'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
         $roles=Role::where('guard_name','web')->pluck('name','name')->all();
         return view('user.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'roles' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()
            ->route('user.index')
            ->with(['success' => 'Successfully Created User']);
    }

    public function show($id)
    {
        $show_user = User::find($id);
        return view('user.show', compact('show_user'));
    }

    public function edit($id)
    {
        $edit_user = User::find($id);
        return view('user.edit', compact('edit_user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $update = $this->updateUser($request);
        $user = User::find($id);
        $user->update($update);
        return redirect()
            ->route('user.index')
            ->with('success', 'Successfully User Update');
    }

    public function destroy(Request $request)
    {
        $user_delete = User::find($request->user_delete_id);
        $user_delete->delete();
        return redirect()
            ->route('user.index')
            ->with('success', 'Delete Successfully');
    }

    //user export

    public function export(Request $request)
    {
        
    }

    public function ExportUser($search)
    {

    }

    private function updateUser($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
        ];
    }
}
