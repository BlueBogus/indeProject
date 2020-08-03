<table class="standard-table" id="{{ $table_id }}">
    <tr>
        @foreach($thead ?? [] as $head)
            <th>{{ $head }}</th>
        @endforeach
    </tr>
    @foreach ($tbody ?? [] as $row_id => $row)
        <tr>
            @foreach($row ?? [] as $col_value)
                <td>{{ $col_value }}</td>
            @endforeach
        </tr>
    @endforeach
</table>

