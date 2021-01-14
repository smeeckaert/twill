@php
    $note = $note ?? false;
    $inline = $inline ?? false;
    $default = $default ?? false;
    $inModal = $fieldsInModal ?? false;
    $disabled = $disabled ?? false;
    $ref = $ref ?? false;
    $onChange = $onChange ?? false;
    $onChangeAttribute = $onChangeAttribute ?? false;
    $onChangeFullAttribute = $onChangeAttribute ? "('".$onChangeAttribute."', ...arguments)" : "";

@endphp

<a17-singlecheckbox
    @include('twill::partials.form.utils._field_name')
    label="{{ $label ?? '' }}"
    :initial-value="{{ $default ? 'true' : 'false' }}"
    @if ($note) note='{{ $note }}' @endif
    @if ($disabled) disabled @endif
    @if ($ref) ref="{{ $ref }}" @endif
    :has-default-store="true"
    in-store="currentValue"
    @if ($onChange) v-on:change="{!! $onChange !!}{{ $onChangeFullAttribute }}" @endif

></a17-singlecheckbox>

@unless($renderForBlocks || $renderForModal || (!isset($item->$name) && null == $formFieldsValue = getFormFieldsValue($form_fields, $name)))
@push('vuexStore')
    window['{{ config('twill.js_namespace') }}'].STORE.form.fields.push({
        name: '{{ $name }}',
        value: @if(isset($item) && $item->$name || ($formFieldsValue ?? false)) true @else false @endif
    })
@endpush
@endunless
