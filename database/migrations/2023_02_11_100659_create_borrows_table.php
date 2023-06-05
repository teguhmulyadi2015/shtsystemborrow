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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->string('trno')->unique();
            $table->string('employee_id_borrow');
            $table->string('asset_id');
            $table->dateTime('date_borrow');
            $table->date('date_return_plan');
            $table->string('employee_id_return')->nullable()->default(null);
            $table->dateTime('date_return')->nullable()->default(null);
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
        Schema::dropIfExists('borrows');
    }
};
