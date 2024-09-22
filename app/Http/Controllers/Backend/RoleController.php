<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // All Permission Method
    public function AllPermission()
    {

        $permission = Permission::all();
        return view('backend.permission.all_permission', compact('permission'));
    } // End Method

    // Add Permission Method
    public function AddPermission()
    {

        return view('backend.permission.add_permission');
    } // End Method

    // Store Permission Method
    public function StorePermission(Request $request)
    {

        $role = Permission::create([
            'name' => $request->permissionName,
            'group_name' => $request->gorupName,
        ]);
        $noti = [
            'message' => 'Permission Add Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#permission')->with($noti);
    } // End Method

    // Edit Permission Method
    public function EditPermission($id)
    {

        $permission = Permission::findOrFail($id);
        return view('backend.permission.edit_permission', compact('permission'));
    } // End Method

    // Update Permission Method
    public function UpdatePermission(Request $request)
    {

        $permission_id = $request->id;

        Permission::findOrFail($permission_id)->update([
            'name' => $request->permissionName,
            'group_name' => $request->gorupName,
        ]);
        $noti = [
            'message' => 'Permission Update Add Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#permission')->with($noti);
    } // End Method

    // Delete Permission Method
    public function DeletePermission($id)
    {

        Permission::findOrFail($id)->delete();
        $noti = [
            'message' => 'Permission Delete  Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#permission')->with($noti);
    } // End Method


    /////////  Role  ////////

    // All Roles Method
    public function AllRoles()
    {

        $roles = Role::all();
        return view('backend.roles.all_roles', compact('roles'));
    } // End Method

    // Add Role Method
    public function AddRoles(){

        return view('backend.roles.add_roles');
    } // End Method

    // Store Role Method
    public function StoreRole(Request $request)
    {

        Role::create([
            'name' => $request->roleName,
        ]);
        $noti = [
            'message' => 'Role Add Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#roles')->with($noti);
    } // End Method

     // Edit Role Method
     public function EditRoles($id)
     {

         $roles = Role::findOrFail($id);
         return view('backend.roles.edit_roles', compact('roles'));
     } // End Method

     // Update Role Method
    public function UpdateRoles(Request $request)
    {

        $role_id = $request->id;

        Role::findOrFail($role_id)->update([
            'name' => $request->roleName,

        ]);
        $noti = [
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#roles')->with($noti);
    } // End Method

    // Delete Permission Method
    public function DeleteRole($id)
    {

        Role::findOrFail($id)->delete();
        $noti = [
            'message' => 'Role Deleted  Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#roles')->with($noti);
    } // End Method


    ///////////////// ADD ROLE PERMISSION ///////////////////////////

    public function AddRolesPermission (){

        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();

        return view('backend.roles.add_roles_permission',compact('roles','permissions','permission_groups'));

    } // End Method

    public function StoreRolesPermission(Request $request){

        $data = array();
        $permissions = $request->permissions;

        foreach($permissions as $key => $item){
            $data['role_id'] = $request->roleId;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);

        }
        $noti = [
            'message' => 'Role Permssion Added  Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#rolepermission')->with($noti);

    } //End Method

    // All Role Permassion Method
    public function AllRolesPermission(){

        $roles = Role::all();
        return view('backend.roles.all_roles_permission',compact('roles'));
    } // End Method

    // Edit Role Permission Method
    public function EditRolesPermission($id){

        $roles = Role::findOrFail($id);
            $permissions = Permission::all();
            $permission_groups = User::getpermissionGroups();

            return view('backend.roles.edit_roles_permission',compact('roles','permissions','permission_groups'));

    } // End Method

    // Update Role Permission Method
    public function UpdateRolePermission(Request $request,$id){

        $role = Role::findOrFail($id);
        $permissions = $request->permissions;

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        $noti = [
            'message' => 'Role Permssion Updated  Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#rolepermission')->with($noti);
    } // End Method

    // delete role in permission method
    public function DeleteRolePermission($id){

        $role =Role::findOrFail($id);
        if(!is_null($role)){
            $role->delete();
        }
        $noti = [
            'message' => 'Role Permssion Delete  Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($noti);
    } // End Method

}
