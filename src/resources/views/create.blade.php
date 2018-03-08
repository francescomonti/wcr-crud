@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create new {{$opt['item']}}</h3>
                <div class="box-tools">
                </div>
            </div>

            <div class="box-body">
                <?= Former::open(action($opt['controller'].'@store')) ?>
                    @include($opt['partials']['itemFields'])
                    <?= Former::actions()->large_primary_submit('Submit')->large_inverse_reset('Reset'); ?>
                <?= Former::close() ?>
            </div>
        </div>
    </div>
</div>
@endsection