<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveRoleRequest;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.role.index', [
            'roles' => Role::latest()->get(),
            'currentMenu' => 'roles',
        ]);
    }

    public function create()
    {
        return view('admin.role.create', [
            'roleNames' => Role::ALLOWED_ROLES,
            'currentMenu' => 'roles',
        ]);
    }

    public function store(SaveRoleRequest $request)
    {
        Role::create($request->validated());

        return redirect()->route('admin.role.index')->with('success', __('translate.createSuccess'));
    }

    public function edit(Role $role)
    {
        return view('admin.role.edit', [
            'role' => $role,
            'roleNames' => Role::ALLOWED_ROLES,
            'currentMenu' => 'roles',
        ]);
    }

    public function update(SaveRoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return redirect()->route('admin.role.index')->with('success', __('translate.updateSuccess'));
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.role.index')->with('success', __('translate.deleteSuccess'));
    }
}
