<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::latest()->paginate(5);
        return view('admin.roles.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create' , compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'display_name'=>'required'
        ]);
        try
        {
        DB::beginTransaction();
        $role = Role::create([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'guard_name'=>'web'
        ]);
        $permissions = $request->except( '_token' , 'display_name' , 'name');
        $role ->givePermissionTo($permissions);

        DB::commit();
        }catch(\Exception $ex)
        {
            DB::rollBack();
            alert()->error('  مشکل در ایجاد  نقش ', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('با موفقیت انجام شد','نقش با موفقیت اضافه شد');
        return redirect()->route('admin.roles.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show' , compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit' , compact('role' , 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'display_name' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $role->update([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);
            $permissions = $request->except('_token', 'display_name', 'name','_method');
            $role->syncPermissions($permissions);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            alert()->error('مشکل در ویرایش نقش', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }
        alert()->success('نقش مورد نظر ویرایش شد', 'باتشکر');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
