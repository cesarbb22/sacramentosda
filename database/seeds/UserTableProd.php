<?php

use Illuminate\Database\Seeder;

class UserTableProd extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('User')->insert([
            'Nombre' => 'Sixto Eduardo',
            'PrimerApellido' => 'Varela',
            'SegundoApellido' => 'Santamaria',
            'Email' => 'archivocuriaalajuela@hotmail.com',
            'IDParroquia' => 1,
            'NumCelular' => '',
            'IDPuesto' => 1,
            'Activo' => 1,
            'password' => bcrypt('canciller'),
        ]);
    }
}
