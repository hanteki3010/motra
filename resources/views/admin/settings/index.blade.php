@extends('layouts.admin')

@section('title', 'Estate Contact Information — Motra Admin')
@section('page-title', 'Estate Contact Information Settings')

@section('content')
  <style>
    .settings-grid{
      display:grid;
      grid-template-columns:1fr 340px;
      gap:28px;
    }
    .settings-desc{
      font-size:0.88rem;
      color:var(--clay);
      margin-bottom:20px;
    }
    @media (max-width:960px){
      .settings-grid{ grid-template-columns:1fr; }
    }
  </style>

  <div class="settings-grid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Manage Public Contact Details</h3>
      </div>

      <p class="settings-desc">
        These details are displayed on the public landing page in the <b>Get in Touch</b> and <b>Footer</b> sections. Updates take effect immediately.
      </p>

      <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="headline">Contact Section Headline</label>
          <input type="text" id="headline" name="headline" class="form-control" 
                 value="{{ old('headline', $settings['headline']->value ?? 'Visit the estate, or start with a sample') }}" required>
          <small style="color:var(--clay); font-size:0.75rem;">Main heading shown in the contact section.</small>
        </div>

        <div class="form-group">
          <label for="location">Estate Location / Region</label>
          <input type="text" id="location" name="location" class="form-control" 
                 value="{{ old('location', $settings['location']->value ?? 'Đồng Nai Province, South Vietnam') }}" required>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="form-group">
            <label for="trade_desk_email">Trade Desk (Wholesale Email)</label>
            <input type="email" id="trade_desk_email" name="trade_desk_email" class="form-control" 
                   value="{{ old('trade_desk_email', $settings['trade_desk_email']->value ?? 'wholesale@motra.vn') }}" required>
          </div>

          <div class="form-group">
            <label for="retail_email">Retail Customer Email</label>
            <input type="email" id="retail_email" name="retail_email" class="form-control" 
                   value="{{ old('retail_email', $settings['retail_email']->value ?? 'hello@motra.vn') }}" required>
          </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="form-group">
            <label for="farm_visits">Farm Visits Schedule</label>
            <input type="text" id="farm_visits" name="farm_visits" class="form-control" 
                   value="{{ old('farm_visits', $settings['farm_visits']->value ?? 'By appointment, Mon–Sat') }}" required>
          </div>

          <div class="form-group">
            <label for="phone">Estate Hotline Phone</label>
            <input type="text" id="phone" name="phone" class="form-control" 
                   value="{{ old('phone', $settings['phone']->value ?? '+84 (0) 251 388 9922') }}">
          </div>
        </div>

        <div class="form-group">
          <label for="address">Full Estate Physical Address</label>
          <input type="text" id="address" name="address" class="form-control" 
                 value="{{ old('address', $settings['address']->value ?? 'Thống Nhất District, Đồng Nai Province, Vietnam') }}">
        </div>

        <div style="margin-top:28px;">
          <button type="submit" class="btn-admin btn-admin-pine" style="padding:12px 28px; font-size:0.78rem;">
            Save &amp; Update Live Website
          </button>
        </div>
      </form>
    </div>

    <!-- Right Side: Preview & Info -->
    <div>
      <div class="card">
        <h3 class="card-title" style="margin-bottom:14px;">Live Preview Guide</h3>
        <div style="font-size:0.86rem; color:var(--ink); line-height:1.6;">
          <p>The updated contact details will be automatically bound to:</p>
          <ul style="padding-left:20px; color:#4a5a4d;">
            <li>Landing page <b>#contact</b> section</li>
            <li>The Ledger <b>Region</b> badge</li>
            <li>Footer estate contact links</li>
          </ul>
        </div>
        <div style="margin-top:20px; border-top:1px dashed var(--line); padding-top:16px;">
          <a href="{{ route('home') }}#contact" target="_blank" class="btn-admin btn-admin-brass" style="width:100%; text-align:center;">
            View Contact Section ↗
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
