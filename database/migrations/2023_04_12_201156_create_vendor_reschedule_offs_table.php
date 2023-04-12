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
        Schema::create('vendor_reschedule_offs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id');
            $table->date('date');
            $table->time('startTime', $precision = 0);
            $table->time('endTime', $precision = 0);
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
        Schema::dropIfExists('vendor_reschedule_offs');
    }
};
