<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\Project;
use App\Models\TimeLog;
use Carbon\Carbon;
use App\Exports\TaskReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
     
        $tasks = Task::all();
        return view('admin.tasks.index',compact('tasks'));
    }

    public function exportReport()
    {
        // Export the task report as an Excel file
        return Excel::download(new TaskReportExport, 'task_report.xlsx');
       // return Excel::download(new TaskReportExport, 'task_report.csv');
    }

    public function create()
    {  
        $projects = Project::all();
        return view('admin.tasks.create',compact('projects'));
    }

    public function store(Request $request)
    {  
       
        $request->validate([
        'title' => 'required',
        
    ]);   
        $tasks = new Task();  
       
        $tasks->title = $request->input('title');
        $tasks->project_id = $request->input('project_id');
        $tasks->description = $request->input('description');
        $tasks->status = $request->input('status');
        $tasks->user_id = Auth::id();
       
        if ($tasks->save()) {
            // Handle file uploads
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    try {
                        // Ensure the file is valid
                        if ($file->isValid()) {
                            // Get file information safely
                            $extension = $file->getClientOriginalExtension();
                            $originalName = $file->getClientOriginalName();
                            $mimeType = $file->getMimeType();
                            
                            // Get file size safely
                            try {
                                $fileSize = $file->getSize();
                            } catch (\Exception $e) {
                                $fileSize = 0; // Set default if size can't be determined
                            }
                            
                            // Create unique filename
                            $filename = time() . '_' . uniqid() . '.' . $extension;
                            
                            // Define the storage path
                            $path = 'uploads/attachments/';
                            
                            // Ensure the directory exists
                            if (!file_exists(public_path($path))) {
                                mkdir(public_path($path), 0777, true);
                            }
                            
                            // Move the file
                            $file->move(public_path($path), $filename);
                            
                            // Create attachment record
                            $taskAttachment = new TaskAttachment();
                            $taskAttachment->task_id = $tasks->id;
                            $taskAttachment->filename = $filename;
                            $taskAttachment->original_filename = $originalName;
                            $taskAttachment->file_path = $path . $filename;
                            $taskAttachment->file_type = $mimeType;
                            $taskAttachment->file_size = $fileSize;
                            $taskAttachment->save();
                        }
                    } catch (\Exception $e) {
                        // Log the error
                        \Log::error('File upload error: ' . $e->getMessage());
                        continue; // Skip this file and continue with others
                    }
                }
            }
            
            return redirect('/tasks')->with('status', 'Task Added Successfully');
        }
        
     
    }

    public function show($id)
    {
        $task = $task = Task::findOrFail($id); 
        return view('admin.tasks.show', compact('task'));
    }

    public function startTimer($taskId)
{
    $task = Task::findOrFail($taskId);
    
    // Create a new time log to mark the start time
    $timeLog = new TimeLog();
    $timeLog->task_id = $task->id;
    $timeLog->start_time = Carbon::now();
    $timeLog->save();

    return redirect()->route('admin.tasks.show', $taskId)->with('status', 'Timer started.');
}

public function stopTimer($taskId)
{
    $task = Task::findOrFail($taskId);
    $timeLog = $task->timeLogs()->latest()->first();

    // Set end time and calculate the total time in seconds
    $timeLog->end_time = Carbon::now();
    $timeLog->total_time = $timeLog->start_time->diffInSeconds($timeLog->end_time);
    $timeLog->save();

    return redirect()->route('admin.tasks.show', $taskId)->with('status', 'Timer stopped.');
}

    public function edit($id)
    {
        $projects = Project::all();
        $task = Task::find($id);
        return view('admin.tasks.edit', compact('task','projects'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'attachments.*' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048'
        ]);

        try {
            $task = Task::findOrFail($id);
            
            // Update task properties
            $task->title = $request->input('title');
            $task->project_id = $request->input('project_id');
            $task->description = $request->input('description');
            $task->status = $request->input('status');

            if ($task->save()) {
                // Handle file uploads
                if ($request->hasFile('attachments')) {
                    foreach ($request->file('attachments') as $file) {
                        try {
                            // Ensure the file is valid
                            if ($file->isValid()) {
                                // Get file information safely
                                $extension = $file->getClientOriginalExtension();
                                $originalName = $file->getClientOriginalName();
                                $mimeType = $file->getMimeType();
                                
                                // Get file size safely
                                try {
                                    $fileSize = $file->getSize();
                                } catch (\Exception $e) {
                                    $fileSize = 0; // Set default if size can't be determined
                                }
                                
                                // Create unique filename
                                $filename = time() . '_' . uniqid() . '.' . $extension;
                                
                                // Define the storage path
                                $path = 'uploads/attachments/';
                                
                                // Ensure the directory exists
                                if (!file_exists(public_path($path))) {
                                    mkdir(public_path($path), 0777, true);
                                }
                                
                                // Move the file
                                $file->move(public_path($path), $filename);
                                
                                // Create attachment record
                                $taskAttachment = new TaskAttachment();
                                $taskAttachment->task_id = $task->id;
                                $taskAttachment->filename = $filename;
                                $taskAttachment->original_filename = $originalName;
                                $taskAttachment->file_path = $path . $filename;
                                $taskAttachment->file_type = $mimeType;
                                $taskAttachment->file_size = $fileSize;
                                $taskAttachment->save();
                            }
                        } catch (\Exception $e) {
                            // Log the error
                            \Log::error('File upload error during task update: ' . $e->getMessage());
                            continue; // Skip this file and continue with others
                        }
                    }
                }
                
                return redirect('/tasks')->with('status', 'Task updated successfully');
            }
            
            return redirect('/tasks')->with('error', 'Error updating task');
            
        } catch (\Exception $e) {
            \Log::error('Task update error: ' . $e->getMessage());
            return redirect('/tasks')->with('error', 'Error updating task: ' . $e->getMessage());
        }
    }
    
       
             
  

    public function destroy($id)
    {
        $task =Task::find($id);   
        $task->delete();
        return redirect('/tasks')->with('status','tasks Deleted Successfully');
    }


    public function removeAttachment(Request $request, $attachmentId)
    {
        try {
            // Find the attachment by its ID
            $attachment = TaskAttachment::findOrFail($attachmentId);
    
            // Delete the physical file
            $filePath = public_path($attachment->file_path);
            if (file_exists($filePath)) {
                unlink($filePath); // Remove the file from the filesystem
            }
            
            // Delete the database record
            $attachment->delete();
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Error removing attachment: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error removing attachment'], 500);
        }
    }


    public function downloadAttachment($attachmentId)
{
    try {
        // Find the attachment by its ID
        $attachment = TaskAttachment::findOrFail($attachmentId);
        
        // Get the full file path
        $filePath = public_path($attachment->file_path);

        // Check if the file exists
        if (file_exists($filePath)) {
            // Return the file for download
            return response()->download($filePath, $attachment->original_filename);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    } catch (\Exception $e) {
        \Log::error('Download error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error downloading the attachment.');
    }
}

}
