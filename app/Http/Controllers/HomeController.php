<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //  Role::create(['name'=>'writer']);
        //   Role::create(['name'=>'editor']);
        //  Role::create(['name'=>'publisher']);
        //   Role::create(['name'=>'admin']);

        //  Permission::create(['name'=>'write post']);
        // Permission::create(['name'=>'edit post']);
        //  Permission::create(['name'=>'delete post']);
        //   $role=Role::findById(1);
        //    $permission=Permission::findById(1);
        //      $role->givePermissionTo($permission);
        //    auth()->user()->givePermissionTo('edit post');
            //  auth()->user()->assignRole($role);
        //    return auth()->user()->getAllPermissions();
        //    return User::permission('write post')->get();
        //    return auth()->user()->removeRole('writer');
           return view('user.index');
    }
}
