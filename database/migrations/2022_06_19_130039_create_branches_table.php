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
        Schema::create('branches', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('CompanyName');
            $table->string('BranchName',200);
            $table->string('BranchEmail',200)->nullable();
            $table->string('BranchPhone',20)->nullable();
            $table->text('BranchAddress')->nullable();
            $table->string('Country',20)->nullable();
            $table->bigInteger('State')->nullable();
            $table->bigInteger('city')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('branches');
    }
};
