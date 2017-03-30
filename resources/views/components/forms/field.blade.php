<div class="field">
    <label for="{{ $name }}" class="label">{{ $label }}</label>
    <input id="{{ $name }}" type="{{ $type }}"
           class="input {{ $errors->has($name) ? 'is-danger' : '' }}"
           name="{{ $name }}" value="{{ old($name) }}" required
           {{ isset($autoFocus) ? 'autoFocus' : ''}}>
    @if($errors->has($name))
        <p class="help is-danger">{{ $errors->first($name) }}</p>
    @endif
</div>