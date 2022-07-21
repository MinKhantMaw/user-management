<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Exports\Export;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

   public function index()
   {
        $user=User::all();
        return view('user.index',compact('user'));
   }

   public function create()
   {
        return view('user.create');
   }

   public function store(Request $request)
   {
    $validator=Validator::make($request->all(),[
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password',
    ]);
    if ($validator->fails()) {
       return back()
       ->withErrors($validator)
       ->withInput();
    }
    $data=[
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),

    ];
    User::create($data);
    return redirect()->route('user.index')->with(['success'=>"Successfully Created User"]);
   }

   public function show($id)
   {

    $show_user=User::find($id);
    return view('user.show',compact('show_user'));
   }

   public function edit($id)
   {
    $edit_user=User::find($id);
    return view('user.edit',compact('edit_user'));
   }

   public function update(Request $request,$id)
   {
                $this->validate($request, [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,'.$id,
            ]);

                $update = $this->updateUser($request);
                $user = User::find($id);
                $user->update($update);
               return redirect()->route('user.index')->with('success','Successfully User Update');

   }

   public function destroy(Request $request)
   {
        $user_delete=User::find($request->user_delete_id);
        $user_delete->delete();
       return redirect()->route('user.index')->with('success','Delete Successfully');
   }

    //user export

    public function userSearch(Request $request)
    {

       $search=['name' => $request->search_data,'email' => $request->search_data];

        // $search_user=User::where('name','like','%' . $request->search_data . '%')
        //                     ->Orwhere('email','like','%' . $request->search_data . '%')
        //                     ->get();
        $user=User::orderby('id','desc');

        if($request->search_data != null)
        {
            $user->where('name',$request->search_data);
        }


        $user=$user->paginate(10);

        if($request->action == 'user.search')
        {
            return $this->ExportUser($search);
        }

       return view('user.index',compact('user'))->with('i', ($request->input('page', 1) - 1) * 15);
    }

    public function ExportUser($search)
    {

        return Excel::download(new Export($search['name'],$search['email']), 'UserReport-' . Carbon::today()->toDateString() . '.xlsx' , \Maatwebsite\Excel\Excel::XLSX);
    }

   private function updateUser($request)
   {
       return[
           'name' => $request->name,
           'email' => $request->email,
       ];
   }
}
