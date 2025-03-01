@extends('admin.template')

@section('page_name')
    Paiments
@endsection

@section('title')
    Paiments
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
            <div class="alert alert-danger text-center bg-danger text-white">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-center mb-5"> Ajouter un Paiement </h1>

        @if ($solde > 0)
        <h5>Mon solde : <b> {{ $solde }} Da </b></h5>
            <form action="{{ route('add_p_stoer_com') }}" method="POST">
                @csrf
                <div class=" row">
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="montant" required placeholder="Montant (Da)"
                            min="1000" max="50000">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary mt-4" value="Payer">
            </form>
        @else
            <div class="alert alert-warning bg-warning text-white text-center">
                Vous ne pouvez pas faire un paiement pour l'instant ( Solde : {{ $solde  }} Da.)
            </div>
        @endif


        <hr>

        <h1 class="text-center mb-5"> Mes Paiements </h1>


        @if (count($mes_engagements) > 0)
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>montant</th>
                                <th> engagement store </th>
                                <th> engagement commercial </th>
                                <th style="min-width: 80px"> Date </th>
                                <th> photo </th>
                                

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>montant</th>
                                <th> engagement store </th>
                                <th> engagement commercial </th>
                                <th style="min-width: 80px"> Date </th>
                                <th> photo </th>
                                
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($mes_engagements as $engagement)
                                <tr>
                                    <td> {{ $engagement->id }} </td>
                                    <td> {{ $engagement->montant }} Da </td>
                                    <td>
                                        @if ($engagement->seller_engagement)
                                            <i class="fas fa-check-square text-success "></i>
                                        @else
                                            <i class="fas fa-times text-danger"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($engagement->commercial_engagement)
                                            <i class="fas fa-check-square text-success"></i>
                                        @else
                                            <i class="fas fa-times text-danger"></i>
                                        @endif
                                    </td>
                                    <td> {{ $engagement->created_at }}</td>

                                    <td>

                                        @if ($engagement->photo_money)
                                            <img src="{{ asset('assets/' . $engagement->photo_money) }}" alt="image"
                                                width="80px">
                                        @else
                                            <i class="fas fa-times"></i>
                                        @endif

                                    </td>
 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $mes_engagements->links() }}
            </div>
        @else
            <div class="alert alert-warning bg-warning text-white text-center">
                Pas de paiements
            </div>
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
