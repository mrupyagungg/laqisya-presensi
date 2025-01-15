@extends('layouts.main-adm')

@section('container')
    @include('layouts.header')
    <div class="container-fluid">
        <div class="row">
            

            @include('layouts.sidebar-adm')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                @yield('container-dashboard')

            </main>
        </div>
    </div>
@endsection
