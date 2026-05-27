<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveAdminStaffRequest;
use App\Models\Admin;

class StaffController extends Controller
{
    public function index()
    {
        return view('admin.staff.index', [
            'staffs' => Admin::latest()->get(),
            'currentMenu' => 'staffs',
        ]);
    }

    public function create()
    {
        return view('admin.staff.create', [
            'roles' => Admin::ROLE,
            'currentMenu' => 'staffs',
        ]);
    }

    public function store(SaveAdminStaffRequest $request)
    {
        Admin::create($request->validated());

        return redirect()->route('admin.staff.index')->with('success', __('translate.createSuccess'));
    }

    public function edit(Admin $staff)
    {
        return view('admin.staff.edit', [
            'staff' => $staff,
            'roles' => Admin::ROLE,
            'currentMenu' => 'staffs',
        ]);
    }

    public function update(SaveAdminStaffRequest $request, Admin $staff)
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $staff->update($data);

        return redirect()->route('admin.staff.index')->with('success', __('translate.updateSuccess'));
    }

    public function destroy(Admin $staff)
    {
        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', __('translate.deleteSuccess'));
    }
}
