@extends('admin.template')

@section('page_name')
    Retours
@endsection

@section('title')
   Retours
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

        <h1 class="text-center"> Mes Retours </h1>

        @if (count($retours) > 0)
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Produit</th>
                                <th>imei1</th>
                                <th>imei2</th>
                                <th>sn</th>
                                <th>photo </th>
                                <th>client </th>
                                <th> N° </th>
                                <th> Probléme </th>
                                <th style="min-width: 80px"> Date </th>
                            
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Produit</th>
                                <th>imei1</th>
                                <th>imei2</th>
                                <th>sn</th>
                                <th>photo </th>
                                <th>client </th>
                                <th> N° </th>
                                <th> Probléme </th>
                                <th>date </th>
                            
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($retours as $retour)
                                <tr>
                                    <td> {{ $retour->id }} </td>
                                    <td> {{ $retour->product_name }} </td>
                                    <td> {{ $retour->imei1 }} </td>
                                    <td>
                                        @if (empty($retour->imei2))
                                            /
                                        @else
                                            {{ $retour->imei2 }}
                                        @endif
                                    </td>
                                    <td>   {{ $retour->sn }} </td>
                                    <td> <img src="{{ asset('assets/' . $retour->info_product_img) }}" alt="image"
                                            width="80px"> </td>
                                    <td> {{ $retour->nom_client }} </td>
                                    <td> {{ $retour->tlf_client }} </td>
                                    <td> {{ $retour->problem }} </td>
                                    <td> {{ $retour->date_retour }} </td>

                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning bg-warning text-center text-white"> pas de Retours </div>
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
