<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use Spatie\Permission\Traits\HasRoles;

class Employees extends Model
{
    use HasUuids, HasRoles, HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    protected string $guard_name = 'api';



    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    const ROLE_ADMIN = 'ADMIN';

    const ROLE_MANAGER = 'MANAGER';

    const ROLE_HR = 'HR';

    const ROLE_USER = 'USER';


    public $incrementing = false;
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'status',
        'roles',
        'avatar',
        'email',
        'D_O_B',
        'address',
        'gender',
        'contact_1',
        'contact_2', 'social_1',
        'social_2',
        'education_level',
        'disability'
    ];

    // protected $casts = [
    // ];

protected static function booted()
{
    static::updated(function ($employee) {
        // Check if the email field was updated
        if ($employee->wasChanged('email')) {
            // Update the corresponding user's email
            Users::where('email', $employee->getOriginal('email'))
                ->update(['email' => $employee->email]);
        }
    });
}



    public function employeeWork()
    {
       return $this->hasOne(EmployeeWork::class);
    }
    public function users()
    {
        return $this->hasOne(Users::class);
    }

}
