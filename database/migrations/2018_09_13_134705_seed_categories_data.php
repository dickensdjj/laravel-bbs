<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $categories = [
            [
                'name'        => 'Chinese Food',
                'description' => '中国菜称霸全世界',
            ],
            [
                'name'        => 'Spanish Food',
                'description' => 'la comida española te hace sentir caliente
                ',
            ],
            [
                'name'        => 'Korean Food',
                'description' => 'All made in Korean Special Chilli sauce (고추장)',
            ],
            [
                'name'        => 'Italian Food',
                'description' => 'L\'italiano non ha solo tartufo e prosciutto',
            ],
        ];

        // insert seed data
        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::table('categories')->truncate();
    }
}
