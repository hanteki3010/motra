<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Motra Estate Administration')</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Work+Sans:wght@300;400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

  <style>
    :root{
      --paper:#F6F1E6;
      --paper-deep:#EEE5D2;
      --ink:#1C2A20;
      --pine:#1F3A2E;
      --pine-deep:#122019;
      --brass:#B8863B;
      --brass-light:#D6AC66;
      --clay:#8A6A46;
      --line:rgba(31,58,46,0.18);
      --shadow: 0 18px 40px -22px rgba(18,32,25,0.25);
    }
    *{box-sizing:border-box;}
    body{
      margin:0;
      background:var(--paper);
      color:var(--ink);
      font-family:'Work Sans', sans-serif;
      font-weight:400;
      line-height:1.6;
      min-height:100vh;
      display:flex;
    }
    a{color:inherit; text-decoration:none;}
    h1,h2,h3,h4{
      font-family:'Fraunces', serif;
      color:var(--pine-deep);
      margin:0;
    }

    /* texture */
    body::before{
      content:"";
      position:fixed; inset:0;
      pointer-events:none;
      z-index:0;
      opacity:0.3;
      background-image:
        repeating-linear-gradient(0deg, transparent 0 2px, rgba(31,58,46,0.015) 2px 3px),
        repeating-linear-gradient(90deg, transparent 0 2px, rgba(31,58,46,0.012) 2px 3px);
    }

    /* Admin Layout Structure */
    .admin-sidebar{
      width:270px;
      background:var(--pine-deep);
      color:var(--paper);
      flex-shrink:0;
      display:flex;
      flex-direction:column;
      position:sticky;
      top:0;
      height:100vh;
      border-right:1px solid rgba(214,172,102,0.2);
      z-index:10;
    }
    .admin-brand{
      padding:24px 22px;
      display:flex;
      align-items:center;
      gap:14px;
      border-bottom:1px solid rgba(214,172,102,0.18);
    }
    .admin-brand img{
      width:40px;
      height:40px;
      border-radius:50%;
      object-fit:cover;
      border:1px solid var(--brass-light);
    }
    .admin-brand-info h2{
      font-size:1.25rem;
      color:var(--paper);
      letter-spacing:0.02em;
    }
    .admin-brand-info span{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.64rem;
      letter-spacing:0.12em;
      text-transform:uppercase;
      color:var(--brass-light);
      display:block;
    }

    .sidebar-menu{
      padding:24px 14px;
      display:flex;
      flex-direction:column;
      gap:6px;
      flex-grow:1;
    }
    .menu-kicker{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.62rem;
      letter-spacing:0.15em;
      text-transform:uppercase;
      color:rgba(246,241,230,0.4);
      padding:6px 12px 2px;
      margin-top:12px;
    }
    .menu-link{
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding:11px 14px;
      border-radius:2px;
      font-size:0.88rem;
      color:rgba(246,241,230,0.75);
      transition:all .2s ease;
      font-family:'Work Sans', sans-serif;
    }
    .menu-link:hover{
      color:var(--paper);
      background:rgba(246,241,230,0.08);
    }
    .menu-link.active{
      color:var(--pine-deep);
      background:var(--brass-light);
      font-weight:500;
    }
    .menu-link-title{
      display:flex;
      align-items:center;
      gap:10px;
    }
    .menu-icon{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.9rem;
      opacity:0.8;
    }
    .badge-count{
      background:var(--brass);
      color:var(--pine-deep);
      font-family:'IBM Plex Mono', monospace;
      font-size:0.68rem;
      font-weight:600;
      padding:2px 7px;
      border-radius:10px;
    }
    .menu-link.active .badge-count{
      background:var(--pine-deep);
      color:var(--paper);
    }

    .sidebar-footer{
      padding:18px 20px;
      border-top:1px solid rgba(214,172,102,0.18);
      font-size:0.8rem;
      display:flex;
      flex-direction:column;
      gap:10px;
    }
    .sidebar-user{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.72rem;
      color:rgba(246,241,230,0.55);
      display:flex;
      align-items:center;
      gap:8px;
    }
    .sidebar-user b{ color:var(--brass-light); }
    .logout-btn{
      background:none;
      border:1px solid rgba(214,172,102,0.3);
      color:rgba(246,241,230,0.8);
      font-family:'IBM Plex Mono', monospace;
      font-size:0.68rem;
      letter-spacing:0.08em;
      text-transform:uppercase;
      padding:8px 12px;
      border-radius:2px;
      cursor:pointer;
      text-align:center;
      width:100%;
      transition:all .2s;
    }
    .logout-btn:hover{
      background:rgba(214,172,102,0.15);
      color:var(--paper);
      border-color:var(--brass-light);
    }

    /* Main Area */
    .admin-main{
      flex-grow:1;
      display:flex;
      flex-direction:column;
      min-width:0;
      position:relative;
      z-index:1;
    }
    .admin-header{
      background:var(--paper-deep);
      border-bottom:1px solid var(--line);
      padding:18px 36px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      position:sticky;
      top:0;
      z-index:5;
    }
    .admin-header h1{
      font-size:1.55rem;
      color:var(--pine-deep);
      font-weight:500;
    }
    .header-actions{
      display:flex;
      align-items:center;
      gap:14px;
    }
    .btn-site-preview{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.72rem;
      letter-spacing:0.06em;
      text-transform:uppercase;
      padding:7px 14px;
      border:1px solid var(--pine);
      color:var(--pine-deep);
      border-radius:2px;
      transition:all .2s ease;
      display:flex;
      align-items:center;
      gap:6px;
    }
    .btn-site-preview:hover{
      background:var(--pine);
      color:var(--paper);
    }

    .admin-content{
      padding:36px;
      max-width:1280px;
      width:100%;
      margin:0 auto;
    }

    /* Flash Alerts */
    .alert{
      padding:14px 20px;
      border-radius:2px;
      font-family:'IBM Plex Mono', monospace;
      font-size:0.82rem;
      margin-bottom:24px;
      display:flex;
      align-items:center;
      justify-content:space-between;
    }
    .alert-success{
      background:rgba(31,58,46,0.1);
      border:1px solid var(--pine);
      color:var(--pine-deep);
    }
    .alert-error{
      background:rgba(184,50,50,0.1);
      border:1px solid #b83232;
      color:#902020;
    }

    /* Cards & Panels */
    .card{
      background:var(--paper);
      border:1px solid var(--line);
      border-radius:2px;
      padding:28px 28px;
      margin-bottom:24px;
      position:relative;
      box-shadow:0 4px 16px -8px rgba(31,58,46,0.08);
    }
    .card-header{
      display:flex;
      align-items:center;
      justify-content:space-between;
      margin-bottom:22px;
      padding-bottom:14px;
      border-bottom:1px dashed var(--line);
    }
    .card-title{
      font-size:1.25rem;
      color:var(--pine-deep);
    }

    /* Badges */
    .badge{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.68rem;
      letter-spacing:0.06em;
      text-transform:uppercase;
      padding:4px 8px;
      border-radius:2px;
      display:inline-block;
      font-weight:500;
    }
    .badge-unread{ background:#fae7cb; color:#874900; border:1px solid #e0be89; }
    .badge-read{ background:#e1e9e3; color:#1f3a2e; border:1px solid #b2c5b7; }
    .badge-replied{ background:#d9ecd8; color:#185317; border:1px solid #9dc39b; }
    .badge-archived{ background:#e5e5e5; color:#555; border:1px solid #ccc; }

    /* Tables */
    .table-container{
      overflow-x:auto;
    }
    table.data-table{
      width:100%;
      border-collapse:collapse;
      text-align:left;
      font-size:0.9rem;
    }
    table.data-table th{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.7rem;
      letter-spacing:0.08em;
      text-transform:uppercase;
      color:var(--clay);
      background:var(--paper-deep);
      padding:12px 16px;
      border-bottom:1px solid var(--line);
    }
    table.data-table td{
      padding:14px 16px;
      border-bottom:1px solid var(--line);
      color:var(--ink);
      vertical-align:middle;
    }
    table.data-table tr:hover td{
      background:rgba(238,229,210,0.5);
    }

    /* Buttons */
    .btn-admin{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.72rem;
      letter-spacing:0.06em;
      text-transform:uppercase;
      padding:8px 16px;
      border-radius:2px;
      display:inline-block;
      cursor:pointer;
      border:1px solid transparent;
      transition:all .2s ease;
    }
    .btn-admin-pine{ background:var(--pine); color:var(--paper); }
    .btn-admin-pine:hover{ background:var(--pine-deep); }
    .btn-admin-brass{ background:var(--brass); color:var(--pine-deep); font-weight:500; }
    .btn-admin-brass:hover{ background:var(--brass-light); }
    .btn-admin-ghost{ border-color:var(--line); color:var(--ink); }
    .btn-admin-ghost:hover{ background:var(--paper-deep); border-color:var(--pine); }
    .btn-admin-danger{ border-color:#d46a6a; color:#b02525; background:rgba(212,106,106,0.08); }
    .btn-admin-danger:hover{ background:#b02525; color:#fff; }

    /* Forms */
    .form-group{ margin-bottom:18px; }
    .form-group label{
      display:block;
      font-family:'IBM Plex Mono', monospace;
      font-size:0.72rem;
      letter-spacing:0.08em;
      text-transform:uppercase;
      color:var(--clay);
      margin-bottom:6px;
    }
    .form-control{
      width:100%;
      background:var(--paper);
      border:1px solid var(--line);
      padding:11px 13px;
      font-family:'Work Sans', sans-serif;
      font-size:0.92rem;
      color:var(--ink);
      border-radius:2px;
    }
    .form-control:focus{
      outline:2px solid var(--brass);
      border-color:var(--brass);
    }
    /* Pagination */
    .motra-pagination{
      display:inline-flex;
      gap:5px;
      align-items:center;
      font-family:'IBM Plex Mono', monospace;
      font-size:0.75rem;
    }
    .motra-pagination .page-link{
      display:inline-block;
      padding:6px 12px;
      border:1px solid var(--line);
      background:var(--paper);
      color:var(--ink);
      text-decoration:none;
      border-radius:2px;
      transition:all .2s ease;
    }
    .motra-pagination .page-link:hover:not(.disabled){
      background:var(--paper-deep);
      border-color:var(--brass);
      color:var(--pine-deep);
    }
    .motra-pagination .page-link.active{
      background:var(--pine);
      color:var(--paper);
      border-color:var(--pine);
      font-weight:600;
    }
    .motra-pagination .page-link.disabled{
      opacity:0.4;
      cursor:not-allowed;
      background:var(--paper-deep);
    }

    /* Responsive */
    @media (max-width:900px){
      body{ flex-direction:column; }
      .admin-sidebar{ width:100%; height:auto; position:relative; }
      .admin-header{ padding:16px 20px; }
      .admin-content{ padding:20px; }
    }
  </style>
  @stack('styles')
</head>
<body>

  <!-- Sidebar -->
  <aside class="admin-sidebar">
    <div class="admin-brand">
      <img src="{{ asset('images/logo.jpg') }}" alt="Motra Farm Logo">
      <div class="admin-brand-info">
        <h2>Motra</h2>
        <span>Administration</span>
      </div>
    </div>

    <nav class="sidebar-menu">
      <div class="menu-kicker">Navigation</div>
      
      <a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="menu-link-title">
          <span class="menu-icon">◈</span>
          <span>Dashboard</span>
        </span>
      </a>

      <a href="{{ route('admin.messages.index') }}" class="menu-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
        <span class="menu-link-title">
          <span class="menu-icon">✉</span>
          <span>Inquiries</span>
        </span>
        @php
          $unreadTotal = \App\Models\ContactMessage::where('status', 'unread')->count();
        @endphp
        @if($unreadTotal > 0)
          <span class="badge-count">{{ $unreadTotal }}</span>
        @endif
      </a>

      <a href="{{ route('admin.settings.index') }}" class="menu-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
        <span class="menu-link-title">
          <span class="menu-icon">⚙</span>
          <span>Estate Info</span>
        </span>
      </a>

      <div class="menu-kicker">Shortcuts</div>

      <a href="{{ route('home') }}" target="_blank" class="menu-link">
        <span class="menu-link-title">
          <span class="menu-icon">↗</span>
          <span>Live Website</span>
        </span>
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <span>User:</span>
        <b>{{ auth()->user()->name ?? 'Administrator' }}</b>
      </div>
      <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">Sign Out</button>
      </form>
    </div>
  </aside>

  <!-- Main Content Area -->
  <div class="admin-main">
    <header class="admin-header">
      <h1>@yield('page-title', 'Dashboard')</h1>
      <div class="header-actions">
        <a href="{{ route('home') }}" target="_blank" class="btn-site-preview">
          <span>View Site</span> ↗
        </a>
      </div>
    </header>

    <main class="admin-content">
      @if(session('success'))
        <div class="alert alert-success">
          <span>✓ {{ session('success') }}</span>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-error">
          <span>✕ {{ session('error') }}</span>
        </div>
      @endif

      @yield('content')
    </main>
  </div>

  @stack('scripts')
</body>
</html>
