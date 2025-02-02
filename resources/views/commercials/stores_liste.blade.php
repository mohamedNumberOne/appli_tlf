@extends('admin.template')

@section('page_name')
    Stores
@endsection


@section('title')
    Stores
@endsection

@section('side_bare')
    @include('admin.admin_sidebare')
@endsection

@section('content')


    <div class="container">

        <h1 class="text-center"> Mes stores </h1>

        @if (count($all_stores) > 0)
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th> Store</th>
                                <th>Propriétaire </th>
                                <th>Solde</th>
                                <th> Téléphone </th>
                                <th> Email </th>
                                <th> Commercial </th>
                                {{-- <th> Action </th> --}}
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th> Store </th>
                                <th> Propriétaire </th>
                                <th>Solde</th>
                                <th> Téléphone </th>
                                <th> Email </th>
                                <th> Commercial </th>
                                {{-- <th> Action </th> --}}
                            </tr>
                        </tfoot>
                        <tbody>

                            {{-- @foreach ($all_stores as $store)
                                <tr>
                                    <th scope="row"> {{ $store->store_id }} </th>
                                    <td>{{ $store->store_name }} </td>
                                    <td>{{ $store->prop_name }} </td>
                                    <td>{{ $store->total_to_pay }} DA </td>
                                    <td>{{ $store->tlf_prop }} </td>
                                    <td>{{ $store->email_prop }} </td>
                                    <td>
                                        {{ $store->commercial_name }}
                                    </td>
                                 
                                </tr>
                            @endforeach --}}

                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning bg-warning text-center text-white"> pas de stores </div>
        @endif


    </div>


@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});


            $("#multi-filter-select").DataTable({
                pageLength: 5,
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var column = this;
                            var select = $(
                                    '<select class="form-select"><option value=""></option></select>'
                                )
                                .appendTo($(column.footer()).empty())
                                .on("change", function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column
                                        .search(val ? "^" + val + "$" : "", true, false)
                                        .draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append(
                                        '<option value="' + d + '">' + d + "</option>"
                                    );
                                });
                        });
                },
            });

            // Add Row
            $("#add-row").DataTable({
                pageLength: 5,
            });

            var action =
                '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $("#addRowButton").click(function() {
                $("#add-row")
                    .dataTable()
                    .fnAddData([
                        $("#addName").val(),
                        $("#addPosition").val(),
                        $("#addOffice").val(),
                        action,
                    ]);
                $("#addRowModal").modal("hide");
            });
        });
    </script>
@endsection
