@extends('layouts.app')

@section('content')

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                @include('common.errors')

                <!-- New Task Form -->
                    <form name="advert" action="{{ url('/edit')}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="advert_title" class="control-label">Title</label>
                                <input type="text" name="advert_title" id="advert_title" class="form-control"
                                        @if(old('advert_title'))
                                        value="{{ old('advert_title')}}"
                                        @else
                                        value="{{$advert[0]->title}}"
                                        @endif">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="advert_desc" class="control-label">Description</label>

                                    @if(old('advert_title'))
                                        <textarea type="text" name="advert_desc" id="advert_desc" class="form-control" rows="5">{{ old('advert_title')}}</textarea>
                                    @else
                                        <textarea type="text" name="advert_desc" id="advert_desc" class="form-control" rows="5">{{$advert[0]->description}}</textarea>
                                    @endif


                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i>
                                    @if($advert)
                                        Save
                                    @else
                                        Create
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
