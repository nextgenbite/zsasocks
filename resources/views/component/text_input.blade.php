<div class="form-floating">
  <input 
      type="{{ $type ?? 'text' }}" 
      name="{{ $name }}" 
      id="{{ $id ?? $name }}" 
      class="form-control form-control-sm @error($name) is-invalid @enderror" 
      placeholder="{{ $placeholder }}" 
      value="{{ old($name, $value ?? '') }}">
  <label for="{{ $id ?? $name }}" class="text-capitalize">{{ $label }}</label>
</div>
@error($name)
  <div class="text-danger text-xs">
      {{ $message }}
  </div>
@enderror
