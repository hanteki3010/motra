@extends('layouts.app')

@section('title', 'Motra — Essential Oils & Botanical Extracts, Grown in Đồng Nai')

@section('content')
  {{-- 1. Hero Section --}}
  @include('partials.hero')

  {{-- 2. The Estate / The Ledger --}}
  @include('partials.estate')

  {{-- 3. Founder Letter --}}
  @include('partials.founder')

  {{-- 4. The Herbarium (8 Specimens) --}}
  @include('partials.herbarium')

  {{-- 5. Process (Semi-Tech & Traditional) --}}
  @include('partials.process')

  {{-- 6. Certifications & COA --}}
  @include('partials.certifications')

  {{-- 7. Markets (Wholesale & Retail) --}}
  @include('partials.markets')

  {{-- 8. Contact Section & Interactive Form --}}
  @include('partials.contact')
@endsection
