<div class="form-check">
    <input type="checkbox" {{ $attributes->merge([
        'value' => '1',
        'checked' => !! old($attributes->get('name')),
]) }} class="form-check-input" id="login-remember">

    <label class="form-check-label" for="login-remember">
        {{ $slot }}
    </label>
</div>
