<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $permissions = Permission::all();
        return response(view('admin.permissions.index', ['permissions' => $permissions]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        // Create a new role
        $permission = new Permission();
        $permission->name = $validatedData['name'];
        $permission->save();

        // Redirect to the index page with a success message
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name,' . $id . '|max:255',
        ]);

        // Get the role to update
        $permission = Permission::findOrFail($id);

        // Update the role
        $permission->name = $validatedData['name'];
        $permission->save();

        // Redirect to the index page with a success message
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        // Get the role to delete
        $permission = Permission::findOrFail($id);

        // Delete the role
        $permission->delete();

        // Redirect to the index page with a success message
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
