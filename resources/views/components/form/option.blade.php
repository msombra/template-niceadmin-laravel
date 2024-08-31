<option value="{{ $value }}" {{ old($name, $data ?? '') == $value ? 'selected' : '' }}>{{ $option }}</option>
