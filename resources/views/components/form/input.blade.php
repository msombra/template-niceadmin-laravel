<div class="col-md-{{ $col ?? 2 }}">

    {{-- label --}}
    <label for="{{ $name }}" class="form-label custom-label">{{ $label }} @isset($required) <span class="text-danger">*</span> @endisset</label>

    {{-- input --}}
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value ?? '') }}"
        class="
            form-control
            form-control-sm
            trim
            @if($errors->has($name)) is-invalid @endif
            @isset($numericInput) numeric-input @endisset
        "
        @isset($max) maxlength="{{ $max }}" @endisset
        @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
    >

    {{-- errors --}}
    @include('includes.errors', ['name' => $name])

</div>
