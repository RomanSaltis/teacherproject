@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Create group</div>

               <div class="card-body">
                    <form method="POST" action="{{route('group.store')}}">
                        <div class="form-group">
                            <label>Group number</label>
                            <input type="text" name="group_number" class="form-control" value="{{old('group_number')}}" >
                            <small class="form-text text-muted">Group number</small>
                        </div>
                        <select class="form-select" name="project_id">
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->project_name}} </option>
                            @endforeach
                        </select>
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


