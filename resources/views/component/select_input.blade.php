
<div class="form-floating">
    <select class="form-select @error($name) is-invalid @enderror" name="{{$name}}"  id="{{$id ?? $name}}" aria-label="{{$label}}" value="{{old($name) ??  ''}}">
      <option selected disabled>{{$placeholder}}</option>
      @foreach ($options as $item)
          
      <option value="{{$item[$key]}}">{{$item[$option_label]}}</option>
      @endforeach
    </select>
    <label for="{{$id ?? $name}}">{{$label}}</label>
</div>
@error($name)
<div id="{{$id ?? $name}}" class="text-danger tex-xs">
    {{ $message }}
</div>
@enderror