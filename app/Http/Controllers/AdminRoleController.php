<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class AdminRoleController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string',  Rule::unique(Role::class)],
        ]);

        Role::create($validatedData);

        session()->flash('success', 'Role created successfully.');
    }


    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string',  Rule::unique('roles', 'name')->ignore($role->id)],
        ]);

        $role->update($validatedData);

        session()->flash('success', 'Role updated successfully.');
    }


    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->back()->with('success', 'Role deleted successfully');
    }
}
