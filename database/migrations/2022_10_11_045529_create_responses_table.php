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
        Schema::create('responses', function (Blueprint $table) {
            $table->ulid('id');
            $table->foreignUlid('event_id');
            $table->foreignUlid('person_id');
			$table->foreignUlid('group_id')->nullable();
            $table->string('response_state')->nullable();
            $table->string('response_message')->nullable();
            $table->string('response_date')->nullable();
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
        Schema::dropIfExists('responses');
    }
};
