@extends('admin.template')

@section('page_name')
    Ventes
@endsection

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    Ajouter une vente
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
        <form method="post" action="{{ route('ajouter_vente') }}" enctype="multipart/form-data">
            @csrf


            <div class="row">
                <div class="form-group col-md-4">
                    <label for="product_id">Produit</label>

                    <select id="product_id" name="product_id" class="form-control">
                        <option value="">
                            @foreach ($all_pro as $pro)
                        <option value="{{ $pro->id }}" {{ old('product_id') == $pro->id ? 'selected' : '' }}
                            {{ $pro->double_puce == 1 ? 'data-dp=true' : '' }}>
                            {{ $pro->product_name }}     
                        </option>
                        @endforeach
                    </select>

                    @error('product_id')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>


                <div class="form-group col-md-4">

                    <label for="imei1"> imei1 </label>
                    <input class="form-control" id="imei1" name="imei1" required maxlength="15"
                        value="{{ old('imei1') }}">
                    @error('imei1')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class='form-group col-md-4' id="pro_info">

                    <label for='imei2'> imei2 </label>
                    <input class='form-control' id='imei2' name='imei2' maxlength='15' value="{{ old('imei2') }}">
                    @error('imei2')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror

                </div>

            </div>


            <div class="row">
                <div class="form-group col-md-4">
                    <label for="sn"> Serial number </label>
                    <input type="text" class="form-control" id="sn" name="sn" required
                        value="{{ old('sn') }}">
                    @error('sn')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="form-group col-md-3">
                    <label for="nom_client"> Nom client </label>
                    <input type="text" class="form-control" id="nom_client" name="nom_client" required
                        value="{{ old('nom_client') }}">
                    @error('nom_client')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="form-group col-md-3">
                    <label for="tlf_client">Téléphone client </label>
                    <input type="number" class="form-control" id="tlf_client" name="tlf_client" required
                        value="{{ old('tlf_client') }}">
                    @error('tlf_client')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>


                <div class="form-group col-md-2">
                    <label for="info_product_img"> Image </label>
                    <input type="file" class="form-control" id="info_product_img" name="info_product_img" required
                        accept="image/*"   >
                        {{-- capture="camera" --}}
                    @error('info_product_img')
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
        var productId = document.getElementById('product_id');

        var selectedOption = productId.options[productId.selectedIndex];
        var imei2 = document.getElementById('imei2');

        // Vérifier la valeur et l'attribut data-dp de l'option sélectionnée
        if (!(selectedOption.value != "" && selectedOption.getAttribute('data-dp') == "true")) {
            imei2.value = "";
            imei2.disabled = 1;
        }  

        $(document).ready(function() {
            $('#product_id').change(function() {

                var productId = $(this).val();
                if (productId) {
                    var url = "{{ route('get_info_pro_ajax', ':id') }}".replace(':id', productId);

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: 'GET',
                        dataType: 'json',

                        success: function(response) {

                            if (!response.double_puce == 1) {
                                imei2.value = "";
                                imei2.disabled = 1;
                            } else {
                                imei2.disabled = 0;
                            }


                        },
                        error: function(xhr) {
                            alert('err');

                        }
                    });
                } else {
                    // $('#productName, #productPrice, #productDescription').text(''); 
                    $('#pro_info').text("");
                }
            });
        });
    </script>

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
