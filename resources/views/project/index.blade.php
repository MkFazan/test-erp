@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Projects</div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#Id</th>
                    <th scope="col">Author</th>
                    <th scope="col">Title</th>
                    <th scope="col">Organization</th>
                    <th scope="col">Type</th>
                    <th scope="col">Role</th>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($projects))
                    @foreach($projects as $project)
                        <tr>
                            <th scope="row">{{$project->id}}</th>
                            <td><a class="btn btn-light" href="#">{{$project->user->name}}</a></td>
                            <td><a style="text-decoration: none; color: #3d4852" href="{{route('projects.show', ['project' => $project->id])}}">{{$project->title}}</a></td>
                            <td><a style="text-decoration: none; color: #3d4852" href="{{route('projects.show', ['project' => $project->id])}}">{{$project->organization}}</a></td>
                            <td><a style="text-decoration: none; color: #3d4852" href="{{route('projects.show', ['project' => $project->id])}}">{{$project->type->title}}</a></td>
                            <td><a style="text-decoration: none; color: #3d4852" href="{{route('projects.show', ['project' => $project->id])}}">{{$project->role}}</a></td>
                            <td><a style="text-decoration: none; color: #3d4852" href="{{route('projects.show', ['project' => $project->id])}}">{{$project->start}}</a></td>
                            <td><a style="text-decoration: none; color: #3d4852" href="{{route('projects.show', ['project' => $project->id])}}">{{$project->end}}</a></td>
                            @if (auth()->user()->isAdmin() || auth()->user()->id == $project->user_id)
                                <td>
                                    <a class="btn btn-info"
                                       href="{{route('projects.edit', ['project' => $project->id])}}">Edit</a>
                                </td>
                                <td>
                                    <form id="delete_form_project{{$project->id}}" method="post"
                                          action="{{route('projects.destroy', ['project' => 1])}}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-danger"
                                           onclick="document.getElementById('delete_form_project{{$project->id}}').submit()">Delete</a>
                                    </form>
                                </td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
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
