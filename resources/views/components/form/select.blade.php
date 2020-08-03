<select {!! select_attr($field, $field_id) !!}>
    @foreach ($field['options'] as $option_id => $option)
        <option {!! option_attr($field, $option_id) !!}>
            {{ $option }}
        </option>
    @endforeach
</select>
