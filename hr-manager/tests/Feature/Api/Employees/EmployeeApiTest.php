<?php

namespace Tests\Feature\Api\Employees;

use App\Models\Employees;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_index()
    {
         // load data in db
         $employees = Employees::factory(10)->create();

         //call index endpoint
         $response = $this->json('get', '/api/v1/employees');

         //assert status
         $response->assertStatus(200);

         //verify records
         dump($response->json());
    }
}
