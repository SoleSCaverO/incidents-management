<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

use App\Http\Requests;

class LevelController extends Controller
{
    function show()
    {
        $projects = Project::where('project_id',0)->get();
        $project_subprojects = [];

        foreach ( $projects as $project )
            $project_subprojects[] = ['project' => $project,'subprojects'=>$this->get_subprojects($project->id)];

        return view('level.show')->with(compact('project_subprojects'));
    }

    function get_subprojects( $id )
    {
        return $projects = Project::where('project_id',$id)->get();
    }

    function index()
    {
        return view('level.orderLevel');
    }
}

