@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Create student</div>

               <div class="card-body">
                    <form method="POST" action="{{route('student.store')}}">
                        <div class="form-group">
                            <label>Student name</label>
                            <input type="text" name="student_name"  class="form-control" value="{{old('student_name')}}" >
                            <small class="form-text text-muted">Student name</small>
                        </div>
                        <div class="form-group">
                            <label>Student surname</label>
                            <input type="text" name="student_surname"  class="form-control" value="{{old('student_surname')}}" >
                            <small class="form-text text-muted">Student surname</small>
                        </div>
                        <select class="form-select" name="group_id">
                            @foreach ($groups as $group)
                                <option value="{{$group->id}}">{{$group->group_number}}</option>
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



