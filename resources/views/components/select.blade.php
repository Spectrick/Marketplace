@props(['value' => null, 'options' => []])

<select {{ $attributes->class([
    'form-control',
]) }}>

    {{ $slot }}

    @foreach($options as $key => $text)
        <option value="{{ $key+1 }}" {{ ($key+1 == $value) ? 'selected' : null }}>
            {{ $text }}
        </option>
    @endforeach
</select>
