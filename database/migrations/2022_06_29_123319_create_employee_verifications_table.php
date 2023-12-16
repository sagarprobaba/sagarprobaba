<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_verifications', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nameOfEmployee',255)->nullable();
            $table->date('periodOfEmploymentFrom')->nullable();
            $table->date('periodOfEmploymentTo')->nullable();
            $table->string('designation',255)->nullable();
            $table->string('lastDrawnsalary',255)->nullable();
            $table->string('employeeCode',255)->nullable();
            $table->string('reportingManagersDetails',255)->nullable();
            $table->string('reasonForLeaving',255)->nullable();
            $table->string('eligibilityForRehire')->nullable();
            $table->string('feedbackOnAccount',255)->nullable();
            $table->string('refereeDetails',255)->nullable();
            $table->string('additionalComments',255)->nullable();
            $table->string('exitFormalities',255)->nullable();
            $table->string('detailsConfirmedBy',255)->nullable();
            $table->string('signature',255)->nullable(); 
            $table->string('a1',255)->nullable();
            $table->string('a2',255)->nullable();
            $table->string('a3',255)->nullable();
            $table->string('a4',255)->nullable();
            $table->string('a5',255)->nullable();
            $table->string('a6',255)->nullable();
            $table->string('a7',255)->nullable();
            $table->string('a8',255)->nullable();
            $table->string('a9',255)->nullable();
            $table->string('a10',255)->nullable();    
            $table->bigInteger('created_by')->nullable(); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_verifications');
    }
};
