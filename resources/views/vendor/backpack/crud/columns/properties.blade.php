@section('after_styles')
<style>
    #table-data {
        table-layout: fixed;
    }

    #table-data td {
        white-space: -o-pre-wrap;
        word-wrap: break-word;
        white-space: pre-wrap;
        white-space: -moz-pre-wrap;
        white-space: -pre-wrap;
    }

    .highlight {
        background-color: #7c69ef;
        color: white;
    }

    .highlight-danger {
        background-color: #df4759;
        color: white;
    }
</style>
@endsection

<table class="table table-hover table-condensed pb-0 mb-0" id="table-data">
    <thead>
        <tr>
            <th>FIELD</th>
            <th>CURRENT</th>
            <th>PREVIOUS</th>
        </tr>
    </thead>
    <tbody id="data">
        @php
        $attributes = $entry->changes["attributes"];
        $old = $entry->changes["old"] ?? null;
        @endphp
        @foreach ($attributes as $key => $item)
        <tr>
            <th>{{ $key }}</th>
            <td id="data-item-new-{{ $key }}">{{ $attributes[$key] }}</td>
            <td id="data-item-old-{{ $key }}">{{ $old[$key] ?? null }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@section('after_scripts')
<script>
    function highlight(newElem, oldElem){
        var oldText = oldElem.text();
        var newText = newElem.text();
        textNew = '';
        newElem.text().split('').forEach(function(val, i){
            if (val != oldText.charAt(i))
            textNew += "<span class='highlight'>"+val+"</span>";
            else
            textNew += val;
        });
        newElem.html(textNew);

        textOld = '';
        oldElem.text().split('').forEach(function(val, i){
            if (val != newText.charAt(i))
            textOld += "<span class='highlight-danger'>"+val+"</span>";
            else
            textOld += val;
        });
        oldElem.html(textOld);
    }

    var json = JSON.parse('{!! json_encode($attributes) !!}')
    $.each(json, function(key) {
        highlight($("#data-item-new-" + key), $("#data-item-old-" + key));
    })
</script>
@endsection
