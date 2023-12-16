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
        Schema::create('cpr_banners', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('banner',255);
            $table->text('link')->nullable();
            $table->text('heading')->nullable();
            $table->text('description')->nullable();
            $table->text('position')->nullable();
            $table->string('slider_short')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('cpr_banners');
    }
};
