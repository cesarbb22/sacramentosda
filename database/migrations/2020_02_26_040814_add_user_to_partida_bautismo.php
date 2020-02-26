<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserToPartidaBautismo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ActaBautismo', function (Blueprint $table) {
            $table->integer('IDUserRegistra')->nullable($value = false);
            $table->integer('IDParroquiaRegistra')->nullable($value = false);

            $table->foreign('IDUserRegistra')->references('IDUser')->on('User');
            $table->foreign('IDParroquiaRegistra')->references('IDParroquia')->on('Parroquia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ActaBautismo', function (Blueprint $table) {
            $table->dropColumn(['IDUserRegistra',  'IDParroquiaRegistra']);

            $table->dropForeign(['IDUserRegistra', 'IDParroquiaRegistra']);
        });
    }
}
