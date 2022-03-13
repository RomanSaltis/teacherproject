@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Groups list</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Group number</th>
                                <th>Max number of students</th>
                                <th>Project ID</th>
                                @auth
                                <th>Students list</th>
                                <th>Delete</th>
                                @endauth
                            </tr>
                            @foreach ($groups as $group)
                            <tr>
                                <td>{{$group->group_number}}</td>
                                <td>2</td>
                                <td>{{$group->project_id}}</td>
                                @auth
                                <td>@foreach ($studentList[$group->id] as $student)
                                    {{$student->student_name}} {{$student->student_surname}}<br>
                                    @endforeach
                                </td>
                                <td>
                                    <form method="POST" action="{{route('group.destroy', $group)}}">
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





