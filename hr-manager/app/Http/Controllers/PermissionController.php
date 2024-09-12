<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        $permission = Permission::query()->get();
          return PermissionResource::collection($permission);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:permissions,name',
            'module' =>'required'
        ]);
        $permission = Permission::query()->create([
            'name' => $request->name,
            'module' => $request->module,

        ]);
        throw_if (!$permission, GeneralJsonException::class, 'failed to create new resource.');

        return response()->json(['message' => 'Permission created successfully.']);


    }
    public function update(Request $request, Permission $permission)
    {

        $permission_update = $permission->update([
            'name' => $request->name ?? $permission->name

        ]);
        throw_if (!$permission_update, GeneralJsonException::class, 'failed to update resource.');
        return new PermissionResource($permission);
    }
    public function destroy(Permission $permission)
    {
        $permission_deleted = $permission->forceDelete();

        throw_if (!$permission_deleted, GeneralJsonException::class, 'failed to delete resource.');
        return new JsonResponse([
            'data' => 'success'
        ]);
    }

}
