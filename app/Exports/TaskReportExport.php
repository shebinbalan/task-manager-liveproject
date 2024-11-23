<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TaskReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Fetch task data with related project details
        return Task::select('tasks.title', 'tasks.status', 'tasks.created_at', 'projects.name as project_name', 'tasks.updated_at')
            ->join('projects', 'tasks.project_id', '=', 'projects.id')
            ->get();
    }

    /**
     * Return the headings for the export file
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Task Title',
            'Task Status',
            'Created At',
            'Project Name',
            'Updated At',
        ];
    }
}
