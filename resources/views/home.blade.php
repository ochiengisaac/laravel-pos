@extends('layouts.admin')



<?php if (auth()->user()->role === "merchant") : ?>
@section('content-header', 'Merchant Dashboard')
@include('merchant_home')
<?php elseif (auth()->user()->role === 'supplier') : ?>
@section('content-header', 'Supplier Dashboard')
@include('supplier_home')
<?php elseif (auth()->user()->role === "admin") : ?>
@section('content-header', 'Admin Dashboard')
@include('default_home')
<?php elseif (auth()->user()->role === "super-admin") : ?>
@section('content-header', 'Admin Dashboard')
@include('default_home')
<?php endif; ?>