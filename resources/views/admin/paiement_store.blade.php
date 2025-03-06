@extends('admin.template')

@section('page_name')
    Paiments (Stores-Commerciaux)
@endsection


@section('title')
    Paiments (Stores-Commerciaux)
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

    </div>


    @if (count($all_store_com_p) > 0)
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th> id </th>
                            <th> Store </th>
                            <th> montant </th>
                            <th> engagement store </th>
                            <th> engagement Comm. </th>
                            <th> photo </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th> id </th>
                            <th> Store </th>
                            <th> montant </th>
                            <th> engagement store </th>
                            <th> engagement Comm. </th>
                            <th> photo </th>
                        </tr>
                    </tfoot>
                    <tbody>


                        @foreach ($all_store_com_p as $paiement)
                            <tr>
                                <td> {{ $paiement->id }} </td>
                                <td> {{ $paiement->store_name }} <hr> {{ $paiement->prop_name }} <hr>  {{ $paiement-> tlf_prop }}   </td>
                                <td> {{ $paiement->montant }} Da </td>

                                <td>
                                    @if ($paiement->seller_engagement)
                                        <i class="fas fa-check-square text-success"></i>
                                        {{ $paiement->created_at }}
                                    @else
                                        <i class="fas fa-times text-danger"></i>
                                    @endif
                                </td>

                                <td>
                                   
                                    @if ($paiement->commercial_engagement)
                                        <i class="fas fa-check-square text-success"></i>
                                        {{ $paiement->date_confirm_com }}
                                        
                                    @else
                                        <i class="fas fa-times text-danger"></i>
                                    @endif
                                </td>


              

                                <td style="max-width: 200px">

                                    @if ($paiement->photo_money)
                                        <img src="{{ asset('assets/' . $paiement->photo_money) }}" alt="image"
                                            width="80px">
                                    @else
                                          <i class="fas fa-times text-danger"></i>
                                    @endif

                                </td>
                             
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{ $all_store_com_p->links() }}
        </div>
    @else
        <div class="alert alert-warning bg-warning text-white text-center">
            Pas de paiements
        </div>
    @endif




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
