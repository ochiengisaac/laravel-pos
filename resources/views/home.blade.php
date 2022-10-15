@extends('layouts.admin')

@section('content-header', 'Dashboard')

<?php if (auth()->user()->role === "merchant") : ?>
@include('merchant_home')
<?php elseif (auth()->user()->role === 'supplier') : ?>
@include('supplier_home')
<?php else : ?>
@include('default_home')
<?php endif; ?>