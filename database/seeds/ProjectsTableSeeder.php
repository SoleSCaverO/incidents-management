<?php

use App\Level;
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
        Level::create([
            'name'=>'Service desk'
        ]);
        Level::create([
            'name'=>'Administradores de red/servidor'
        ]);
        Level::create([
            'name'=>'Desarrolladores y arquitectos'
        ]);
        Level::create([
            'name'=>'Proveedores'
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
            'level_id'=>2,
            'state_id'=>1
        ]);

        Project::create([
            'name'=>'Proyecto test 02',
            'level_id'=>3,
            'state_id'=>1
        ]);

        Project::create([
            'name'=>'Proyecto test 03',
            'level_id'=>4,
            'state_id'=>1
        ]);

        //Subprojects
        Project::create([
            'name'=>'Subproyecto 01 de proyecto 01',
            'level_id'=>4,
            'state_id'=>1,
            'project_id'=>1
        ]);
        Project::create([
            'name'=>'Subproyecto 01 de proyecto 02',
            'level_id'=>3,
            'state_id'=>1,
            'project_id'=>2
        ]);
        Project::create([
            'name'=>'Subproyecto 02 de proyecto 02',
            'level_id'=>3,
            'state_id'=>1,
            'project_id'=>2
        ]);
    }
}
