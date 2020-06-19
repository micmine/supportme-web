<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Groups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->timestamps();
        });

        DB::table('groups')->insert(
			array(
				'name' => 'user'
			)
		);

		DB::table('groups')->insert(
			array(
				'name' => 'team'
			)
		);

		DB::table('groups')->insert(
			array(
				'name' => 'supportlevel-1'
			)
		);

		DB::table('groups')->insert(
			array(
				'name' => 'supportlevel-2'
			)
		);

		DB::table('groups')->insert(
			array(
				'name' => 'supportlevel-3'
			)
		);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
