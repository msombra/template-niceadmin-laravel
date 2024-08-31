@if ($isError)
    @foreach ($errors->get($name) as $e)
        <small class="text-danger fs-13"><i>{{ $e }}</i></small>
    @endforeach
@endif
