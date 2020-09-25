<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateIlocationsForeignKeysReference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('ilocations__provinces', function (Blueprint $table) {
        $table->dropForeign(['country_id']);
        $table->foreign('country_id')->references('country_code')->on('ilocations__countries')->onDelete('cascade');
      });
      Schema::table('ilocations__cities', function (Blueprint $table) {
        $table->dropForeign(['country_id']);
        $table->foreign('country_id')->references('country_code')->on('ilocations__countries')->onDelete('cascade');
    
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    
    }
}
