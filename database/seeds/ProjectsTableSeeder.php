<?php

use App\Level;
use App\Profile;
use App\Project;
use App\State;
use App\Visibility;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Levels
        Profile::create([
            'name'=>'Administrador de red'
        ]);
        Profile::create([
            'name'=>'Administrador de servidores'
        ]);
        Profile::create([
            'name'=>'Desarrollador'
        ]);
        Profile::create([
            'name'=>'Arquitecto de sistemas'
        ]);

        //States
        State::create([
            'name'=>'En desarrollo'
        ]);
        State::create([
            'name'=>'Estable'
        ]);
        State::create([
            'name'=>'Obsoleto'
        ]);

        //Projects
        Project::create([
            'name'=>'Proyecto test 01',
            'state_id'=>1
        ]);

        Project::create([
            'name'=>'Proyecto test 02',
            'state_id'=>1
        ]);

        Project::create([
            'name'=>'Proyecto test 03',
            'state_id'=>1
        ]);

        //Subprojects
        Project::create([
            'name'=>'Subproyecto 01 de proyecto 01',
            'state_id'=>1,
            'project_id'=>1
        ]);
        Project::create([
            'name'=>'Subproyecto 01 de proyecto 02',
            'state_id'=>1,
            'project_id'=>2
        ]);
        Project::create([
            'name'=>'Subproyecto 02 de proyecto 02',
            'state_id'=>1,
            'project_id'=>2
        ]);
    }
}
