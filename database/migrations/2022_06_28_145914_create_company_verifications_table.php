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
        Schema::create('company_verifications', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('companyName',255)->nullable();
            $table->string('district',255)->nullable();
            $table->string('checkID',255)->nullable();
            $table->string('State',255)->nullable();
            $table->text('addressOfCompany')->nullable();
            $table->string('pinCode',255)->nullable();
            $table->string('landmark',255)->nullable();
            $table->string('typeOfArea',255)->nullable();
            $table->string('companyExists')->nullable();
            $table->string('companyShutDown')->nullable();
            $table->string('companyShifted')->nullable();
            $table->string('noInformationFound')->nullable();
            $table->string('companyNeverExisted')->nullable();
            $table->string('companyBoardAvailable',255)->nullable();
            $table->string('companyNameAtTheBoard',255)->nullable();
            $table->string('numberofEmployees',255)->nullable();
            $table->string('natureOfBusiness',255)->nullable();
            $table->string('existingSince',255)->nullable();
            $table->string('interiorOfTheCompany',255)->nullable();
            $table->string('exteriorOfTheCompany',255)->nullable();
            $table->string('nameOfTheConcernedPerson',255)->nullable();
            $table->string('designationOfTheConcernedPerson',255)->nullable();
            $table->string('contactEmailOfTheConcernedPerson',255)->nullable();
            $table->string('nameOfThePersonMet',255)->nullable();
            $table->string('designationOfThePersonMet',255)->nullable();
            $table->string('contactEmailOfThePersonMet',255)->nullable();
            $table->text('newAddressOfTheCompanyAvailable')->nullable();
            $table->string('reason',255)->nullable();
            $table->text('newAddressOfTheCompany')->nullable();
            $table->string('monthYearOfShiftingShutdown',255)->nullable();
            $table->string('inCaseOfShifted',255)->nullable();
            $table->string('durationOfCurrentCompanyExistenc',255)->nullable();
            $table->string('collectedPhotograph')->nullable();
            $table->string('photosUnavailabilityReason',255)->nullable();
            $table->string('nameOfNeighbour1',255)->nullable();
            $table->string('companyNameOfNeighbour1',255)->nullable();
            $table->string('periodOfExistenceOfNeighbour1',255)->nullable();
            $table->string('statementByTheNeighbour1',255)->nullable();
            $table->string('nameOfNeighbour2',255)->nullable();
            $table->string('companyNameOfNeighbour2',255)->nullable();
            $table->string('periodOfExistenceOfNeighbour2',255)->nullable();
            $table->string('statementByTheNeighbour2',255)->nullable();
            $table->string('nameOfNeighbour3',255)->nullable();
            $table->string('companyNameOfNeighbour3',255)->nullable();
            $table->string('periodOfExistenceOfNeighbour3',255)->nullable();
            $table->string('statementByTheNeighbour3',255)->nullable();
            $table->string('nameOfNeighbour4',255)->nullable();
            $table->string('companyNameOfNeighbour4',255)->nullable();
            $table->string('periodOfExistenceOfNeighbour4',255)->nullable();
            $table->string('statementByTheNeighbour4',255)->nullable();
            $table->string('nameOfNeighbour5',255)->nullable();
            $table->string('companyNameOfNeighbour5',255)->nullable();
            $table->string('periodOfExistenceOfNeighbour5',255)->nullable();
            $table->string('statementByTheNeighbour5',255)->nullable();
            $table->string('nameOfPostOffice',255)->nullable();
            $table->string('postOfficeReceivesRequest',255)->nullable();
            $table->string('nameOfCourierService',255)->nullable();
            $table->string('courierServiceReceivesRequest',255)->nullable();
            $table->string('additionalRemarks',255)->nullable();
            $table->string('signatureOfVendor',255)->nullable();   
            $table->string('a1',150)->nullable();
            $table->string('a2',150)->nullable();
            $table->string('a3',150)->nullable();
            $table->string('a4',150)->nullable();
            $table->string('a5',150)->nullable();
            $table->string('a6',150)->nullable();
            $table->string('a7',150)->nullable();
            $table->string('a8',150)->nullable();
            $table->string('a9',150)->nullable();
            $table->string('a10',150)->nullable();     
            $table->date('Date')->nullable();
            $table->time('Time')->nullable();   
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
        Schema::dropIfExists('company_verifications');
    }
};
