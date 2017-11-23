@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        New Task
                    </div>

                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                        <form name="advert" action="{{ url('/add_advert')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="advert_title" class="control-label">Title</label>
                                    <input type="text" name="advert_title" id="advert_title" class="form-control" value="{{ old('advert_title') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="advert_desc" class="control-label">Description</label>
                                    <textarea type="text" name="advert_desc" id="advert_desc" class="form-control" value="{{ old('advert_desc') }}" rows="5"></textarea>
                                </div>
                            </div>

                            <!-- Add Task Button -->
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-plus"></i>Add Task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            @if (count($adverts) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                            <th>Task</th>
                            <th>&nbsp;</th>
                            </thead>
                            <tbody>
                            @foreach ($adverts as $advert)
                                <tr >
                                    <td class="table-text" colspan="2"><div>{{ $advert->title }}</div></td>
                                </tr>
                                <tr>
                                    <td class="table-text" colspan="2"><div>{{ $advert->description }}</div></td>
                                </tr>
                                <tr>
                                    <td class="table-text"><div>{{ $advert->author_name }}</div></td>
                                    <td>
                                            @if(\Illuminate\Support\Facades\Auth::user()&& \Illuminate\Support\Facades\Auth::user()->id == $advert->author_id )

                                                <form action="{{ url('delete/'.$advert->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>Delete
                                                    </button>
                                                </form>
                                            @endif
                                    </td>
                                </tr>
                                <tr>
                                    <!-- Task Delete Button -->

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer">
                            <?= $adverts->render(); ?>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-2 ">
            <div class="panel panel-default">
                @if (Auth::guest())
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form name="authorization" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label for="name" class="col-md-4 control-label">Name</label>
                                    <input id="email" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label for="password" class="col-md-4 control-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <a href="{{ url('/register') }}" class="btn btn-block">Register</a></li>
                        </div>
                    </div>
                @else
                    <div class="panel-heading ">Hello, <strong>{{ Auth::user()->name }}</strong></div>
                    <div class="panel-body">

                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-primary btn-block">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                @endif


            </div>
        </div>
    </div>
</div>
@endsection
