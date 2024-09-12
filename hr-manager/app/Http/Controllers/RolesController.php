<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Http\Resources\RolesResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return ResourceCollection
      */
     public function index(Request $request)
     {
         $permission = Role::query()->get();
           return RolesResource::collection($permission);
     }

     public function store(Request $request)
     {

         $request->validate([
             'name' => 'required|string|unique:roles,name'
         ]);
         $permission = Role::query()->create([
             'name' => $request->name,
         ]);
         throw_if (!$permission, GeneralJsonException::class, 'failed to create new resource.');

         return response()->json(['message' => 'Role created successfully.']);


     }
     public function update(Request $request, Role $role)
     {
        $request->validate([
            'name' => 'required|string|unique:roles,name, '.$role->id
        ]);
         $role_update = $role->update([
             'name' => $request->name ?? $role->name

         ]);
         throw_if (!$role_update, GeneralJsonException::class, 'failed to update resource.');
         return new RolesResource($role);
     }
     public function destroy(Role $role)
     {
         $role_deleted = $role->forceDelete();

         throw_if (!$role_deleted, GeneralJsonException::class, 'failed to delete resource.');
         return new JsonResponse([
             'data' => 'success'
         ]);
     }

     public function addPermissionToRole(Request $request, $roleId)
{
    // Validate that permissions are provided as an array of IDs
    $request->validate([
        'permissions' => 'required|array',
        'permissions.*' => 'exists:permissions,id' // Validate that each permission exists in the 'permissions' table
    ]);

    $role = Role::findOrFail($roleId);

    // Sync the permissions using their IDs
    $role->syncPermissions($request->permissions);

    return new JsonResponse([
        'data' => 'success'
    ]);
}

 }
