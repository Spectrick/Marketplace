
<input {{ $attributes->class([
    'form-control',
])->merge([
    'type' => 'text',
    'value' => old($attributes->get('name')),
]) }}>
