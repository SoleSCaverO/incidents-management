<?php

namespace App\Http\Controllers;

use App\Level;
use App\Project;
use App\State;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProjectController extends Controller
{
    function index(){
        $projects = Project::where('project_id',0)->get();
        return view('project.index')->with(compact('projects'));
    }

    function create( Request $request )
    {
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
           'description'=>$description
        ]);
        $project->save();

        return response()->json(['error'=>false,'message'=>'Proyecto registrado correctamente.']);
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

        return response()->json(['error'=>false,'message'=>'Proyecto modificado correctamente.']);
    }

    function delete(Request $request)
    {
        $id = $request->get('id');
        $project= Project::find($id);
        $subproject = Project::where('project_id',$id)->first();
        if( $subproject != null )
            return response()->json(['error'=>true,'message'=>'Error al eliminar proyecto, existen subproyectos asociados.']);
        $project->delete();

        return response()->json(['error'=>false,'message'=>'Proyecto eliminado correctamente.']);
    }

    function level(){
        $levels = Level::all();
        return response()->json($levels);
    }
    function state(){
        $states = State::where('type',1)->get();
        return response()->json($states);
    }
}
