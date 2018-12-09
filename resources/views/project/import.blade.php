@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Import Projects</div>
        <div class="card-body">
            <form id="import_file" enctype="multipart/form-data" method="post" action="{{route('import.project.file')}}">
                @csrf
                <input type="hidden" name="MAX_FILE_SIZE" value="{{config('app.max_size_file')}}" />
                <input type="file" name="file">
                <select name="type">
                    <option value="1">Excel</option>
                    <option value="2">Csv</option>
                </select>
                <a onclick="document.getElementById('import_file').submit()" class="list-group-item list-group-item-action">Import
                    Project</a>
            </form>
        </div>
    </div>
@endsection
