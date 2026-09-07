<!-- ============ FOOTER ============ -->
<footer>
  <div class="wrap">
    <div class="footer-top">
      <div class="footer-brand">
        <img src="{{ asset('images/logo.jpg') }}" alt="Motra Brandmark" class="footer-brand-img">
        <span>Motra</span>
      </div>
      <div class="footer-links">
        <div>
          <b>Explore</b>
          <a href="#estate">The Estate</a>
          <a href="#founder">Founder</a>
          <a href="#herbarium">The Herbarium</a>
        </div>
        <div>
          <b>Business</b>
          <a href="#markets">Wholesale</a>
          <a href="#certifications">Certifications</a>
          <a href="#contact">Contact</a>
        </div>
        <div>
          <b>Estate</b>
          <a href="#estate">{{ $settings['location'] ?? 'Đồng Nai Province, Vietnam' }}</a>
          <a href="mailto:{{ $settings['trade_desk_email'] ?? 'wholesale@motra.vn' }}">{{ $settings['trade_desk_email'] ?? 'wholesale@motra.vn' }}</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© {{ date('Y') }} Motra Farm &amp; Extraction House. All rights reserved.</span>
      <span>Grown in Đồng Nai, South Vietnam.</span>
    </div>
  </div>
  <div class="disclaimer">Motra's oils and extracts are natural cosmetic, personal-care, food and formulation ingredients. They are not intended to diagnose, treat, cure or prevent any disease, and are not a substitute for advice or care from a qualified healthcare professional. Certification claims and analytical data are available on request per batch.</div>
</footer>
