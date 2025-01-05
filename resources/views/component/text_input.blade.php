
<div class="form-floating">
    <input type="{{$type ?? 'text'}}" name="{{$name}}"  class="form-control form-control-sm @error($name) is-invalid @enderror" id="{{$id ?? $name}}" placeholder="{{$placeholder}}" value="{{old($name) ?? $value ?? ''}}">
    <label for="{{$id ?? $name}}" class="text-capitalize">{{$label}}</label>
  </div>
  @error($name)
  <div id="{{$id ?? $name}}" class="text-danger tex-xs">
      {{ $message }}
  </div>
@enderror