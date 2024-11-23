<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
       
        return view('admin.projects.index',compact('projects'));
    }

    public function create()
    {  
       
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {  
       
        $request->validate([
        'name' => 'required',
        
    ]);   
        $projects = new Project();  
        $projects->user_id = Auth::id();
        $projects->name = $request->input('name');
        $projects->description = $request->input('description');
        $projects->save();
        return redirect('/projects')->with('status','Projects Added Successfully');
     
    }

    public function show($id)
    {
        $project = Project::findOrFail($id); 
        return view('admin.projects.show', compact('project'));
    }

    public function edit($id)
    {
       
        $project = Project::find($id);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $request->validate([
            'name' => 'required',
          
           
        ]);   
      // Update Comment properties
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->save();
    
        return redirect('/projects')->with('status', 'Projects updated successfully');
             
    }

    public function destroy($id)
    {
        $project =Project::find($id);   
        $project->delete();
        return redirect('/projects')->with('status','Projects Deleted Successfully');
    }

}
