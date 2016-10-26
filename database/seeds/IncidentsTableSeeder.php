<?php

use App\Frequency;
use App\Incident;
use App\Priority;
use App\State;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class IncidentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //States 4,5,6,7
        State::create([
            'type'=>2,
            'name'=>'Aceptada'
        ]);
        State::create([
            'type'=>2,
            'name'=>'En proceso'
        ]);
        State::create([
            'type'=>2,
            'name'=>'Resuelta'
        ]);
        State::create([
            'type'=>2,
            'name'=>'Cerrrada'
        ]);

        //Frequencies 1,2,3,4
        Frequency::create([
            'name'=>'Siempre'
        ]);
        Frequency::create([
            'name'=>'Aveces'
        ]);
        Frequency::create([
            'name'=>'Aleatorio'
        ]);
        Frequency::create([
            'name'=>'Desconocido'
        ]);

        //Priorities 1,2,3,4
        Priority::create([
            'name'=>'Crítica'
        ]);
        Priority::create([
            'name'=>'Alta'
        ]);
        Priority::create([
            'name'=>'Media'
        ]);
        Priority::create([
            'name'=>'Baja'
        ]);

        $date = new Carbon();
        $date = $date->format('d-m-Y');

        Incident::create([
            'name'=>'Incidencia de prueba',
            'summary'=>'Summary',
            'category'=>1,
            'state_id'=>4,
            'date'=>$date,
            'frequency_id'=>4,
            'priority_id'=>4,
            'user_id'=>1,
            'file'=>'1.jpg',
            'platform'=>'Platform',
            'os'=>'Operating System',
            'os_version'=>'Operating System Version',
            'project_id'=>1
        ]);
    }
}
