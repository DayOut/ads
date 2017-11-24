@extends('layouts.app')

@section('content')
    <div class="col-md-10">
    @if (count($adverts) > 0)
        @foreach ($adverts as $advert)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3><a href="{{ url('/'.$advert->id) }}">{{ $advert->title }}</a></h3>
                    </div>

                    <div class="panel-body">
                        <div class="row ">
                            <div class="col-md-12">{!! nl2br($advert->description) !!}</div>
                        </div>
                        <div class="row ">
                            &nbsp;
                        </div>
                        <table class="table table-striped task-table">
                            <tbody>
                            <tr>
                                <td class="table-text">Author: <strong> {{ $advert->author_name }}</strong></td>
                                <td>
                                    @if(\Illuminate\Support\Facades\Auth::user())
                                        @if(\Illuminate\Support\Facades\Auth::user()->id == $advert->author_id )

                                            <form action="{{ url('delete/'.$advert->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger pull-right col-sm-offset-1">
                                                    <i class="fa fa-btn fa-trash "></i>Delete
                                                </button>


                                            </form>
                                        @endif
                                            <a href="{{ url('/edit/' . $advert->id) }}" class="btn btn-success pull-right ">Edit</a></li>
                                    @endif

                                </td>
                            </tr>
                            <tr>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        @endforeach
            <div class="">
                <?= $adverts->render(); ?>
            </div>
    @endif
    </div>

@endsection
