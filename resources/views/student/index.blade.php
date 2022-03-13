@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">Students</div>
                <div class="card-body">
                    <table class="table">
                        <tr>@auth
                            <th>Student name</th>
                            <th>Student surname</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            @endauth
                        </tr>
                        @foreach ($students as $student)
                        <tr>
                            @auth
                            <td>{{$student->student_name}}</td>
                            <td>{{$student->student_surname}}</td>
                            <td><a class="btn btn-primary" href="{{route('student.edit',[$student])}}">Redaguoti</a></td>
                            <td>
                                <form method="POST" action="{{route('student.destroy', $student)}}">
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







