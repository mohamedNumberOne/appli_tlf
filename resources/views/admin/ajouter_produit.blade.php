@extends('admin.template')

@section('page_name')
    Produits
@endsection


@section('title')
    Produits
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

        <h1 class="text-center"> Ajouter un Produit </h1>
        <form method="post" action="{{ route('add_product') }}">
            @csrf

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="Category">Categorie</label>
                    <select class="form-control" id="Category" name="category_id" required>
                        <option></option>
                        @foreach ($all_categories as $cat)
                            <option value="{{ $cat->id }}"> {{ $cat->category_name }} </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="marque"> Maruqe </label>
                    <select class="form-control" id="marque" name="brand_id" required>
                        <option></option>
                        @foreach ($all_brand as $brand)
                            <option value="{{ $brand->id }}"> {{ $brand->brand_name }} </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="nom_pro"> Nom produit </label>
                    <input type="text" class="form-control" id="nom_pro" name="nom_pro" required>
                    @error('nom_pro')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-4">
                    <label for="prix_garantie">prix de garantie</label>
                    <input type="number" class="form-control" id="prix_garantie" name="prix_garantie" required>
                    @error('prix_garantie')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="nb_jr_garantie">jrs garantie</label>
                    <input type="number" class="form-control" id="nb_jr_garantie" name="nb_jr_garantie" required
                        value="365">
                    @error('nb_jr_garantie')
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

        <hr>

        <h1 class="text-center"> Liste des Produits </h1>
        @if (count($all_pro) > 0)
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th> produit</th>
                                <th>categorie </th>
                                <th>marque </th>
                                <th>garantie</th>
                                <th> jrs garantie </th>
                                <th> double puce </th>

                                <th> Action </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th> produit</th>
                                <th>categorie </th>
                                <th>marque </th>
                                <th>garantie</th>
                                <th> jrs garantie </th>
                                <th> double puce </th>

                                <th> Action </th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($all_pro as $pro)
                                <tr>
                                    <th scope="row"> {{ $pro->pro_id }} </th>
                                    <td>{{ $pro->product_name }} </td>
                                    <td>{{ $pro->category_name }} </td>
                                    <td>{{ $pro->brand_name }} </td>
                                    <td>{{ $pro->prix_garantie }} DA </td>
                                    <td>{{ $pro->nb_jr_garantie }} </td>
                                    <td>
                                        @if ($pro->double_puce)
                                            oui
                                        @else
                                            non
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('modifier_produit_page', $pro->pro_id) }}"
                                            class="btn btn-primary p-2">
                                            <i class="fas fa-pen-square"></i>
                                        </a>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn  btn-danger p-2" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $pro->pro_id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $pro->pro_id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Vous voulez vraiment supprimer ?
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Annuler</button>

                                                        <form action="{{ route('supp_produit', $pro->pro_id) }}"
                                                            method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger"> Supprimer
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning bg-warning text-center text-white"> pas de produits </div>
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
