@extends('admin.layouts.master')
@section('content')

            <x-form name="villa_name" label="Villa name" type="text"/>
            <x-form name="price" label="Price" type="number"/>
            <x-form name="berdroom" label="Bedroom" type="number"/>
            <x-form name="sub_region" label="Sub Region" type="text"/>
@endsection