@extends(backpack_view('layouts.top_left'))

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

@php
$breadcrumbs = [
trans('backpack::crud.admin') => backpack_url('dashboard'),
"Log User Activity" => backpack_url('log-user'),
"List Activity" => false,
];
@endphp

@section('header')
<section class="container-fluid">
    <h2>
        Log User Activity
    </h2>
</section>
@endsection

@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-condensed pb-0 mb-0 table-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Log Type</th>
                        <th>Model</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                    <tr>
                        <th scope="row">{{ $activity->id }}</th>
                        <td>
                            @php
                            $created = Carbon\Carbon::parse($activity->created_at);
                            @endphp
                            {{ $created->format("Y-m-d H:i:s") }} ({{ $created->diffForHumans() }})
                        </td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->subject->getTable() }}</td>
                        <td>
                            {!! !empty($activity->causer) ? $activity->causer->name . "<br>(" . $activity->causer->email
                            . ")" : "-" !!}
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm btn-show" data-id="{{ $activity->id }}">
                                Show Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('before_scripts')
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="modalShowTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Log Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-condensed pb-0 mb-0" id="table-data">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">INFO</th>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td colspan="2" id="created_at"></td>
                        </tr>
                        <tr>
                            <th>Log Type</th>
                            <td colspan="2" id="log_type"></td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <td colspan="2" id="model"></td>
                        </tr>
                        <tr>
                            <th>User</th>
                            <td colspan="2" id="causer"></td>
                        </tr>
                        <tr>
                            <th>FIELD</th>
                            <th>CURRENT</th>
                            <th>PREVIOUS</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('after_scripts')
<script>
    $(function() {
        $(".btn-show").click(function() {
            var id = $(this).data("id")
            $.ajax({
                url: "{{ url(config('backpack.base.route_prefix', 'admin')) }}/log-user/" + id,
                success: function(result) {
                    $("[class^=data-]").remove()
                    $("#created_at").html(result.created_at)
                    $("#log_type").html(result.log_type)
                    $("#model").html(result.model)
                    $("#causer").html(result.causer)

                    var attributes = result.changes.attributes;
                    var old = result.changes.old;
                    $.each(attributes, function(key, val) {
                        $("#data").append(`
                        <tr class='data-item'>
                        <th>` + key + `</th>
                        <td id='data-item-new-` + key + `'>` + val + `</td>
                        <td id='data-item-old-` + key + `'>` + old[key] + `</td>
                        </tr>
                        `)
                        highlight($("#data-item-new-" + key), $("#data-item-old-" + key));
                    })

                    $("#modalShow").modal("show")
                },
            })
        })
    })

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
</script>
@endsection
