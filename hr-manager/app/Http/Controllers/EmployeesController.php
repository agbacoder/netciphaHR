<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Exceptions\JsonException as ExceptionsJsonException;
use App\Models\Employees;
use App\Http\Requests\StoreemployeesRequest;
use App\Http\Requests\UpdateemployeesRequest;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use function PHPUnit\Framework\returnSelf;

class EmployeesController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        $pageSize = $request->page_size ?? 20;
        $employees = Employees::query()->paginate($pageSize);

          return EmployeeResource::collection($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreemployeesRequest $request)
    {
        DB::transaction(function () use ($request) {
            $employee = Employees::query()->create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'D_O_B' => $request->D_O_B,
                'status' => $request->status,
                'avatar' => $request->avatar,
                'address' => $request->address,
                'contact_1' => $request->contact_1,
                'contact_2' => $request->contact_2,
                'social_1' => $request->social_1,
                'social_2' => $request->social_2,
                'education_level' => $request->education_level,
                'disability' => $request->disability

        ]);
        throw_if (!$employee, GeneralJsonException::class, 'failed to create new resource.');
            $employee->syncRoles($request->roles);

            $user = new Users();
            $user->email = $employee['email'];
            $user->password = Str::password();
            $user->user_id = $employee['user_id'];
            $user->save();

            // Users::create([
            //     'user_id'  => $request->user_id,
            //     'email' => $employee->email,
            //     'password' => Str::password()

            // ]);
        });


        return response()->json(['message' => 'Employee and user created successfully.']);


    }

    /**
     * Display the specified resource.
     */
    public function show(Employees $employees)
    {
        throw_if (!$employees, GeneralJsonException::class, 'Resource not found.');

        $employees->load('roles.permissions'); // Loads roles and associated permissions

        return new EmployeeResource($employees);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateemployeesRequest $request, employees $employees)
    {
        $this->authorize('update', $employees);

        $employee_update = $employees->update([
            'first_name' => $request->first_name ?? $employees->first_name,
            'middle_name' => $request->middle_name ?? $employees->middle_name,
            'last_name' => $request->last_name ?? $employees->last_name,
            'email' => $request->email ?? $employees->email,
            'D_O_B' => $request->D_O_B ?? $employees->D_O_B,
            'gender' => $request->gender ?? $employees->gender,
            'status' => $request->status ?? $employees->status,
            'avatar' => $request->avatar ?? $employees->avatar,
            'address' => $request->address,
            'contact_1' => $request->contact_1,
            'contact_2' => $request->contact_2,
            'social_1' => $request->social_1,
            'social_2' => $request->social_2,
            'education_level' => $request->education_level,
            'disability' => $request->disability

        ]);
        throw_if (!$employee_update, GeneralJsonException::class, 'failed to update resource.');

        $employees->syncRoles($request->roles);

        return new EmployeeResource($employees);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(employees $employees)
    {
        $employee_deleted = $employees->forceDelete();

        throw_if (!$employee_deleted, GeneralJsonException::class, 'failed to delete resource.');
        return new JsonResponse([
            'data' => 'success'
        ]);
    }
}
