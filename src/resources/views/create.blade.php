@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Crea nuovo {{$opt['item']}}</h3>
                <div class="box-tools">
                    <a class="btn btn-xs btn-primary" href="{{$opt['create']}}" >Create</a>
                </div>
            </div>

            <div class="box-body">
                <?= Former::open(action($opt['controller'].'@store')) ?>
                    @include('Post/fields')
                    <?= Former::actions()->large_primary_submit('Submit')->large_inverse_reset('Reset'); ?>
                <?= Former::close() ?>
            </div>
        </div>
    </div>
</div>
@endsection