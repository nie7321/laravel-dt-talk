<?php

use App\Models\Employee;
use App\Models\EmploymentType;
use App\Models\JobDescription;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        factory(EmploymentType::class)->create(['name' => 'Full Time', 'tax_code' => 'P0']);
        factory(EmploymentType::class)->create(['name' => 'Part Time', 'tax_code' => 'PT']);
        factory(EmploymentType::class)->create(['name' => 'Temp/Seasonal', 'tax_code' => 'TS']);
        factory(EmploymentType::class)->create(['name' => 'Intern', 'tax_code' => 'IP']);

        factory(JobDescription::class, 25)->create();
        factory(Employee::class, 500)->create();
    }
}
