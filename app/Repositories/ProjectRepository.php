<?php

namespace App\Repositories;


use App\Project;
use App\ProjectSkill;
use App\Skill;

class ProjectRepository
{
    /**
     * @return array
     */
    public function getProjectType()
    {
        return Project::getType();
    }

    /**
     * @return Skill[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getSkills()
    {
        return Skill::all();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return Project::create($data->toArray());
    }

    public function update($data, Project $project)
    {
        return $project->update($data);
    }

    /**
     * @param $title
     * @return mixed
     */
    public function createSkill($title)
    {
        return Skill::firstOrCreate(['title' => $title]);
    }

    /**
     * @param Project $project
     * @param Skill $skill
     * @return mixed
     */
    public function saveRelationSkill(Project $project, $skill)
    {
        return ProjectSkill::create([
            'skill_id' => $skill,
            'project_id' => $project->id
        ]);
    }

    /**
     * @param bool $paginate
     * @return Project[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getProjects($paginate = false)
    {
        if ($paginate) {
            return Project::with('skill', 'user', 'type')
                ->orderBy('created_at', 'desc')
                ->paginate($paginate);
        } else {
            return Project::with('skill', 'user', 'type')
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    /**
     * @param $data
     * @param Project $project
     * @return mixed
     */
    public function deleteSkill($data, Project $project)
    {
        return ProjectSkill::where('project_id', $project->id)
            ->whereIn('skill_id', $data)
            ->delete();
    }
}