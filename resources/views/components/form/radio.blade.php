@foreach ($field['options'] as $option_id => $option)
    <input {!! radio_attr($field, $field_id, $option_id) !!}>
    <label for="{{ $option_id }}">{{ $option['name'] }}</label>
@endforeach
