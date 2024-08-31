@php
    $isError = $errors->has($name)
@endphp

<div class="col-md-{{ $col ?? 2 }}">

    {{-- label --}}
    <label for="{{ $name }}" class="form-label custom-label">{{ $label }}</label>

    {{-- input --}}
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control form-control-sm trim @if($isError) is-invalid @endif @isset($numericInput) numeric-input @endisset" value="{{ old($name, $value ?? '') }}" @isset($max) maxlength="{{ $max }}" @endisset>

    {{-- errors --}}
    @include('includes.errors', ['name' => $name])

</div>
