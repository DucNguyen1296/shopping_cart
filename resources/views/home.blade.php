@extends('layout')

@section('content')
    <!-- Featured Start -->
    @include('elements/feature')
    <!-- Featured End -->

    <!-- Categories Start -->
    @include('elements/category')
    <!-- Categories End -->

    <!-- Offer Start -->
    @include('elements/offer')
    <!-- Offer End -->

    <!-- Products Start -->
    @include('elements/product')
    <!-- Products End -->

    <!-- Subscribe Start -->
    @include('elements/subscribe')
    <!-- Subscribe End -->

    <!-- Hot Products Start -->
    @include('elements/hotproduct')
    <!-- Products End -->

    <!-- Carosel Products Start -->
    @include('elements/caroselproduct')
    <!-- Carosel Products End -->

    <!-- Vendor Start -->
    @include('elements/vendor')
    <!-- Vendor End -->
@endsection
