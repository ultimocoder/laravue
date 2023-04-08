@extends('layouts.master')
@section('title','Dashboard')
@section('content') 
<div id="app">
    <showsubcategory/>
</div>
<script src="{{ mix('js/app.js') }}"></script>
@endsection