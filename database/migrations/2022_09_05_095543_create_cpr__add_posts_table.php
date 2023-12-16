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
        Schema::create('cpr__add_posts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('user_id',);
            $table->string('location')->nullable();
            $table->string('category')->nullable();
            $table->string('subCategory')->nullable();
            $table->string('negotiable')->nullable();
            $table->string('plan')->nullable();
            $table->double('price');
            $table->text('Title')->nullable();
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
        Schema::dropIfExists('cpr__add_posts');
    }
};
