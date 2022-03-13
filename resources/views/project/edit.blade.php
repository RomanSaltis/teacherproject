@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit project</div>

                <div class="card-body">
                    <form method="POST" action="{{route('project.update',$project)}}">
                        <div class="form-group">
                            <label>Project name</label>
                            <input type="text" name="project_name"  class="form-control" value="{{old('project_name',$project->project_name)}}">
                        </div>
                        <br>
                        @csrf
                        <button class="btn btn-primary" type="submit">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

