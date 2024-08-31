@php
    $isError = $errors->has($name);
    // formatando valor monetário para o formato BR
    // $value = number_format($value, 2, ',', '.');
@endphp

<div class="col-md-{{ $col ?? 2 }}">

    {{-- label --}}
    <label for="{{ $name }}" class="form-label custom-label">{{ $label }}</label>

    {{-- input --}}
    <div class="input-group input-group-sm">
        <span class="input-group-text" id="basic-addon">R$</span>
        <input type="text" name="{{ $name }}" id="{{ $name }}" class="form-control money-mask @if($isError) is-invalid @endif" value="{{ old($name, $value ?? '') }}" aria-describedby="basic-addon">
    </div>

    {{-- errors --}}
    @include('includes.errors', ['name' => $name])

</div>
