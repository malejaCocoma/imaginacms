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
    Schema::table('ilocations__countries', function (Blueprint $table) {
      $table->integer('country_code')->unsigned()->index()->change();
      
    });
    Schema::table('ilocations__provinces', function (Blueprint $table) {
      $table->dropForeign('ilocations__provinces_country_id_foreign');
      
    });
    Schema::table('ilocations__provinces', function (Blueprint $table) {
      
      $table->foreign('country_id')->references('country_code')->on('ilocations__countries')->onDelete('cascade');
    });
    Schema::table('ilocations__cities', function (Blueprint $table) {
      $table->dropForeign('ilocations__cities_country_id_foreign');
      
    });;
    
    Schema::table('ilocations__cities', function (Blueprint $table) {
      $table->foreign('country_id')->references('country_code')->on('ilocations__countries')->onDelete('cascade');
      
    });;
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
