<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

use App\Http\Requests;

class SubProjectController extends Controller
{
    function index( $id ){
        $subprojects = Project::where('project_id',$id)->get();
        $project = $id;
        return view('subproject.index')->with(compact('subprojects','project'));
    }

    function create( Request $request )
    {
        $project_id = $request->get('project');
        $name = $request->get('name');
        $level = $request->get('level');
        $state = $request->get('state');
        $visibility = $request->get('visibility');
        $description= $request->get('description');

        $project = Project::where('name',$name)->first();

        if(  $project != null )
            return response()->json(['error'=>true,'message'=>'Ya existe un proyecto registrado con ese nombre.']);

        $project = Project::create([
            'name'=>$name,
            'level_id'=>$level,
            'state_id'=>$state,
            'visibility'=>$visibility,
            'description'=>$description,
            'project_id'=>$project_id
        ]);
        $project->save();

        return response()->json(['error'=>false,'message'=>'Subproyecto registrado correctamente.']);
    }

    function edit( Request $request )
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $level = $request->get('level');
        $state = $request->get('state');
        $visibility = $request->get('visibility');
        $description= $request->get('description');

        $project = Project::where('name',$name)->first();
        if( $project != null && $project->id != $id )
            return response()->json(['error'=>true,'message'=>'Ya existe un proyecto registrado con ese nombre.']);

        $project = Project::find($id);
        $project->name = $name;
        $project->level_id = $level;
        $project->state_id = $state;
        $project->visibility = $visibility;
        $project->description = $description;
        $project->save();

        return response()->json(['error'=>false,'message'=>'Subproyecto modificado correctamente.']);
    }

    function delete(Request $request)
    {
        $id = $request->get('id');
        $project= Project::find($id);
        $project->delete();

        return response()->json(['error'=>false,'message'=>'Subproyecto eliminado correctamente.']);
    }
}
