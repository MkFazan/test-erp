<?php
/**
 * Created by PhpStorm.
 * User: illidan
 * Date: 08.12.2018
 * Time: 18:29
 */

namespace App\Services;


use App\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * ProjectService constructor.
     * @param ProjectRepository $projectRepository
     */
    public function __construct(
        ProjectRepository $projectRepository
    )
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param $data
     * @return array
     */
    public function createProject($data)
    {
        $data['user_id'] = auth()->id();

        try {
            DB::beginTransaction();
            $project = $this->projectRepository->create($data);
            if (isset($data['skills'])) {
                if (!empty($data['skills'])) {
                    foreach ($data['skills'] as $skill) {
                        //$skill = $this->projectRepository->createSkill($skill);
                        $this->projectRepository->saveRelationSkill($project, $skill);
                    }
                }
            }
            DB::commit();

            return ['success' => $project];
        } catch (\Throwable  $e) {
            DB::rollback();

            return ['error' => $e];
        }
    }

    /**
     * @param $data
     * @param Project $project
     * @return array
     */
    public function updateProject($data, Project $project)
    {
        try {
            DB::beginTransaction();
            $status = $this->projectRepository->update($data->toArray(), $project);
            if ($status) {
                if (isset($data['skills'])) {
                    if (!empty($data['skills'])) {
                        $project = $project->load('skill');
                        $skillOld = $project->skill->pluck('id')->toArray();
                        foreach ($data['skills'] as $skill) {
                            if (!in_array($skill, $skillOld)) {
                                $this->projectRepository->saveRelationSkill($project, $skill);
                            }
                            if (($key = array_search($skill, $skillOld)) !== FALSE) {
                                unset($skillOld[$key]);
                            }
                        }
                        $this->projectRepository->deleteSkill($skillOld, $project);
                    }
                }
                DB::commit();
                return ['success' => $project];
            } else {
                DB::rollback();
                return ['error' => 'Not updated'];
            }
        } catch (\Throwable  $e) {
            DB::rollback();
            return ['error' => $e];
        }
    }

    /**
     * @param Project $project
     * @return array
     */
    public function delete(Project $project)
    {
        try {
            DB::beginTransaction();
            $project = $project->load('skill');
            $skillOld = $project->skill->pluck('id')->toArray();
            $this->projectRepository->deleteSkill($skillOld, $project);
            $project->delete();
            DB::commit();

            return ['success' => $project];
        } catch (\Throwable  $e) {
            DB::rollback();

            return ['error' => $e];
        }
    }
}