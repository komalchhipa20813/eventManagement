<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    //Listing Data Of User
    public function listing(){
        $data['userData']= User::where('status','!=',2)->where('role','!=',1)->latest()->get(['id','name','role']);
        $result = [];
        // $permissionList = permission();
        foreach ($data['userData'] as $key=>$user) {
            $checkbox='';
            $checkbox='<input type="checkbox" class="checkbox"  name="id[]" id="' . encryptid($user['id']) . '" s onclick="single_unselected(this);"   style="    margin-left: 8px;"/>';
            $button = '';
            // if(in_array("19", $permissionList)){
                $button .= '<button class="edit_user btn btn-sm btn-success m-1"  data-id="'.encryptid($user['id']).'">
                <i class="mdi mdi-square-edit-outline"></i>
                </button>';
            // }
            // if(in_array("20", $permissionList)){
                $button .= '<button class="delete btn btn-sm btn-danger m-1" data-id="'.encryptid($user['id']).'">
                <i class="mdi mdi-delete"></i>
                </button>';
            // }
            // 
            $role=($user->role == 2)? 'HR' : 'Supporter';
            $result[] = array(
            "0"=>$checkbox,
            "1"=>ucfirst($user->name),
            "2"=>$role,
            "3"=>$button
            );
        }
        return response()->json(['data'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'password'=> decryptid($request->id) == 0 ? 'required' : '',
                'role'=>'required'
            ]
        );
         $status=0;
        if($request->status && $request->status == 'on')
        {
            $status=1;
        }

        $userdata = "";
        if(decryptid($request->id) != 0)
        {
             $userdata =  User::find(decryptid($request->id));
        }

        try {
            User::updateOrCreate([
                'id' => decryptid($request->id),
            ],[
                'name' => $request->name,
                'email' => $request->email,
                'password' => (decryptid($request->id) == 0) ? Hash::make($request->password) : $userdata->password,
                'role'=>(int)$request->role,
                'status'=>$status,
            ]);

            $response = [
                'status' => true,
                'message' => 'User data '.(decryptid($request->id) == 0 ? 'Added' : 'Updated').' Successfully',
                'icon' => 'success',
            ];
        } catch (\Throwable $e) {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong! Please Try Again.',
                'icon' => 'error',
            ];
        }
        return response($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data['user'] = User::where('id',decryptid($id))->first();
            $response = [
                'data'=>$data,
                'status'=>true,
            ];

        }catch (\Throwable $e) {
            $response = [
                'status' => false,
                'message' => "Something Went Wrong! Please Try Again.",
                'icon' => 'error',
            ];
        }

        return response($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       try {
            $update['status'] = 2;
            User::where('id',decryptid($id))->update($update);;
            $response = [
                'status' => true,
                'message' => "User Data Deleted Successfully",
                'icon' => 'success',
            ];
        }catch (\Throwable $e) {
            $response = [
                'status' => false,
                'message' => "Something Went Wrong! Please Try Again.",
                'icon' => 'error',
            ];
        }

         return response($response);
    }

     /* delete selected User */
    public function deleteAll(Request $request)
    {
        $update['status'] = 2;
        $ids = [];
        $data_ids = $request->ids;
        foreach ($data_ids as $key => $value) {
            $ids[] = decryptid($value);
        }
        $events = User::where('status', '!=', 2)->pluck('id')->toArray();
        $result = User::whereIn('id', array_intersect($ids, $events))->update($update);
        if ($result) {
            $response = [
                'status' => true,
                'message' => 'User Deleted Successfully',
                'icon' => 'success',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => "error in deleting",
                'icon' => 'error',
            ];
        }
        return response($response);
    }


     /* checking user-email for availability */
    public function user_check(Request $request) {
        if(isset($request) && $request->email && $request->id){
        $user = User::where('email', $request->email)->where('id','!=',decryptid($request->id))->where('status','=',1)->first('id');
        return(!is_null($user))?true:false;
        }else{
            return false;
        }
    }
}
