<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use App\Models\User;
use DB;

class RoleController extends Controller
{
    public function AllPermission(){

        $permissions = Permission::all();

        return view('backend.pages.permission.all_permission',compact('permissions'));

    }///End Method


    public function AddPermission(){

        return view('backend.pages.permission.add_permission');


    }///End Method

    public function StorePermission(Request $request){

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        $notification=array(
            'message'=>'Permission Inserted Succesfully',
            'alert-type'=>'success'
        );

        return redirect()->route('all.permission')->with($notification);


    }///End Method


    public function EditPermission($id){

        $permission = Permission::findOrFail($id);

        return view('backend.pages.permission.edit_permission',compact('permission'));

    }///End Method

    public function UpdatePermission(Request $request){

        $per_id = $request->id;

        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        $notification=array(
            'message'=>'Permission Updated Succesfully',
            'alert-type'=>'success'
        );

        return redirect()->route('all.permission')->with($notification);


    }///End Method


    public function DeletePermission($id){

     Permission::findOrFail($id)->delete();
     
     $notification=array(
            'message'=>'Permission Deleted Succesfully',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);   


    }///End Method


    public function ImportPermission(){

        return view('backend.pages.permission.Import_Permission');

    }///End Method

    public function Export(){

        return Excel::download(new PermissionExport, 'permission.xlsx');


    }///End Method

    public function Import(Request $request){

        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification=array(
            'message'=>'Permission Imported Succesfully',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification); 


    }///End Method


    ////////// Roles All Methods ///////////////

    public function AllRoles(){

        $roles = Role::all();

        return view('backend.pages.roles.all_roles',compact('roles'));


    }///End Method


    public function AddRoles(){

        return view('backend.pages.roles.add_roles');

    }///End Method


    public function StoreRoles(Request $request){

        Role::create([
            'name' => $request->name,
            
        ]);

        $notification=array(
            'message'=>'Role Inserted Succesfully',
            'alert-type'=>'success'
        );

        return redirect()->route('all.roles')->with($notification);


    }///End Method


    public function EditRoles($id){

        $roles = Role::findOrFail($id);

        return view('backend.pages.roles.edit_roles',compact('roles'));


    }///End Method

    public function UpdateRoles(Request $request){

        $role_id = $request->id;

        Role::findOrFail($role_id)->update([
            'name' => $request->name,

        ]);

        $notification=array(
            'message'=>'Role Updated Succesfully',
            'alert-type'=>'success'
        );

        return redirect()->route('all.roles')->with($notification);


    }///End Method

    public function DeleteRoles($id){

        Role::findOrFail($id)->delete();

        $notification=array(
            'message'=>'Role Deleted Succesfully',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);


    }///End Method

///////////// Add Role Permission All Methods////////////


    public function AddRolesPermission(){

        $roles = Role::all();
        $permission = Permission::all();
        $permission_groups = User::getpermissionGroup();

        return view('backend.pages.rolesetup.add_roles_permission',compact('roles','permission','permission_groups'));


    }///End Method

    public function RolePermissionStore(Request $request){

        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key =>$item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);

        }/// End Foreach

        $notification=array(
            'message'=>'Role Permissions Added Succesfully',
            'alert-type'=>'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);



    }///End Method


    public function AllRolesPermission(){

        $roles = Role::all();
        return view('backend.pages.rolesetup.all_roles_permission',compact('roles'));

    }///End Method


    public function AdminEditRoles($id){

        $role = Role::findOrFail($id);

        $permission = Permission::all();
        $permission_groups = User::getpermissionGroup();

        return view('backend.pages.rolesetup.edit_roles_permission',compact('role','permission','permission_groups'));

    }///End Method


    public function AdminRolesUpdate(Request $request,$id){

        $role = Role::findOrFail($id);

        $permissions = $request->permission;

        if(!empty($permissions)){

            $role->syncPermissions($permissions);
        }
        $notification=array(
            'message'=>'Role Permissions Updated Succesfully',
            'alert-type'=>'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);


    }///End Method

    public function AdminDeleteRoles($id){

        $role = Role::findOrFail($id);
        if(!is_null($role)){
            $role->delete();
        }

        $notification=array(
            'message'=>'Role Permissions Deleted Succesfully',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);

    }///End Method

}
