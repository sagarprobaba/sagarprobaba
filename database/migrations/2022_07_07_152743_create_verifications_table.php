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
        Schema::create('verifications', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('checkID',255)->nullable();

            $table->string('brandId',255)->nullable();
            $table->string('storeName',255)->nullable();

//company           
            $table->string('companyName',255)->nullable();
            $table->string('existingSince',255)->nullable();
            
//address and employee
            $table->string('employeeID',255)->nullable();

//address
            $table->string('candidateName',255)->nullable();
            $table->string('fatherName',255)->nullable();
            $table->string('dateOfBirth',255)->nullable();
            $table->string('periOdofStay',255)->nullable();
//all
            $table->string('mobileNo',255)->nullable();
            $table->text('address',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('pinCode',255)->nullable();
            $table->string('landMark',255)->nullable();
            $table->string('clientName',255)->nullable();

//employee
            $table->string('empName',255)->nullable();
            $table->string('designation',255)->nullable();
            $table->string('reportingManagersName',255)->nullable();
            $table->string('lastDrawnSalary',255)->nullable();
            $table->string('periodOfWork',255)->nullable();
// all
            $table->string('caseInitiatedDate',255)->nullable();
            $table->string('status',255)->nullable();
            $table->string('reportGeneratedDate',255)->nullable();
            $table->string('overdueStatus',255)->nullable();
            $table->string('gsAllocated',255)->nullable();    
            $table->string('verificationType',255)->nullable();           											
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            //shop
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verifications');
    }
};
