<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Group;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\DB;
use Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('project.index', ['projects' => $projects]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        $request->project_name =  ucwords(strtolower($request->project_name));
       
        $validator = Validator::make($request->all(),
            [
                'project_name' => ['required', 'min:2', 'max:30'],
            ],
            [
                'project_name.required' => 'Project Name required',
                'project_name.min' => 'Project Name is to short',
                'project_name.max' => 'Project Name is to long',
            ]
        );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }


        $id = DB::table('projects')->insertGetId(
            ['project_name' => $request->project_name]
        );
        foreach(range(1,5) as $value){
            DB::table('groups')->insert(
            ['group_number' => $value, 
            'project_id' => $id]
        );
        }
        return redirect()->route('project.index')->with('success_message', 'Successfully stored');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('project.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $request->project_name =  ucwords(strtolower($request->project_name));
       
        $validator = Validator::make($request->all(),
            [
                'project_name' => ['required', 'min:2', 'max:30'],
            ],
            [
                'project_name.required' => 'Project Name required',
                'project_name.min' => 'Project Name is to short',
                'project_name.max' => 'Project Name is to long',
            ]
        );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }


        $project->project_name = $request->project_name;
        $project->save();
        return redirect()->route('project.index')->with('success_message', 'Successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->projectGroups->count()){
           return redirect()->route('project.index')->with('info_message', 'Cannot delete because it has groups');
       }
       $project->delete();
       return redirect()->route('project.index')->with('success_message', 'Successfully deleted');



    }
}
