<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'D_O_B'  => $this->D_O_B,
                'gender' => $this->gender,
                'address' => $this->address,
                'contact_1' => $this->contact_1,
                'contact_2' => $this->contact_2,
                'social_1' => $this->social_1,
                'social_2' => $this->social_2,
                'education_level' => $this->education_level,
                'disability' => $this->disability,
                'roles' => $this->roles->map(function ($role) {
                    return [
                        'role_name' => $role->name,
                        'permissions' => $role->permissions->pluck('name')
                    ];
                })
        ];
    }
}
