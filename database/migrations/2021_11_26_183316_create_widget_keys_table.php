<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidgetKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widget_keys', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id')->nullable(false);
            $table->string('key', 64);
            $table->boolean('active')->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->index('key');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('widget_keys');
    }
}
