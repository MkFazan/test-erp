<?php

namespace App\Http\Controllers;

use App\Exports\ProjectsExport;
use App\Http\Requests\StoreProjectRequest;
use App\Imports\ProjectsImport;
use App\Project;
use App\Repositories\ProjectRepository;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;
    /**
     * @var ProjectService
     */
    private $projectService;

    /**
     * ProjectController constructor.
     * @param ProjectRepository $projectRepository
     * @param ProjectService $projectService
     */
    public function __construct(
        ProjectRepository $projectRepository,
        ProjectService $projectService
    )
    {
        $this->projectRepository = $projectRepository;
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($this->projectRepository->getProjects());
        return view('project.index', [
            'projects' => $this->projectRepository->getProjects()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('project.form', [
            'title' => 'Create',
            'projectTypes' => $this->projectRepository->getProjectType(),
            'skills' => $this->projectRepository->getSkills()
        ]);
    }


    /**
     * @param StoreProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProjectRequest $request)
    {
        $return = $this->projectService->createProject(collect($request->all()));

        return redirect()->route('projects.index')->with($return);
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return void
     */
    public function show(Project $project)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('project.form', [
            'title' => 'Update',
            'project' => $project->load('skill'),
            'projectTypes' => $this->projectRepository->getProjectType(),
            'skills' => $this->projectRepository->getSkills()
        ]);
    }


    /**
     * @param StoreProjectRequest $request
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        $return = $this->projectService->updateProject(collect($request->all()), $project);

        return redirect()->route('projects.index')->with($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return void
     */
    public function destroy(Project $project)
    {
        dd('delete');
    }

    public function import()
    {
        Excel::import(new ProjectsImport, 'project.xls');
    }

    public function export()
    {
        return Excel::download(new ProjectsExport, 'projects.xls');
    }

}
