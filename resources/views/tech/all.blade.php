<div class="card-body">
    <h3>Files details:</h3>

@foreach($allFiles as $filename)

    @if(!in_array($filename, ['all.blade.php', '.', '..']))
        <p>tech/<b>{{$filename}}</b> | <a href="{{url('dashboard/tech/'. str_replace('.blade.php','',$filename))}}">Preview</a></p>
    @endif

@endforeach

</div>
