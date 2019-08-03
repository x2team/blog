<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \DB::table('users')->delete();

        // factory(App\User::class, 3)->create()->each(function($u){
        //     $u->questions()
        //       ->saveMany(
        //           factory(App\Question::class, rand(1,5))->make()
        //       )
        //       ->each(function ($q){
        //           $q->answers()
        //             ->saveMany(factory(App\Answer::class, rand(1, 5))->make());
        //       });
        // });

        factory(App\User::class, 3)->create();
    }
}
