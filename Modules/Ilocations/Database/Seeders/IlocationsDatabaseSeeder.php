<?php

namespace Modules\Ilocations\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class IlocationsDatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $this->call(CountryTableSeeder::class);
    $this->call(ProvinceTableSeeder::class);
    $this->call(CityTableSeeder::class);
  }
}
