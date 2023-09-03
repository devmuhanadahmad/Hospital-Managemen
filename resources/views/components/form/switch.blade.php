@props(['name', 'lable', 'options', 'checked' => false,'value'])



 <!-- Switches -->
 <div class="card mb-4">
    <h5 class="card-header">Weekly Day</h5>
    <div class="card-body">

        @foreach ($options as $value => $text)
      <div class="form-check form-switch mb-2">
        <input class="form-check-input" type="checkbox" id="{{ $text }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @checked(old($name, $checked) == $value)
        {{ $attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)]) }}
        />
        <label class="form-check-label" for="{{ $text }}"> {{ $text }}</label>
      </div>
      @endforeach
      @error($name)
      <small class="text-danger">{{ $message }}</small>
  @enderror
    </div>
  </div>
