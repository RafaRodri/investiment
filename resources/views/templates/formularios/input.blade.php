@php

    $attributes['placeholder'] = $attributes['placeholder'] ?? $label;

@endphp



{{--<label class="{{ isset($class) ? $class : null }}">--}}
{{--    <span>{{ isset($label) ? $input : "ERRO"}}</span>--}}
{{--    {!! Form::text($input, isset($value) ? $value : null, $attributes) !!}--}}
{{--</label>--}}




<label class="{{ $class ?? null }}">
    <span>{{ $label ?? $input ?? "ERRO"}}</span>
    {!! Form::text($input, $value ?? null, $attributes) !!}
</label>
