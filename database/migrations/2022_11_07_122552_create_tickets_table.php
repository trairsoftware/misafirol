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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title', 120);
            $table->text('body');
            $table->string('company', 60)->nullable();
            $table->string('ticket_owner', 60)->nullable();
            $table->boolean('is_active');
            $table->string('status');
            $table->integer('priority')->nullable()->default(3);;
            $table->integer('client_id')->unsigned()->nullable();
            $table->string('ticket_manager')->nullable();
            $table->date('estimated_deadline')->nullable();
            $table->date('started_date')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
