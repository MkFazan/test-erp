@extends('layouts.app')

@section('content')
    <div class="card">
        <form>
            <div class="card-header">{{$title . ' Projects'}}</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
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
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>
                            <a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection
