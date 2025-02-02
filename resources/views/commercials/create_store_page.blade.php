@extends('admin.template')

@section('page_name')
    Créer un Store
@endsection


@section('title')
    Ajouter un Store
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

        <h1 class="text-center"> Ajouter un Store </h1>
        <form method="post" action="{{ route('create_store') }}">
            @csrf
            
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="store_name">Nom du magasin</label>
                    <input type="text" class="form-control" id="store_name" name="store_name"  >
                     
                    @error('store_name')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="adresse">Adresse </label>
                 
                    <input type="text" class="form-control" id="adresse" name="adresse"  >                    
                    @error('adresse')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="tlf"> Téléphone   </label>
                    <input type="number" class="form-control" id="tlf" name="tlf" required>
                    @error('tlf')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-4">
                    <label for="name">Nom complet    </label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    @error('name')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="email"> Email  </label>
                    <input type="email" class="form-control" id="email" name="email" required  >
                    @error('email')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="password">Mot de passe  </label>
                    <input type="password"   id="password" class="form-control" name="password" required>
                    @error('password')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2 mb-3"> Ajouter </button>
        </form>

        <hr>

           
      
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
