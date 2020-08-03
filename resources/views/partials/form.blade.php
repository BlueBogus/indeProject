<!--Form generator-->
<form {!! html_attr(($attr ?? []) + ['method' => 'POST']) !!}>
@csrf
@foreach ($fields ?? [] as $field_id => $field)
    <!--Field generation start-->
        <label>
            <span>{{ $field['label'] ?? ''}}</span>
            <!--Standard input field generation-->
            @if (in_array($field['type'], ['text', 'number', 'password', 'email', 'hidden']))
                <input class="@error('title') is-invalid @enderror" {!! input_attr($field, $field_id) !!}>
                <!--Selection field generation-->
            @elseif (in_array($field['type'], ['select']))
                @form_select(['field' => $field, 'field_id' => $field_id])
            @elseif (in_array($field['type'], ['textarea']))
                <textarea {!! textarea_attr($field, $field_id) !!}>
                {{ $field['value'] ?? '' }}
            </textarea>
                <!--Radio button generation-->
            @elseif (in_array($field['type'], ['radio']))
                <div class="{!! $field['container-class'] ? $field['container-class'] : '' !!}">
                    @form_radio(['field' => $field])
                </div>
            @endif
            @error($field_id)
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </label>
@endforeach
<!--Field generation end-->
    <!--Button generation start-->
    @foreach ($buttons ?? [] as $button_id => $button)
        @form_button(['button' => $button, 'button_id' => $button_id])
    @endforeach
</form>
<!--Button generation end-->
