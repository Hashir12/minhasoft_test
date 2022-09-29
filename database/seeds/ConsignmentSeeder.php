<?php

use Illuminate\Database\Seeder;
use App\Consignment;

class ConsignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(Consignment::class, 15)->create();
    }
}
