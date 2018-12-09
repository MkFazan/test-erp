@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Projects</div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Organization</th>
                    <th scope="col">Type</th>
                    <th scope="col">Role</th>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($projects))
                    @foreach($projects as $project)
                        <tr>
                            <th scope="row">{{$project->id}}</th>
                            <td>{{$project->title}}</td>
                            <td>{{$project->organization}}</td>
                            <td>{{$project->type_id}}</td>
                            <td>{{$project->role}}</td>
                            <td>{{$project->start}}</td>
                            <td>{{$project->end}}</td>
                            <td>
                                <a href="{{route('projects.edit', ['project' => $project->id])}}">Edit</a>
                                <a href="{{route('projects.destroy', ['project' => 1])}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="justify-content-center">
                            <h4 class="justify-content-center">Non object</h4>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
