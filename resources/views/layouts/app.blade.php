<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Motra — Essential Oils & Botanical Extracts, Grown in Đồng Nai')</title>
  
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
      --shadow: 0 18px 40px -22px rgba(18,32,25,0.45);
    }
    *{box-sizing:border-box;}
    html{
      scroll-behavior:smooth;
      padding-top:0 !important;
      top:0 !important;
    }
    body{
      margin:0;
      background:var(--paper);
      color:var(--ink);
      font-family:'Work Sans', sans-serif;
      font-weight:400;
      line-height:1.6;
      -webkit-font-smoothing:antialiased;
      position:relative;
      top:0 !important;
    }
    img{max-width:100%; display:block;}
    a{color:inherit;}

    /* texture: fine linen grain */
    body::before{
      content:"";
      position:fixed; inset:0;
      pointer-events:none;
      z-index:0;
      opacity:0.35;
      background-image:
        repeating-linear-gradient(0deg, transparent 0 2px, rgba(31,58,46,0.015) 2px 3px),
        repeating-linear-gradient(90deg, transparent 0 2px, rgba(31,58,46,0.012) 2px 3px);
    }

    h1,h2,h3,h4{
      font-family:'Fraunces', serif;
      font-weight:500;
      margin:0;
      color:var(--pine-deep);
      letter-spacing:-0.01em;
    }
    .eyebrow{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.72rem;
      letter-spacing:0.18em;
      text-transform:uppercase;
      color:var(--brass);
      display:flex; align-items:center; gap:0.6em;
    }
    .eyebrow::before{
      content:"";
      width:22px; height:1px;
      background:var(--brass);
      display:inline-block;
    }
    .wrap{
      max-width:1180px;
      margin:0 auto;
      padding:0 32px;
      position:relative;
      z-index:1;
    }
    section{ position:relative; z-index:1; }

    /* ---------- NAV ---------- */
    header.nav{
      position:sticky; top:0; z-index:99;
      background:rgba(246,241,230,0.94);
      backdrop-filter:blur(10px);
      border-bottom:1px solid var(--line);
    }
    .nav-inner{
      max-width:1180px; margin:0 auto; padding:14px 32px;
      display:flex; align-items:center; justify-content:space-between;
      gap:20px;
    }
    .brandmark{ display:flex; align-items:center; gap:12px; text-decoration:none; }
    .brandmark-img{ width:36px; height:36px; border-radius:50%; object-fit:cover; border:1px solid var(--brass); }
    .brandmark span{
      font-family:'Fraunces', serif; font-size:1.3rem; letter-spacing:0.04em;
      color:var(--pine-deep); font-weight:600;
    }
    nav.links{ display:flex; gap:26px; align-items:center; }
    nav.links a{
      font-size:0.86rem; text-decoration:none; color:var(--ink);
      letter-spacing:0.02em;
      position:relative; padding:4px 0;
      font-weight:400;
    }
    nav.links a::after{
      content:""; position:absolute; left:0; right:0; bottom:0; height:1px;
      background:var(--brass); transform:scaleX(0); transform-origin:left;
      transition:transform .25s ease;
    }
    nav.links a:hover::after{ transform:scaleX(1); }

    .nav-actions{ display:flex; align-items:center; gap:14px; }
    .nav-cta{
      font-family:'IBM Plex Mono', monospace; font-size:0.72rem; letter-spacing:0.08em;
      text-transform:uppercase; text-decoration:none;
      border:1px solid var(--pine); color:var(--pine-deep);
      padding:8px 16px; border-radius:2px;
      transition:all .25s ease;
      white-space:nowrap;
    }
    .nav-cta:hover{ background:var(--pine); color:var(--paper); }
    .nav-admin-link{
      font-family:'IBM Plex Mono', monospace; font-size:0.68rem;
      letter-spacing:0.05em; text-decoration:none; color:var(--clay);
      padding:6px 10px; border-radius:2px; border:1px dashed var(--line);
      transition:all .2s ease;
    }
    .nav-admin-link:hover{ color:var(--pine-deep); border-color:var(--pine); background:rgba(31,58,46,0.05); }

    /* ---------- THEMED LANGUAGE SELECTOR ---------- */
    .lang-switcher{
      position:relative;
      display:inline-flex;
      align-items:center;
    }
    .lang-btn{
      background:transparent;
      border:1px solid var(--line);
      border-radius:2px;
      padding:7px 12px;
      font-family:'IBM Plex Mono', monospace;
      font-size:0.74rem;
      color:var(--pine-deep);
      cursor:pointer;
      display:flex;
      align-items:center;
      gap:8px;
      transition:all .2s ease;
    }
    .lang-btn:hover{
      border-color:var(--brass);
      background:rgba(214,172,102,0.1);
      color:var(--pine-deep);
    }
    .lang-globe-icon{
      width:15px;
      height:15px;
      color:var(--brass);
      flex-shrink:0;
    }
    .lang-chevron-icon{
      width:9px;
      height:6px;
      color:var(--clay);
      transition:transform .2s ease;
    }
    .lang-dropdown{
      display:none;
      position:absolute;
      top:100%;
      right:0;
      margin-top:6px;
      background:var(--paper);
      border:1px solid var(--line);
      box-shadow:var(--shadow);
      border-radius:2px;
      min-width:170px;
      z-index:100;
      padding:6px 0;
    }
    .lang-dropdown.show{ display:block; }
    .lang-option{
      display:flex;
      align-items:center;
      gap:10px;
      padding:9px 16px;
      text-decoration:none;
      cursor:pointer;
      transition:background .2s;
    }
    .lang-option:hover{
      background:var(--paper-deep);
      color:var(--pine);
    }
    .lang-option.active{
      background:rgba(214,172,102,0.15);
      font-weight:600;
    }
    .lang-badge{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.66rem;
      letter-spacing:0.06em;
      padding:2px 6px;
      border-radius:2px;
      background:var(--paper-deep);
      color:var(--clay);
      border:1px solid var(--line);
      flex-shrink:0;
    }
    .lang-option.active .lang-badge{
      background:var(--brass);
      color:var(--pine-deep);
      border-color:var(--brass);
      font-weight:600;
    }
    .lang-text{
      font-family:'Work Sans', sans-serif;
      font-size:0.85rem;
      color:var(--ink);
    }

    /* ================= COMPLETE SUPPRESSION OF GOOGLE TRANSLATE BANNER & IFRAME ================= */
    .goog-te-banner-frame,
    .goog-te-banner-frame.skiptranslate,
    iframe.goog-te-banner-frame,
    iframe.skiptranslate,
    .goog-te-balloon-frame,
    #goog-gt-tt,
    #goog-gt-vt,
    .goog-te-spinner-pos,
    .goog-tooltip,
    .goog-tooltip:hover {
      display:none !important;
      visibility:hidden !important;
      opacity:0 !important;
      height:0 !important;
      width:0 !important;
      max-height:0 !important;
      max-width:0 !important;
      border:none !important;
      pointer-events:none !important;
      z-index:-99999 !important;
      position:fixed !important;
      top:-9999px !important;
      left:-9999px !important;
    }

    /* Keep body firmly at top 0 without Google's 40px push */
    body {
      top:0px !important;
      position:static !important;
    }
    html {
      padding-top:0px !important;
      top:0px !important;
    }
    #google_translate_element {
      display:none !important;
    }
    .goog-text-highlight {
      background:transparent !important;
      box-shadow:none !important;
    }

    /* ---------- HERO ---------- */
    .hero{
      background:var(--pine-deep);
      color:var(--paper);
      padding:110px 0 0 0;
      overflow:hidden;
      position:relative;
    }
    .hero::before{
      content:"";
      position:absolute; inset:0;
      opacity:0.14;
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='600' viewBox='0 0 600 600'%3E%3Cg fill='none' stroke='%23D6AC66' stroke-width='1'%3E%3Cellipse cx='120' cy='140' rx='90' ry='60'/%3E%3Cellipse cx='120' cy='140' rx='150' ry='105'/%3E%3Cellipse cx='120' cy='140' rx='210' ry='150'/%3E%3Cellipse cx='480' cy='420' rx='110' ry='75'/%3E%3Cellipse cx='480' cy='420' rx='175' ry='125'/%3E%3Cellipse cx='480' cy='420' rx='240' ry='175'/%3E%3C/g%3E%3C/svg%3E");
      background-size:600px 600px;
      background-repeat:repeat;
      z-index:0;
    }
    .hero-inner{
      display:grid;
      grid-template-columns:1.05fr 0.95fr;
      gap:56px;
      align-items:center;
      position:relative; z-index:1;
    }
    .hero-eyebrow{
      font-family:'IBM Plex Mono', monospace; font-size:0.72rem;
      letter-spacing:0.2em; text-transform:uppercase; color:var(--brass-light);
      margin-bottom:22px; display:flex; align-items:center; gap:10px;
    }
    .hero-eyebrow::before{ content:""; width:26px; height:1px; background:var(--brass-light); }
    .hero h1{
      color:var(--paper);
      font-size:clamp(2.6rem, 5.2vw, 4.4rem);
      line-height:1.04;
      font-weight:500;
    }
    .hero h1 em{ font-style:italic; color:var(--brass-light); font-weight:400; }
    .hero p.lede{
      margin-top:26px; max-width:480px;
      font-size:1.08rem; color:rgba(246,241,230,0.82);
      font-weight:300;
    }
    .hero-actions{ display:flex; gap:16px; margin-top:38px; flex-wrap:wrap; }
    .btn{
      font-family:'IBM Plex Mono', monospace; font-size:0.76rem; letter-spacing:0.06em;
      text-transform:uppercase; text-decoration:none; padding:15px 26px;
      border-radius:2px; display:inline-block; transition:all .25s ease;
      border:1px solid transparent;
      cursor:pointer;
    }
    .btn-brass{ background:var(--brass); color:var(--pine-deep); font-weight:500; }
    .btn-brass:hover{ background:var(--brass-light); }
    .btn-ghost{ border-color:rgba(246,241,230,0.4); color:var(--paper); }
    .btn-ghost:hover{ border-color:var(--paper); background:rgba(246,241,230,0.08); }

    .hero-frame{
      position:relative;
      padding:14px;
      background:rgba(246,241,230,0.05);
      border:1px solid rgba(214,172,102,0.3);
      text-align:center;
    }
    .hero-frame img{
      width:100%;
      max-height:420px;
      object-fit:cover;
      border-radius:2px;
      margin:0 auto;
    }
    .hero-frame .cap{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.68rem; letter-spacing:0.1em; text-transform:uppercase;
      color:var(--brass-light); margin-top:12px; text-align:center;
    }

    .hero-ribbon{
      margin-top:80px;
      border-top:1px solid rgba(214,172,102,0.22);
      padding:22px 0;
      display:flex; justify-content:space-between; flex-wrap:wrap; gap:18px;
      position:relative; z-index:1;
    }
    .hero-ribbon .item{
      font-family:'IBM Plex Mono', monospace; font-size:0.72rem;
      color:rgba(246,241,230,0.62); letter-spacing:0.04em;
    }
    .hero-ribbon .item b{ color:var(--brass-light); font-weight:500; }

    /* ---------- SECTION HEADERS ---------- */
    .section-head{ max-width:640px; margin-bottom:52px; }
    .section-head h2{ font-size:clamp(1.9rem,3.2vw,2.6rem); margin-top:14px; }
    .section-head p{ margin-top:16px; color:var(--clay); font-size:1.02rem; max-width:560px; }

    .section-pad{ padding:110px 0; }
    .divider{ height:1px; background:var(--line); }

    /* ---------- ESTATE / LEDGER ---------- */
    .estate{ background:var(--paper); }
    .estate-grid{ display:grid; grid-template-columns:1fr 1fr; gap:70px; align-items:start; }
    .estate-copy p{ margin:0 0 18px; color:#3c4d40; font-size:1.02rem; }
    .estate-copy p.drop::first-letter{
      font-family:'Fraunces', serif; font-size:3.4rem; float:left; line-height:0.8;
      padding:6px 8px 0 0; color:var(--brass); font-weight:500;
    }

    .ledger{
      background:var(--paper-deep);
      border:1px solid var(--line);
      padding:36px 34px;
      position:relative;
    }
    .ledger::before{
      content:"THE LEDGER";
      position:absolute; top:-11px; left:28px; background:var(--paper-deep);
      padding:0 10px;
      font-family:'IBM Plex Mono', monospace; font-size:0.68rem; letter-spacing:0.18em;
      color:var(--brass);
    }
    .ledger-row{
      display:flex; justify-content:space-between; align-items:baseline;
      padding:14px 0; border-bottom:1px dashed var(--line);
      font-family:'IBM Plex Mono', monospace; font-size:0.86rem;
    }
    .ledger-row:last-child{ border-bottom:none; }
    .ledger-row .val{ color:var(--pine-deep); font-weight:500; font-size:1.05rem; font-family:'Fraunces', serif; }
    .ledger-row .lbl{ color:var(--clay); letter-spacing:0.02em; }

    /* ---------- FOUNDER LETTER ---------- */
    .letter-section{ background:var(--pine); color:var(--paper); }
    .letter-section .section-head p{ color:rgba(246,241,230,0.72); }
    .letter-section .eyebrow{ color:var(--brass-light); }
    .letter-section .eyebrow::before{ background:var(--brass-light); }
    .letter-grid{ display:grid; grid-template-columns:0.62fr 1fr; gap:64px; align-items:start; }
    .monogram{
      width:104px; height:104px; border-radius:50%;
      border:1px solid rgba(214,172,102,0.55);
      display:flex; align-items:center; justify-content:center;
      font-family:'Fraunces', serif; font-style:italic; font-size:2.1rem;
      color:var(--brass-light);
      margin-bottom:26px;
    }
    .letter-meta{ font-family:'IBM Plex Mono', monospace; font-size:0.78rem; color:rgba(246,241,230,0.55); line-height:1.9; }
    .letter-meta b{ color:var(--brass-light); font-weight:500; display:block; font-family:'Fraunces', serif; font-size:1.2rem; margin-bottom:2px;}
    .letter-body p{ font-size:1.06rem; color:rgba(246,241,230,0.9); margin:0 0 20px; font-weight:300; }
    .letter-body p:first-child::first-letter{
      font-family:'Fraunces', serif; font-style:italic; font-size:3.8rem; float:left;
      line-height:0.75; padding:8px 10px 0 0; color:var(--brass-light);
    }
    .sign-off{ margin-top:34px; font-family:'Fraunces', serif; font-style:italic; font-size:1.3rem; color:var(--brass-light); }
    .sign-off small{ display:block; font-family:'IBM Plex Mono', monospace; font-style:normal; font-size:0.72rem; color:rgba(246,241,230,0.55); margin-top:6px; letter-spacing:0.05em;}

    /* ---------- HERBARIUM ---------- */
    .herbarium{ background:var(--paper); }
    .specimen-grid{
      display:grid; grid-template-columns:repeat(4,1fr); gap:1px;
      background:var(--line);
      border:1px solid var(--line);
    }
    .specimen{
      background:var(--paper);
      padding:30px 26px 26px;
      display:flex; flex-direction:column; gap:14px;
      min-height:300px;
      transition:background .3s ease;
    }
    .specimen:hover{ background:var(--paper-deep); }
    .specimen .icon{ width:40px; height:40px; color:var(--pine); }
    .specimen .icon svg{ width:100%; height:100%; }
    .specimen .part{
      font-family:'IBM Plex Mono', monospace; font-size:0.66rem; letter-spacing:0.1em;
      text-transform:uppercase; color:var(--brass);
    }
    .specimen h3{ font-size:1.18rem; font-weight:500; line-height:1.25; }
    .specimen .latin{ font-style:italic; font-family:'Fraunces', serif; color:var(--clay); font-size:0.92rem; margin-top:-8px; }
    .specimen p{ font-size:0.88rem; color:#4a5a4d; margin:0; flex-grow:1; }
    .specimen .tag{
      font-family:'IBM Plex Mono', monospace; font-size:0.66rem; letter-spacing:0.04em;
      color:var(--pine); border-top:1px dashed var(--line); padding-top:12px; margin-top:auto;
    }
    .specimen .tag.verify{ color:var(--brass); font-weight:500; }
    @media (max-width:980px){ .specimen-grid{ grid-template-columns:repeat(2,1fr); } }
    @media (max-width:560px){ .specimen-grid{ grid-template-columns:1fr; } }

    .herb-note{
      margin-top:26px; padding:18px 22px; border:1px dashed var(--line);
      font-size:0.86rem; color:var(--clay); background:var(--paper-deep);
    }

    /* ---------- PROCESS ---------- */
    .process{ background:var(--paper-deep); }
    .process-grid{ display:grid; grid-template-columns:1fr 1fr; gap:0; border:1px solid var(--line); }
    .process-col{ padding:48px 44px; }
    .process-col + .process-col{ border-left:1px solid var(--line); }
    .process-col .kicker{ font-family:'IBM Plex Mono', monospace; font-size:0.7rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--brass); }
    .process-col h3{ font-size:1.5rem; margin-top:12px; margin-bottom:16px; }
    .process-col p{ color:#3c4d40; font-size:0.96rem; }
    .process-col ul{ margin:18px 0 0; padding:0; list-style:none; }
    .process-col li{ font-size:0.92rem; color:#3c4d40; padding:10px 0; border-top:1px solid var(--line); display:flex; gap:10px; }
    .process-col li:first-child{ border-top:none; }
    .process-col li::before{ content:"·"; color:var(--brass); font-weight:700; }
    @media (max-width:820px){ .process-grid{ grid-template-columns:1fr; } .process-col + .process-col{ border-left:none; border-top:1px solid var(--line); } }

    /* ---------- CERTIFICATIONS ---------- */
    .certs{ background:var(--pine-deep); color:var(--paper); }
    .certs .section-head p{ color:rgba(246,241,230,0.68); }
    .certs .eyebrow{ color:var(--brass-light); } .certs .eyebrow::before{ background:var(--brass-light); }
    .seal-row{ display:grid; grid-template-columns:repeat(3,1fr); gap:1px; background:rgba(214,172,102,0.2); border:1px solid rgba(214,172,102,0.2); }
    .seal{ background:var(--pine-deep); padding:40px 30px; text-align:center; }
    .seal .ring{
      width:76px; height:76px; margin:0 auto 20px; border-radius:50%;
      border:1px solid var(--brass-light);
      display:flex; align-items:center; justify-content:center;
    }
    .seal .ring svg{ width:34px; height:34px; }
    .seal h4{ color:var(--paper); font-size:1.1rem; font-weight:500; }
    .seal p{ color:rgba(246,241,230,0.62); font-size:0.85rem; margin-top:8px; }
    @media (max-width:820px){ .seal-row{ grid-template-columns:1fr; } }

    .coa-strip{
      margin-top:56px; border:1px solid rgba(214,172,102,0.25);
      padding:26px 30px; font-family:'IBM Plex Mono', monospace; font-size:0.82rem;
      display:grid; grid-template-columns:repeat(4,1fr); gap:22px;
    }
    .coa-strip .cell .k{ color:rgba(246,241,230,0.5); font-size:0.68rem; letter-spacing:0.08em; text-transform:uppercase; }
    .coa-strip .cell .v{ color:var(--brass-light); margin-top:6px; font-size:0.95rem; }
    .coa-cap{ font-family:'IBM Plex Mono', monospace; font-size:0.68rem; color:rgba(246,241,230,0.42); margin-top:14px; letter-spacing:0.03em;}
    @media (max-width:760px){ .coa-strip{ grid-template-columns:1fr 1fr; } }

    /* ---------- MARKETS / BULK & RETAIL ---------- */
    .markets{ background:var(--paper); }
    .market-grid{ display:grid; grid-template-columns:1fr 1fr; gap:1px; background:var(--line); border:1px solid var(--line); }
    .market-card{ background:var(--paper); padding:52px 46px; }
    .market-card .eyebrow{ margin-bottom:18px; }
    .market-card h3{ font-size:1.7rem; margin-bottom:14px; }
    .market-card p{ color:#3c4d40; font-size:0.98rem; margin-bottom:26px; }
    .market-card .btn-brass{ background:var(--pine); color:var(--paper); }
    .market-card .btn-brass:hover{ background:var(--pine-deep); }
    .market-card.alt .btn-brass{ background:var(--brass); color:var(--pine-deep); }
    .market-card.alt .btn-brass:hover{ background:var(--brass-light); }
    @media (max-width:820px){ .market-grid{ grid-template-columns:1fr; } }

    /* ---------- CONTACT ---------- */
    .contact{ background:var(--paper-deep); }
    .contact-grid{ display:grid; grid-template-columns:0.9fr 1.1fr; gap:70px; }
    .contact-info .row{ margin-bottom:28px; }
    .contact-info .k{ font-family:'IBM Plex Mono', monospace; font-size:0.7rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--brass); margin-bottom:6px; }
    .contact-info .v{ font-size:1.02rem; color:var(--pine-deep); font-family:'Fraunces', serif; }
    form{ display:flex; flex-direction:column; gap:18px; }
    .field-row{ display:grid; grid-template-columns:1fr 1fr; gap:18px; }
    label{ font-family:'IBM Plex Mono', monospace; font-size:0.68rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--clay); margin-bottom:8px; display:block; }
    input, select, textarea{
      width:100%; background:var(--paper); border:1px solid var(--line); padding:13px 14px;
      font-family:'Work Sans', sans-serif; font-size:0.94rem; color:var(--ink); border-radius:2px;
    }
    input:focus, select:focus, textarea:focus{ outline:2px solid var(--brass); outline-offset:1px; border-color:var(--brass); }
    textarea{ resize:vertical; min-height:110px; }
    .submit-btn{
      align-self:flex-start; background:var(--pine); color:var(--paper); border:none;
      font-family:'IBM Plex Mono', monospace; font-size:0.76rem; letter-spacing:0.06em; text-transform:uppercase;
      padding:15px 30px; border-radius:2px; cursor:pointer; transition:all .25s ease;
      display:inline-flex; align-items:center; gap:8px;
    }
    .submit-btn:hover{ background:var(--pine-deep); }
    .submit-btn:disabled{ opacity:0.65; cursor:not-allowed; }
    .form-feedback{
      padding:14px 18px;
      border-radius:2px;
      font-size:0.88rem;
      font-family:'IBM Plex Mono', monospace;
      margin-bottom:12px;
      display:none;
    }
    .form-feedback.success{
      display:block;
      background:rgba(31,58,46,0.1);
      border:1px solid var(--pine);
      color:var(--pine-deep);
    }
    .form-feedback.error{
      display:block;
      background:rgba(184,50,50,0.1);
      border:1px solid #b83232;
      color:#902020;
    }
    @media (max-width:820px){ .contact-grid{ grid-template-columns:1fr; } .field-row{ grid-template-columns:1fr; } }

    /* ---------- FOOTER ---------- */
    footer{ background:var(--pine-deep); color:rgba(246,241,230,0.6); padding:60px 0 30px; }
    .footer-top{ display:flex; justify-content:space-between; flex-wrap:wrap; gap:30px; padding-bottom:36px; border-bottom:1px solid rgba(214,172,102,0.18); }
    .footer-brand{ display:flex; align-items:center; gap:12px; }
    .footer-brand-img{ width:32px; height:32px; border-radius:50%; object-fit:cover; border:1px solid var(--brass-light); }
    .footer-brand span{ font-family:'Fraunces', serif; color:var(--paper); font-size:1.15rem; }
    .footer-links{ display:flex; gap:40px; flex-wrap:wrap; }
    .footer-links div b{ display:block; color:var(--brass-light); font-size:0.72rem; letter-spacing:0.1em; text-transform:uppercase; font-weight:500; margin-bottom:12px; font-family:'IBM Plex Mono', monospace;}
    .footer-links a{ display:block; text-decoration:none; color:rgba(246,241,230,0.65); font-size:0.88rem; margin-bottom:9px; }
    .footer-links a:hover{ color:var(--paper); }
    .footer-bottom{ padding-top:26px; font-size:0.78rem; display:flex; justify-content:space-between; flex-wrap:wrap; gap:14px; }
    .disclaimer{
      max-width:1180px; margin:0 auto 30px; padding:0 32px;
      font-size:0.76rem; color:rgba(246,241,230,0.42); line-height:1.7; max-width:900px;
    }

    /* reveal animation */
    .reveal{ opacity:0; transform:translateY(18px); transition:opacity .7s ease, transform .7s ease; }
    .reveal.in{ opacity:1; transform:translateY(0); }
    @media (prefers-reduced-motion: reduce){
      html{ scroll-behavior:auto; }
      .reveal{ opacity:1; transform:none; transition:none; }
    }

    @media (max-width:980px){
      .hero-inner{ grid-template-columns:1fr; }
      .estate-grid{ grid-template-columns:1fr; }
      .letter-grid{ grid-template-columns:1fr; }
      .nav-mobile-hide{ display:none; }
    }
    @media (max-width:640px){
      .section-pad{ padding:76px 0; }
      .coa-strip{ grid-template-columns:1fr 1fr; }
    }
  </style>
  @stack('styles')
</head>
<body>

  <!-- Google Translate Hidden Container -->
  <div id="google_translate_element"></div>

  <!-- Header / Navigation -->
  @include('partials.header')

  <!-- Main Content -->
  <main>
    @yield('content')
  </main>

  <!-- Footer -->
  @include('partials.footer')

  <!-- Google Translate API Scripts & Suppression Logic -->
  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,vi,fr,ja,ko,zh-CN,de',
        autoDisplay: false,
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
      }, 'google_translate_element');
    }

    // Function to set active UI state on language button & dropdown
    function updateLanguageUI(langCode, langLabel) {
      const labelEl = document.getElementById('currentLangLabel');
      if (labelEl) {
        labelEl.textContent = langLabel;
      }
      // Update active option
      document.querySelectorAll('.lang-option').forEach(function(opt) {
        if (opt.getAttribute('data-lang') === langCode) {
          opt.classList.add('active');
        } else {
          opt.classList.remove('active');
        }
      });
    }

    // Custom Language Switcher Handler
    function changeLanguage(langCode, langLabel, badgeCode) {
      const domain = window.location.hostname;
      let cookieVal = '/en/' + langCode;
      
      if (langCode === 'en') {
        cookieVal = '/en/en';
        // Clear or reset cookie for English
        document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + domain;
        document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
      }

      document.cookie = 'googtrans=' + cookieVal + '; path=/; domain=' + domain;
      document.cookie = 'googtrans=' + cookieVal + '; path=/';

      updateLanguageUI(langCode, langLabel);

      const dropdown = document.getElementById('langDropdown');
      if (dropdown) dropdown.classList.remove('show');

      // Trigger translate element change or reload
      const select = document.querySelector('.goog-te-combo');
      if (select) {
        select.value = langCode;
        select.dispatchEvent(new Event('change'));
      } else {
        window.location.reload();
      }
    }

    // MutationObserver to permanently neutralize Google's inline body.style.top and hidden banner iframes
    const suppressGoogleBanner = function() {
      if (document.body.style.top && document.body.style.top !== '0px') {
        document.body.style.top = '0px';
      }
      const bannerFrames = document.querySelectorAll('iframe.skiptranslate, .goog-te-banner-frame');
      bannerFrames.forEach(function(frame) {
        frame.style.display = 'none';
        frame.style.visibility = 'hidden';
        frame.style.height = '0';
        frame.style.width = '0';
      });
    };

    const bodyObserver = new MutationObserver(suppressGoogleBanner);
    bodyObserver.observe(document.body, { attributes: true, attributeFilter: ['style', 'class'] });

    // Initialize Language Dropdown and Default State
    document.addEventListener('DOMContentLoaded', function() {
      const btn = document.getElementById('currentLangBtn');
      const dropdown = document.getElementById('langDropdown');
      
      if (btn && dropdown) {
        btn.addEventListener('click', function(e) {
          e.stopPropagation();
          dropdown.classList.toggle('show');
        });
        document.addEventListener('click', function() {
          dropdown.classList.remove('show');
        });
      }

      // Check existing googtrans cookie; DEFAULT is English (en)
      const match = document.cookie.match(/googtrans=\/en\/([a-zA-Z\-]+)/);
      let currentLang = 'en';
      let currentLabel = 'English';

      if (match && match[1] && match[1] !== 'en') {
        currentLang = match[1];
        const opt = document.querySelector('[data-lang="' + currentLang + '"]');
        if (opt) {
          currentLabel = opt.getAttribute('data-label');
        }
      }

      updateLanguageUI(currentLang, currentLabel);

      // Repeated safety check for body top
      setInterval(suppressGoogleBanner, 300);
    });
  </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!-- Scroll Reveal Observer -->
  <script>
    const io = new IntersectionObserver((entries)=>{
      entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('in'); io.unobserve(e.target); } });
    }, {threshold:0.12});
    document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
  </script>
  @stack('scripts')
</body>
</html>
