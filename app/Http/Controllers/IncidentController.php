<?php

namespace App\Http\Controllers;

use App\Frequency;
use App\Incident;
use App\Priority;
use App\Project;
use App\State;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class IncidentController extends Controller
{
    function show()
    {
        $projects = Project::where('project_id',0)->get();
        $project_subprojects = [];

        foreach ( $projects as $project )
            $project_subprojects[] = ['project' => $project,'subprojects'=>$this->get_subprojects($project->id)];

        return view('incident.show')->with(compact('project_subprojects'));
    }

    function get_subprojects( $id )
    {
        return $projects = Project::where('project_id',$id)->get();
    }

    function index( $id )
    {
        $incidents = Incident::where('project_id',$id)->where('low',0)->get();
        $project = $id;
        return view('incident.index')->with(compact('incidents','project'));
    }

    function create( Request $request )
    {
        $name = $request->get('name');
        $summary = $request->get('summary');
        $category = $request->get('category');
        $state = $request->get('state');
        $frequency = $request->get('frequency');
        $priority = $request->get('priority');
        $file = $request->file('file');
        $visibility = $request->get('visibility');
        $platform = $request->get('platform');
        $os = $request->get('os');
        $os_version = $request->get('os_version');
        $project = $request->get('project');
        $date = new Carbon();
        $date = $date->format('d-m-Y');

        $incident = Incident::where('name',$name)->first();

        if( $incident != null )
            return response()->json(['error'=>true,'message'=>'Ya existe una incidencia registrada con ese nombre']);

        $incident = Incident::create([
            'name'=>$name,
            'summary'=>$summary,
            'category'=>$category,
            'state_id'=>$state,
            'date'=>$date,
            'frequency_id'=>$frequency,
            'priority_id'=>$priority,
            'user_id'=>Auth::user()->id,
            'visibility'=>$visibility,
            'platform'=>$platform,
            'os'=>$os,
            'os_version'=>$os_version,
            'project_id'=>$project
        ]);
        if( $file )
        {
            $path = public_path().'/assets/img/incident';
            $extension = $file->getClientOriginalExtension();
            $fileName = $incident->id . '.' . $extension;
            $file->move($path, $fileName);
            $incident->file = $fileName;
        }
        else
            $incident->file = '0.png';

        $incident->save();

        return response()->json(['error'=>false,'message'=>'Incidencia registrada correctamente']);
    }

    function edit( Request $request )
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $summary = $request->get('summary');
        $category = $request->get('category');
        $state = $request->get('state');
        $frequency = $request->get('frequency');
        $priority = $request->get('priority');
        $file = $request->file('file');
        $visibility = $request->get('visibility');
        $platform = $request->get('platform');
        $os = $request->get('os');
        $os_version = $request->get('os_version');
        $incident = Incident::where('name',$name)->first();
        if( $incident != null && $incident->id != $id )
            return response()->json(['error'=>true,'message'=>'Ya existe una incidencia registrada con ese nombre']);

        $incident = Incident::find($id);
        $incident->name = $name;
        $incident->summary = $summary;
        $incident->category = $category;
        $incident->state_id = $state;
        $incident->frequency_id = $frequency;
        $incident->priority_id = $priority;
        $incident->visibility = $visibility;
        $incident->platform = $platform;
        $incident->os = $os;
        $incident->os_version = $os_version;

        if( $file )
        {
            $path = public_path().'/assets/img/incident';
            if( $file->getClientOriginalName() != '0.png' )
                File::delete($path.'/'.$file );

            $extension = $file->getClientOriginalExtension();
            $fileName = $incident->id . '.' . $extension;
            $file->move($path, $fileName);
            $incident->file = $fileName;
        }

        $incident->save();

        return response()->json(['error'=>false,'message'=>'Incidencia modificada correctamente']);
    }

    function state()
    {
        $states = State::where('type',2)->get();
        return response()->json($states);
    }

    function frequency()
    {
        $frequencies = Frequency::all();
        return response()->json($frequencies);
    }

    function priority()
    {
        $priorities = Priority::all();
        return response()->json($priorities);
    }
}
