<?php

use Illuminate\Database\Seeder;

class NoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notes')->delete();
        \App\Note::create(array(
            'user_id'   => 1,
            'title'     => 'Test note',
            'body'      => 'This is a test note! If you see this, you win! Yay!'
        ));
    }
}