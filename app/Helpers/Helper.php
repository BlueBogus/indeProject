<?php
/**
 * Takes the values of each index in the array and joins them into a string of attributes for a html tag.
 * @param array
 * @return string
 */
if (!function_exists('html_attr')) {
    function html_attr(array $attr): string
    {
        $attr_string = '';
        foreach ($attr as $key => $value) {
            if (!is_array($value)) {
                $attr_string .= "$key=\"$value\"";
            }
        }

        return $attr_string;
    }
}

if (!function_exists('radio_attr')) {
    function radio_attr(array $field, $field_id, $option_id): string
    {
        $attr = [
            'name' => $field_id,
            'type' => 'radio',
            'value' => $option_id
        ];
        if ($option_id == ($field['value'] ?? null)) {
            $attr['checked'] = true;
        }

        return html_attr($attr);
    }
}

if (!function_exists('input_attr')) {
    function input_attr(array $field, $field_id): string
    {
        $attrs = $field['extra']['attr'] ?? [];
        $attrs += [
            'name' => $field_id,
            'type' => $field['type'],
            'value' => $field['value'] ?? ''
        ];

        return html_attr($attrs);
    }
}

if (!function_exists('select_attr')) {
    function select_attr(array $field, $field_id): string
    {
        $attrs = $field['extra']['attr'] ?? [];
        $attrs += [
            'name' => isset($attrs['multiple']) ? $field_id . '[]' : $field_id
        ];

        return html_attr($attrs);
    }
}

if (!function_exists('option_attr')) {
    function option_attr(array $field, $option_id): string
    {
        $attrs = [
            'value' => $option_id,
        ];
        if (is_array($field['value'])) {
            foreach ($field['value'] as $value) {
                if ($value == $option_id) {
                    $attrs['selected'] = true;
                }
            }
        } else {
            if (($field['value'] ?? null) == $option_id) {
                $attrs['selected'] = true;
            }
        }

        return html_attr($attrs);
    }
}

if (!function_exists('textarea_attr')) {
    function textarea_attr(array $field, $field_id): string
    {
        $attrs = $field['extra']['attr'] ?? [];
        $attrs += [
            'name' => $field_id
        ];

        return html_attr($attrs);
    }
}
?>
