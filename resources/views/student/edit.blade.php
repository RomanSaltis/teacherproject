@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit student</div>
                <div class="card-body">
                    <form method="POST" action="{{route('student.update',[$student])}}">
                        <div class="form-group">
                            <label>Student name</label>
                            <input type="text" name="student_name"  class="form-control" value="{{old('student_name',$student->student_name)}}">
                            <small class="form-text text-muted">Student name</small>
                        </div>
                        <div class="form-group">
                            <label>Student suename</label>
                            <input type="text" name="student_surname"  class="form-control"value="{{old('student_surname',$student->student_surname)}}">
                            <small class="form-text text-muted">Student surname</small>
                        </div>
                        <label>Group number</label>
                        <select class="form-select" name="group_id">
                            @foreach ($groups as $group)
                                <option value="{{$group->id}}" @if($group->id == $student->group_id) selected @endif>
                                    Group Nr. {{$group->group_number}}
                                </option>
                            @endforeach
                        </select>
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



