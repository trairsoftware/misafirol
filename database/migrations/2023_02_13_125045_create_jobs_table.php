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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('age');
            $table->string('education_status');
            $table->string('family_members');
            $table->string('afad_registration');
            $table->string('earthquake_site');
            $table->string('previous_occupation');
            $table->string('Jobs_can_work');
            $table->string('searched_province');
            $table->string('status');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
