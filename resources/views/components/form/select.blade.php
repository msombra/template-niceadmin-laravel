@php
    $isError = $errors->has($name)
@endphp

<div class="col-md-{{ $col ?? 2 }}">

    {{-- label --}}
    <label for="{{ $name }}" class="form-label custom-label">{{ $label }} @isset($required) <span class="text-danger">*</span> @endisset</label>

    {{-- select --}}
    <select name="{{ $name }}" id="{{ $name }}" class="form-select form-select-sm @if($isError) is-invalid @endif">
        <option value="">Selecione</option>
        {{-- options --}}
        {{ $slot }}
        {{-- se o select for SIM/NÃO --}}
        @isset($typeBool)
            <x-form.option :data="$typeBool" value="0" option="NÃO" :name="$name" />
            <x-form.option :data="$typeBool" value="1" option="SIM" :name="$name" />
        @endisset
    </select>

    {{-- errors --}}
    @include('includes.errors', ['name' => $name])

</div>
