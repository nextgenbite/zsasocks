<div class="form-floating">
  <select 
      class="form-select @error($name) is-invalid @enderror" 
      name="{{ $name }}" 
      id="{{ $id ?? $name }}" 
      aria-label="{{ $label }}">
      <option value="" disabled {{ old($name) ? '' : 'selected' }}>{{ $placeholder }}</option>
      @foreach ($options as $item)
          <option 
              value="{{ $item[$key] }}" 
              {{ old($name, $selected ?? '') == $item[$key] ? 'selected' : '' }}>
              {{ $item[$option_label] }}
          </option>
      @endforeach
  </select>
  <label for="{{ $id ?? $name }}">{{ $label }}</label>
</div>
@error($name)
  <div class="text-danger text-xs">
      {{ $message }}
  </div>
@enderror
