@extends('layouts.app')

@section('content')

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{ $advert[0]->title }}</h3>
                </div>

                <div class="panel-body">
                    <div class="row ">
                        <div class="col-md-12">{!! nl2br($advert[0]->description) !!}</div>
                    </div>
                    <div class="row ">
                        &nbsp;
                    </div>
                    <table class="table table-striped task-table">
                        <tbody>
                            <tr>
                                <td class="table-text">Author: <strong>{{ $advert[0]->author_name }}</strong></td>
                                <td>
                                    @if(\Illuminate\Support\Facades\Auth::user()&& \Illuminate\Support\Facades\Auth::user()->id == $advert[0]->author_id )

                                        <form action="{{ url('delete/'.$advert[0]->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger pull-right">
                                                <i class="fa fa-btn fa-trash "></i>Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
