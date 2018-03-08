@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$opt['items']}} list</h3>
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
                                @include($opt['partials']['listItem'])
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection