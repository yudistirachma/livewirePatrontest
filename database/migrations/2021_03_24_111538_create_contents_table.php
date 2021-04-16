<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('group_id')->nullable()->constrained('groups');
            $table->text('desc')->nullable();
            $table->string('title')->nullable();
            $table->string('opening')->nullable();
            $table->text('content')->nullable();
            $table->string('closing')->nullable();
            $table->timestamp('verification')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->string('upload')->nullable();
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
        Schema::dropIfExists('contents');
    }
}
