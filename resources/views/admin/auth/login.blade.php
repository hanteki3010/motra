<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — Motra Farm &amp; Extraction House</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,400;0,9..144,500;0,9..144,600&family=Work+Sans:wght@300;400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

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
      --shadow: 0 24px 50px -20px rgba(18,32,25,0.4);
    }
    *{box-sizing:border-box;}
    body{
      margin:0;
      background:var(--pine-deep);
      color:var(--paper);
      font-family:'Work Sans', sans-serif;
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:24px;
      position:relative;
    }
    body::before{
      content:"";
      position:absolute; inset:0;
      opacity:0.12;
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='600' viewBox='0 0 600 600'%3E%3Cg fill='none' stroke='%23D6AC66' stroke-width='1'%3E%3Cellipse cx='120' cy='140' rx='90' ry='60'/%3E%3Cellipse cx='120' cy='140' rx='150' ry='105'/%3E%3Cellipse cx='120' cy='140' rx='210' ry='150'/%3E%3Cellipse cx='480' cy='420' rx='110' ry='75'/%3E%3Cellipse cx='480' cy='420' rx='175' ry='125'/%3E%3Cellipse cx='480' cy='420' rx='240' ry='175'/%3E%3C/g%3E%3C/svg%3E");
      background-size:600px 600px;
    }

    .login-box{
      background:var(--paper);
      color:var(--ink);
      width:100%;
      max-width:440px;
      border:1px solid rgba(214,172,102,0.4);
      box-shadow:var(--shadow);
      padding:44px 38px;
      position:relative;
      z-index:1;
      border-radius:2px;
    }
    .brand-header{
      text-align:center;
      margin-bottom:32px;
    }
    .brand-header img{
      width:68px;
      height:68px;
      border-radius:50%;
      object-fit:cover;
      border:2px solid var(--brass);
      margin:0 auto 14px;
    }
    .brand-header h1{
      font-family:'Fraunces', serif;
      font-size:1.75rem;
      color:var(--pine-deep);
      margin:0 0 4px;
    }
    .brand-header p{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.72rem;
      letter-spacing:0.14em;
      text-transform:uppercase;
      color:var(--brass);
      margin:0;
    }

    .form-group{
      margin-bottom:20px;
    }
    label{
      display:block;
      font-family:'IBM Plex Mono', monospace;
      font-size:0.7rem;
      letter-spacing:0.08em;
      text-transform:uppercase;
      color:var(--clay);
      margin-bottom:6px;
    }
    input[type="email"], input[type="password"]{
      width:100%;
      background:var(--paper-deep);
      border:1px solid var(--line);
      padding:12px 14px;
      font-family:'Work Sans', sans-serif;
      font-size:0.95rem;
      color:var(--ink);
      border-radius:2px;
    }
    input:focus{
      outline:2px solid var(--brass);
      border-color:var(--brass);
      background:var(--paper);
    }
    .remember-row{
      display:flex;
      align-items:center;
      gap:8px;
      font-size:0.85rem;
      color:var(--clay);
      margin-bottom:24px;
    }
    .login-btn{
      width:100%;
      background:var(--pine);
      color:var(--paper);
      border:none;
      font-family:'IBM Plex Mono', monospace;
      font-size:0.78rem;
      letter-spacing:0.1em;
      text-transform:uppercase;
      padding:14px;
      border-radius:2px;
      cursor:pointer;
      transition:background .2s;
    }
    .login-btn:hover{
      background:var(--pine-deep);
    }

    .error-alert{
      padding:12px;
      background:rgba(184,50,50,0.1);
      border:1px solid #b83232;
      color:#902020;
      font-size:0.82rem;
      margin-bottom:20px;
      border-radius:2px;
    }

    .back-home{
      display:block;
      text-align:center;
      margin-top:20px;
      font-family:'IBM Plex Mono', monospace;
      font-size:0.72rem;
      color:rgba(246,241,230,0.7);
      text-decoration:none;
    }
    .back-home:hover{
      color:var(--brass-light);
    }
  </style>
</head>
<body>

  <div class="login-box">
    <div class="brand-header">
      <img src="{{ asset('images/logo.jpg') }}" alt="Motra Logo">
      <h1>Motra</h1>
      <p>Administration Access</p>
    </div>

    @if ($errors->any())
      <div class="error-alert">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="email">Account Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required>
      </div>

      <div class="remember-row">
        <input type="checkbox" id="remember" name="remember" checked>
        <label for="remember" style="margin:0; text-transform:none; font-family:'Work Sans', sans-serif;">Remember my session</label>
      </div>

      <button type="submit" class="login-btn">Sign In to Dashboard</button>
    </form>

    <a href="{{ route('home') }}" class="back-home">← Return to Motra Website</a>
  </div>

</body>
</html>
