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
            Project::create([
                'name' => $row[0],
            ]);
        }
    }
}