<!-- ============ NAV ============ -->
<header class="nav">
  <div class="nav-inner">
    <a class="brandmark" href="#top">
      <img src="{{ asset('images/logo.jpg') }}" alt="Motra Farm Logo" class="brandmark-img">
      <span>Motra</span>
    </a>
    
    <nav class="links nav-mobile-hide">
      <a href="#estate">The Estate</a>
      <a href="#founder">Founder</a>
      <a href="#herbarium">The Herbarium</a>
      <a href="#process">Process</a>
      <a href="#certifications">Certifications</a>
      <a href="#markets">Wholesale &amp; Retail</a>
    </nav>
    
    <div class="nav-actions">
      AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
      <!-- Google Translate Custom Language Dropdown -->
      <div class="lang-switcher">
        <button type="button" class="lang-btn" id="currentLangBtn" title="Select Language / Chuyển đổi ngôn ngữ">
          <svg class="lang-globe-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
            <circle cx="12" cy="12" r="10"/>
            <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
          <span id="currentLangLabel">English</span>
          <svg class="lang-chevron-icon" viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="1.6">
            <path d="M1 1l4 4 4-4"/>
          </svg>
        </button>
        <div class="lang-dropdown" id="langDropdown">
          <a class="lang-option active" data-lang="en" data-label="English" data-code="EN" onclick="changeLanguage('en', 'English', 'EN')">
            <span class="lang-badge">EN</span>
            <span class="lang-text">English</span>
          </a>
          <a class="lang-option" data-lang="vi" data-label="Tiếng Việt" data-code="VI" onclick="changeLanguage('vi', 'Tiếng Việt', 'VI')">
            <span class="lang-badge">VI</span>
            <span class="lang-text">Tiếng Việt</span>
          </a>
          <a class="lang-option" data-lang="fr" data-label="Français" data-code="FR" onclick="changeLanguage('fr', 'Français', 'FR')">
            <span class="lang-badge">FR</span>
            <span class="lang-text">Français</span>
          </a>
          <a class="lang-option" data-lang="ja" data-label="日本語" data-code="JA" onclick="changeLanguage('ja', '日本語', 'JA')">
            <span class="lang-badge">JA</span>
            <span class="lang-text">日本語</span>
          </a>
          <a class="lang-option" data-lang="ko" data-label="한국어" data-code="KO" onclick="changeLanguage('ko', '한국어', 'KO')">
            <span class="lang-badge">KO</span>
            <span class="lang-text">한국어</span>
          </a>
          <a class="lang-option" data-lang="zh-CN" data-label="中文" data-code="ZH" onclick="changeLanguage('zh-CN', '中文', 'ZH')">
            <span class="lang-badge">ZH</span>
            <span class="lang-text">中文</span>
          </a>
        </div>
      </div>

      <a href="#contact" class="nav-cta">Enquire</a>
    </div>
  </div>
</header>
