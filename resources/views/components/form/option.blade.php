<option value="{{ $value }}" {{ old($name, $data ?? '') == $value ? 'selected' : '' }} @isset($selected) selected @endisset>{{ $option }}</option>
