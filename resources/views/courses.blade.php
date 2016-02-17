<!-- resources/views/courses.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Nieuwe opleiding
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('course') }}" method="POST" class="form-horizontal">
                        {!! csrf_field() !!}

                        <!-- Course Name -->
                        <div class="form-group">
                            <label for="course" class="col-sm-3 control-label">Opleiding</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" id="course-name" class="form-control">
                            </div>
                        </div>

                        <!-- Course Date -->
                        <div class="form-group">
                            <label for="course" class="col-sm-3 control-label">Datum</label>
                            <div class="col-sm-6">
                                <input type="date" name="date" id="course-date" class="form-control">
                            </div>
                        </div>

                        <!-- Add Course Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i> Opleiding toevoegen
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Courses -->
            @if (count($courses) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Huidige opleidingen
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <!-- Table Headings -->
                            <thead>
                            <th>Opleiding</th>
                            <th>Datum</th>
                            <th>&nbsp;</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <!-- Task Name -->
                                    <td class="table-text">
                                        <div>{{ $course->name }}</div>
                                    </td>

                                    <td class="table-text">
                                        <div>{{ $course->date }}</div>
                                    </td>

                                    <td>
                                        <form action="{{ url('course/'.$course->id) }}" method="POST">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Verwijder
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection