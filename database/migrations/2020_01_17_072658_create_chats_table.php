<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chats', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('groups', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('group_user', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('group_id');
			$table->timestamps();

			$table->unique(['user_id', 'group_id']);

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
		});

		Schema::create('templates', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('message');
			$table->timestamps();
		});

		DB::table('templates')->insert(
			array(
				'name' => 'webside',
				'message' => 'visit our webside https://SomeDomainOfACompany.com'
			)
		);


		Schema::create('entity_chat', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('user_id')->nullable();
			$table->unsignedBigInteger('group_id')->nullable();
			$table->unsignedBigInteger('chat_id');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
			$table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
		});

		Schema::create('chat_messages', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('chat_id');
			$table->string('message')->nullable();
			$table->unsignedBigInteger('template_id')->nullable();
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
			$table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
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
		Schema::dropIfExists('chats');
		Schema::dropIfExists('templates');
		Schema::dropIfExists('groups');
		Schema::dropIfExists('chatmessage');
		Schema::dropIfExists('entity_chat');
	}
}
