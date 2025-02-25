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
            <div class="alert alert-success text-center bg-danger text-white">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-center mb-5"> Ajouter un Paiement </h1>

        @if ($solde > 0)
            <form action="{{ route('add_p_stoer_com') }}" method="POST">
                @csrf
                <div class=" row">
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="montant" required placeholder="Montant (Da)"
                            min="1000" max="50000">
                    </div>

                </div>
                <input type="submit" class="btn btn-primary mt-4" value="Payer">

            </form>
        @else
            <div class="alert alert-warning bg-warning text-white text-center">
                Vous ne pouvez pas faire un paiement pour l'instant
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
                                <th>action </th>

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
                                <th>action </th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($mes_engagements as $engagement)
                                <tr>
                                    <td> {{ $engagement->id }} </td>
                                    <td> {{ $engagement->montant }} Da </td>
                                    <td>
                                        @if ($engagement->seller_engagement)
                                            <i class="fas fa-check-square"></i>
                                        @else
                                            <i class="fas fa-times"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($engagement->commercial_engagement)
                                            <i class="fas fa-check-square"></i>
                                        @else
                                            <i class="fas fa-times"></i>
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

                                    <td>

                                        <a class="btn  btn-primary  p-2"
                                            href="{{ route('modification', $engagement->id) }}">
                                            <i class="fas fa-pen-square"></i>
                                        </a>


                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger p-2" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $engagement->id }}">
                                            <i class="fas fa-undo-alt"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $engagement->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Ajouter un Retour ?
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('add_retour') }}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input class="form-control" type="text" name="problem"
                                                                placeholder="Probléme">
                                                            <input class="form-control" type="hidden" name="sale_id"
                                                                value="{{ $engagement->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annuler</button>
                                                            <button type="submit" class="btn btn-danger">
                                                                Confirmer
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
