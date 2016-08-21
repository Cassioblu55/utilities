<?php

namespace Illuminate\Contracts\Database;
use Illuminate\Database\Seeder;
use App\User;
use DB;
use Hash;

class UsersTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'name'     => 'Cassio Hudson',
			'username' => 'cbhudson',
			'email'    => 'cassioblubyrd@gmail.com',
			'password' => Hash::make('password'),
		));
	}

}