    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create project</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('project.store')}}">
                            <div class="form-group">
                                <label>Project name</label>
                                <input type="text" name="project_name"  class="form-control" >
                            </div>
                            <br>
                            @csrf
                            <button class="btn btn-success" type="submit">ADD</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
