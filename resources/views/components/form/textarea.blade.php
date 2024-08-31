<div class="col-md-{{ $col ?? 2 }}">

    {{-- label --}}
    <label for="{{ $name }}" class="form-label custom-label">{{ $label }}</label>

    {{-- textarea --}}
    <textarea name="{{ $name }}" id="{{ $name }}" class="form-control" rows="{{ $rows ?? 5 }}" placeholder="{{ $placeholder ?? 'Digite aqui' }}">{{ $value ?? '' }}</textarea>

</div>
