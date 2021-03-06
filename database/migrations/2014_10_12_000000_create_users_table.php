<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedTinyInteger('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->rememberToken();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });

        // Create the default administration user.
        User::create([
            'first_name' => 'Default',
            'last_name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('openorgchart'),
            'role_id' => \App\Role::where('name', 'Administrator')->first()->id
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
