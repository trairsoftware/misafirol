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
        Schema::table('users', function (Blueprint $table) {
            $table->string('tax_number')->nullable();
            $table->string('tax_adminastration')->nullable();
            $table->string('institutional_type')->nullable();
            $table->boolean('is_institutional')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tax_number')->nullable();
            $table->string('tax_adminastration')->nullable();
            $table->string('institutional_type')->nullable();
            $table->boolean('is_institutional')->nullable()->default(false);
        });
    }
};
