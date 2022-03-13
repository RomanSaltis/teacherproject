<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Project;
use App\Models\Student;
use Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
                
        $studentList = [];
        foreach ($groups as $group){
            $temp = Student::where('group_id', '=', $group->id)->get(['student_name','student_surname']);
            $studentList[$group->id] = $temp;
            
        }
         return view('group.index', ['groups' => $groups, 'studentList' => $studentList]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        return view('group.create', ['projects' => $projects]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        $validator = Validator::make($request->all(),
            [
                'group_number' => ['required', 'numeric', 'min:1', 'max:5'],
            ],
            [
                'group_number.required' => 'Group number required',
                'group_number.numeric' => 'Group number must be filled with numbers',
                'group_number.min' => 'Group number must be 1 or greater',
                'group_number.max' => 'Max number is 5',
            ]
        );
    if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
    }     

        $group = new Group;
        $group->group_number = $request->group_number;
        $group->project_id = $request->project_id;
        $group->save();
        return redirect()->route('group.index')->with('success_message', 'Successfully stored');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
       //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupRequest  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $validator = Validator::make($request->all(),
            [
                'group_number' => ['required', 'numeric', 'min:1', 'max:5'],
            ],
            [
                'group_number.required' => 'Group number required',
                'group_number.numeric' => 'Group number must be filled with numbers',
                'group_number.min' => 'Group number must be 1 or greater',
                'group_number.max' => 'Max number is 5',
            ]
        );
    if ($validator->fails()) {
        $request->flash();
        return redirect()->back()->withErrors($validator);
    }     

        $group->group_number = $request->group_number;
        $group->project_id = $request->project_id;
        $group->save();
        return redirect()->route('group.index')->with('success_message', 'Successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        if($group->groupStudents->count()){
           return redirect()->route('group.index')->with('info_message', 'Cannot delete because it has students');
       }
       $group->delete();
       return redirect()->route('group.index')->with('success_message', 'Successfully deleted');
    }
}
