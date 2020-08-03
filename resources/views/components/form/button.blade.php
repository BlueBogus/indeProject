<button {!! html_attr(($button['extra']['attr'] ?? []) +
        [
            'name' => 'action',
            'value' => $button_id
        ])
        !!}>{{ $button['title'] }}</button>
