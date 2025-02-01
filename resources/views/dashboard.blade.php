@extends('admin.template')
 

@section('page_name')
dashboard
@endsection

@section('title')
dashboard
@endsection

@section('side_bare')
@include('admin.admin_sidebare')
@endsection

@section('content')


<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Commerciaux</p>
                            <h4 class="card-title"> {{ count( $commerciaux ) }} </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-store"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Store</p>
                            <h4 class="card-title">{{  $nb_stores   }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="container">
    @if ( session() -> has('success') )
    <div class="alert alert-success text-center bg-success text-white">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="text-center"> Ajouter un utilisateur </h1>
    <form method="post" action="{{ route('create_user') }}">
        @csrf
        <div class="row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" required>
                @error('email')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">Mot de passe</label>
                <input type="password" class="form-control" id="inputPassword4" placeholder="Mot de passe" name="ps1"
                    required>
                @error('ps1')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword5">Retapez le MDP</label>
                <input type="password" class="form-control" id="inputPassword5" placeholder="Mot de passe"
                    name="ps1_confirmation" required>
                @error('ps1_confirmation')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
        </div>


        <div class="row">
            <div class="form-group col-md-4">
                <label for="name">Nom complet</label>
                <input type="text" class="form-control" id="name" name="name" required>
                @error('name')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="telephone">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="tlf" required>
                @error('tlf')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Role</label>
                <select id="inputState" class="form-control" name="role" required>
                    <option selected> </option>
                    <option value="admin"> Admin </option>
                    <option value="commercial"> Commercial </option>
                </select>
                @error('role')
                <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>

        </div>

        <button type="submit" class="btn btn-primary w-100 mt-2 mb-3"> Ajouter </button>
    </form>
    <hr>

    <h1 class="text-center"> Liste des Admins </h1>

    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Action </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th> Action </th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach ($admins as $admin)
                    <tr>
                        <td> {{ $admin -> id }} </td>
                        <td> {{ $admin -> name }} </td>
                        <td> {{ $admin -> email }} </td>
                        <td> {{ $admin -> tlf }} </td>
                        <td>
                           <button class="btn  btn-primary  p-2"  > <i class="fas fa-pen-square"></i> </button>
                           <button class="btn  btn-danger  p-2"    > <i class="fas fa-trash"></i> </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <hr class="mt-5 mb-5" >

    <h1 class="text-center"> Liste des Commerciaux </h1>

    <div class="card-body">
        <div class="table-responsive">
            <table id="basic-datatables2" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Solde</th>
                        <th>Action </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Solde</th>
                        <th> Action </th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach ($commerciaux as $commercial)
                    <tr>
                        <td> {{ $commercial -> id }} </td>
                        <td> {{ $commercial -> name }} </td>
                        <td> {{ $commercial -> email }} </td>
                        <td> {{ $commercial -> tlf }} </td>
                        <td> {{ $commercial -> solde }} Da</td>
                        <td> 

                           <button class="btn  btn-primary  p-2"  > <i class="fas fa-pen-square"></i> </button>
                           <button class="btn  btn-danger  p-2"    > <i class="fas fa-trash"></i> </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</div>


@endsection

@section('js')

<script>
    $(document).ready(function () {
        $("#basic-datatables").DataTable({});

        $("#basic-datatables2").DataTable({});

        $("#multi-filter-select").DataTable({
          pageLength: 5,
          initComplete: function () {
            this.api()
              .columns()
              .every(function () {
                var column = this;
                var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                  .appendTo($(column.footer()).empty())
                  .on("change", function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column
                      .search(val ? "^" + val + "$" : "", true, false)
                      .draw();
                  });

                column
                  .data()
                  .unique()
                  .sort()
                  .each(function (d, j) {
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

        $("#addRowButton").click(function () {
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