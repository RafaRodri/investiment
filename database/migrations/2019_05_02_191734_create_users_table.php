<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
            $table->increments('id');

            // people data
            $table->char('cpf', 11)->unique()->nullable();
            $table->string('name', 50);
            $table->char('phone', 11);
            $table->date('birth')->nullable();
            $table->char('gender', 1)->nullable();
            $table->text('notes')->nullable();

            // auth data
            $table->string('email', 80)->unique();
            $table->string('password', 254)->nullable();

            // permission
            $table->string('status')->default('active');
            $table->string('permission')->default('app.user');

            // usado para redefinir senha
            $table->rememberToken();
            $table->softDeletes();

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
	    // apagar relacionamentos
        Schema::table('users', function(Blueprint $table) {

        });

        // apagar tabela
		Schema::drop('users');
	}
}
