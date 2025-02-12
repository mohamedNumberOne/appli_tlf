@extends('admin.template')

@section('page_name')
    Mes Ventes
@endsection

@section('title')
    Mes Ventes
@endsection

@section('side_bare')
    @include('admin.admin_sidebare')
@endsection

@section('content')
    <div class="container">


        @if (session()->has('success'))
            <div class="alert alert-success text-center bg-success text-white">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-success text-center bg-danger text-white">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-center"> Mes ventes </h1>

        @if (count($sales) > 0)
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Produit</th>
                                <th>imei1</th>
                                <th>imei2</th>
                                <th>photo </th>
                                <th>client </th>
                                <th> N° </th>
                                <th style="min-width: 80px"> Date </th>
                                <th>action </th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Produit</th>
                                <th>imei1</th>
                                <th>imei2</th>
                                <th>photo </th>
                                <th>client </th>
                                <th> N° </th>
                                <th>date </th>
                                <th>action </th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($sales as $sale)
                                <tr>
                                    <td> {{ $sale->id }} </td>
                                    <td> {{ $sale->product_name }} </td>
                                    <td> {{ $sale->imei1 }} </td>
                                    <td>
                                        @if (empty($sale->imei2))
                                            /
                                        @else
                                            {{ $sale->imei2 }}
                                        @endif
                                    </td>

                                    <td> <img src="{{ asset('assets/' . $sale->info_product_img) }}" alt="image"
                                            width="80px"> </td>
                                    <td> {{ $sale->nom_client }} </td>
                                    <td> {{ $sale->tlf_client }} </td>
                                    <td> {{ $sale->created_at }} </td>

                                    <td>
                                        <a class="btn  btn-primary  p-2"
                                            href="{{ route('modification', $sale->id) }}">
                                            <i class="fas fa-pen-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning bg-warning text-center text-white"> pas de ventes </div>
        @endif
    </div>
@endsection

@section('js')
    {{--   data table  --}}

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
