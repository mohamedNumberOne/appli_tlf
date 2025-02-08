@extends('admin.template')


@section('page_name')
    Modification commercial
@endsection

@section('title')
    Modification commercial
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

        <h1 class="text-center"> Modification de  {{ $info_user -> name }}  </h1>
        <form method="post" action="{{ route('update_commercial' , $info_user -> id ) }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Email</label>
                    <input type="email" value="{{ $info_user -> email }}" class="form-control" id="inputEmail4" placeholder="Email" name="email" required>
                    @error('email')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Mot de passe</label>
                    <input type="password"  class="form-control" id="inputPassword4" placeholder="Mot de passe"
                        name="ps1" required  minlength="8"  >
                    @error('ps1')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword5">Retapez le MDP</label>
                    <input type="password" class="form-control" id="inputPassword5" placeholder="Mot de passe"
                        name="ps1_confirmation" required minlength="8" >
                    @error('ps1_confirmation')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-4">
                    <label for="name">Nom complet</label>
                    <input type="text" value="{{ $info_user -> name }}"  class="form-control" id="name" name="name" required>
                    @error('name')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="telephone">Téléphone</label>
                    <input type="tel"  value="{{ $info_user -> tlf }}" class="form-control" id="telephone" name="tlf" required>
                    @error('tlf')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
               

            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2 mb-3"> Modifier </button>
        </form>
</div>

@endsection