@extends('admin.template')

@section('page_name')
    Modification du produit
@endsection



@section('title')
    Modification
@endsection

@section('side_bare')
    @include('admin.admin_sidebare')
@endsection

@section('content')
    <div class="container">

        <h1 class="text-center"> Modification {{ $product->product_name }} </h1>

        <div class="card-body">

            @if (session()->has('success'))
                <div class="alert alert-success text-center bg-success text-white">
                    {{ session('success') }}
                </div>
            @endif

            <form method="post" action="{{ route('modifier_produit', $product->id) }}">
                @csrf

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="Category">Categorie</label>
                        <select class="form-control" id="Category" name="category_id" required>
                            <option></option>
                            @foreach ($all_categories as $cat)
                                @if ($cat->id == $product->category_id)
                                    <option value="{{ $cat->id }}" selected> {{ $cat->category_name }} </option>
                                @else
                                    <option value="{{ $cat->id }}"> {{ $cat->category_name }} </option>
                                @endif
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
                                @if ($brand->id == $product->brand_id)
                                    <option value="{{ $brand->id }}" selected> {{ $brand->brand_name }} </option>
                                @else
                                    <option value="{{ $brand->id }}"> {{ $brand->brand_name }} </option>
                                @endif
                            @endforeach
                        </select>
                        @error('brand_id')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nom_pro"> Nom produit </label>
                        <input type="text" class="form-control" id="nom_pro" name="nom_pro" required
                            value="{{ $product->product_name }}"  >
                        @error('nom_pro')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>



                     <div class="row">
                <div class="form-group col-md-4">
                    <label for="g_tlf">G. Téléphone</label>
                    <input type="number" class="form-control" id="g_tlf" name="prix_g_tlf" required value="{{ $product->prix_g_tlf }}" >
                    @error('prix_g_tlf')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="circuit">G. Circuit de charge</label>
                    <input type="number" class="form-control" id="circuit" name="prix_g_circuit" required value="{{ $product->prix_g_circuit }}" >
                    @error('prix_g_circuit')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>


                <div class="form-group col-md-4">
                    <label for="batterie">G. Batterie</label>
                    <input type="number" class="form-control" id="batterie" name="prix_g_batterie" required value="{{ $product->prix_g_batterie }}" >
                    @error('prix_g_batterie')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>


                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="nb_jr_garantie">jrs garantie</label>
                        <input type="number" class="form-control" id="nb_jr_garantie" name="nb_jr_garantie" required
                            value="{{ $product->nb_jr_garantie }}">
                        @error('nb_jr_garantie')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="double_puce">double puce</label>
                        <select id="double_puce" class="form-control" name="double_puce" required>
                            <option> </option>
                            @if ($product->double_puce)
                                <option value="1" selected> oui </option>
                                <option value="0"> non </option>
                            @else
                                <option value="1"> oui </option>
                                <option value="0" selected> non </option>
                            @endif
                        </select>
                        @error('double_puce')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                </div>

                <button type="submit" class="btn btn-primary w-100 mt-2 mb-3"> Ajouter </button>
            </form>


        </div>

    </div>
@endsection

@section('js')
@endsection
