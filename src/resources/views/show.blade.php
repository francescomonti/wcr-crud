@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="ibox float-e-margins">
            <div class="ibox-title"><h5>Show</h5>
              <div class="ibox-tools"> <a class="btn btn-xs btn-primary" href="<?= action($opt['controller'].'@edit', ['id'=>$resource->id]) ?>" >Edit</a></div>
            </div>

            <div class="ibox-content">
               <pre><?= print_r($resource, true) ?></pre>
            </div>
        </div>
    </div>
</div>
@endsection