<tr>
    @foreach ($opt['tableFields'] as $field)
        <td>{{$resource->$field}}</td>
    @endforeach
    <td class="text-right">
        <a class="btn btn-xs btn-primary" href="<?= action($opt['controller'].'@show', ['id'=>$resource->id]) ?>">Show</a>
        <a class="btn btn-xs btn-warning" href="<?= action($opt['controller'].'@edit', ['id'=>$resource->id]) ?>">Edit</a>
        <form style="display:inline;" action="<?= action($opt['controller'].'@destroy', ['id'=>$resource->id]) ?>" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button class="btn btn-xs btn-danger">Delete</button>
        </form>
    </td>
</tr>