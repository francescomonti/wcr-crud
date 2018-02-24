@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Elenco {{$opt['items']}}</h3>
                <div class="box-tools">
                    <a class="btn btn-xs btn-primary" href="{{$opt['create']}}" >Create</a>
                </div>
            </div>

            <div class="box-body">
                @if ($resources)
                    <table class="footable table table-stripped toggle-arrow-tiny tablet breakpoint footable-loaded">
                        <thead>
                            <tr>
                                @foreach ($opt['tableFields'] as $field)
                                    <th>{{$field}}</th>
                                @endforeach
                                    <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resources as $resource)
                                <tr>
                                    @foreach ($opt['tableFields'] as $field)
                                        <td>{{$resource->$field}}</td>
                                    @endforeach
                                    <td width="20%">
                                        <a class="btn btn-xs btn-primary" href="<?= action($opt['controller'].'@show', ['id'=>$resource->id]) ?>">Show</a>
                                        <a class="btn btn-xs btn-warning" href="<?= action($opt['controller'].'@edit', ['id'=>$resource->id]) ?>">Edit</a>
                                        <!--a class="btn btn-xs btn-danger" href="<?= action($opt['controller'].'@destroy', ['id'=>$resource->id]) ?>">Delete</a-->
                                        <form style="display:inline;" action="<?= action($opt['controller'].'@destroy', ['id'=>$resource->id]) ?>" method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button class="btn btn-xs btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection