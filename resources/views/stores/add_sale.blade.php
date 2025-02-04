@extends('admin.template')

@section('page_name')
    Vente
@endsection


@section('title')
    Vente
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

        <h1 class="text-center"> Ajouter une vente </h1>
        <form method="post" action="{{ route('add_product') }}">
            @csrf
            {{-- imei1	imei2	sn	info_product_img	nom_client	tlf_client	 --}}

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="product_id">Produit</label>

                    <select id="product_id" name="product_id" class="form-control" required>
                        <option value="">
                            @foreach ($all_pro as $pro)
                        <option value="{{ $pro->id }}"> {{ $pro->product_name }} </option>
                        @endforeach
                    </select>

                    @error('product_id')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="imei1"> imei1 </label>
                    <input class="form-control" id="imei1" name="imei1" required>
                    @error('imei1')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                @if ($pro->double_puce)
                    <div class="form-group col-md-4">
                        <label for="imei1"> imei2 </label>
                        <input class="form-control" id="imei1" name="imei2" required>
                        @error('imei2')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                @endif

            </div>


            <div class="row">
                <div class="form-group col-md-4">
                    <label for="nom_client"> Nom client </label>
                    <input type="number" class="form-control" id="nom_client" name="nom_client" required>
                    @error('nom_client')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="tlf_client">Téléphone client </label>
                    <input type="number" class="form-control" id="tlf_client" name="tlf_client" required   >
                    @error('tlf_client')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="double_puce">double puce</label>
                    <select id="double_puce" class="form-control" name="double_puce" required>
                        <option selected> </option>
                        <option value="1"> oui </option>
                        <option value="0"> non </option>
                    </select>
                    @error('double_puce')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2 mb-3"> Ajouter </button>
        </form>



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
