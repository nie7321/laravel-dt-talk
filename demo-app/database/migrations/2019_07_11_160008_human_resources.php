<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HumanResources extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('employee_id');
            
            $table->boolean('onboarding_in_progress');
            $table->double('salary', 12, 2);

            $table->integer('job_description_id')->index();
            $table->integer('employment_type_id')->index();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('job_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('duties');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('employment_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('tax_code');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('job_descriptions');
        Schema::dropIfExists('employment_types');
    }
}
