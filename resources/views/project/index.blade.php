@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Project</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Project name</th>
                            <th>Groups number</th>
                            @auth
                            <th>Edit</th>
                            <th>Delete</th>
                            @endauth
                        </tr>
                        @foreach ($projects as $project)
                        <tr>
                            <td>{{$project->project_name}}</td>
                            <td>5</td>
                            @auth
                            <td><a class="btn btn-primary" href="{{route('project.edit',[$project])}}">Edit</a></td>
                            <td>
                                <form method="POST" action="{{route('project.destroy', $project)}}">
                                @csrf
                                <button class="btn btn-warning" type="submit">Delete</button>
                                </form>
                            </td>
                            @endauth
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



