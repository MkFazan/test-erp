<?php

namespace App\Imports;


use App\Project;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProjectsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $type =  getProjectTypeId($row[9]);
            $skills = $row[8];
            dd($row);
            Project::create([
                'title' => $row[0],
                'user_id' => auth()->user()->id,
                'description' => $row[2],
                'organization' => $row[3],
                'start' => $row[4],
                'end' => $row[5],
                'role' => $row[6],
                'link' => $row[7],
                'skill_id' => $row[8],
                'type_id' => $row[2],
            ]);
        }
    }
}