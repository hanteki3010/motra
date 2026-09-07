<!-- ============ CONTACT ============ -->
<section class="section-pad contact" id="contact">
  <div class="wrap">
    <div class="contact-grid">
      <div class="reveal">
        <div class="eyebrow">Get in Touch</div>
        <h2 class="section-head" style="margin-bottom:30px;">{{ $settings['headline'] ?? 'Visit the estate, or start with a sample' }}</h2>
        <div class="contact-info">
          <div class="row">
            <div class="k">Location</div>
            <div class="v">{{ $settings['location'] ?? 'Đồng Nai Province, South Vietnam' }}</div>
          </div>
          <div class="row">
            <div class="k">Trade Desk (Wholesale &amp; Export)</div>
            <div class="v"><a href="mailto:{{ $settings['trade_desk_email'] ?? 'wholesale@motra.vn' }}">{{ $settings['trade_desk_email'] ?? 'wholesale@motra.vn' }}</a></div>
          </div>
          <div class="row">
            <div class="k">Retail Inquiries</div>
            <div class="v"><a href="mailto:{{ $settings['retail_email'] ?? 'hello@motra.vn' }}">{{ $settings['retail_email'] ?? 'hello@motra.vn' }}</a></div>
          </div>
          <div class="row">
            <div class="k">Farm Visits</div>
            <div class="v">{{ $settings['farm_visits'] ?? 'By appointment, Mon–Sat' }}</div>
          </div>
          @if(!empty($settings['phone']))
          <div class="row">
            <div class="k">Estate Hotline</div>
            <div class="v">{{ $settings['phone'] }}</div>
          </div>
          @endif
        </div>
      </div>

      <div class="reveal">
        <!-- Form Feedback Alert -->
        <div id="contactFormFeedback" class="form-feedback"></div>

        @if(session('success'))
          <div class="form-feedback success" style="display:block;">
            {{ session('success') }}
          </div>
        @endif

        @if($errors->has('recaptcha'))
          <div class="form-feedback error" style="display:block;">
            {{ $errors->first('recaptcha') }}
          </div>
        @endif

        <form id="contactForm" action="{{ route('contact.submit') }}" method="POST">
          @csrf
          <div class="field-row">
            <div>
              <label for="contact_name">Name *</label>
              <input id="contact_name" name="name" type="text" placeholder="Your full name" required>
            </div>
            <div>
              <label for="contact_company">Company (optional)</label>
              <input id="contact_company" name="company" type="text" placeholder="Organization / Brand">
            </div>
          </div>

          <div class="field-row">
            <div>
              <label for="contact_email">Email *</label>
              <input id="contact_email" name="email" type="email" placeholder="name@company.com" required>
            </div>
            <div>
              <label for="contact_interest">Enquiry Type *</label>
              <select id="contact_interest" name="interest" required>
                <option value="Wholesale / bulk pricing">Wholesale / bulk pricing</option>
                <option value="Retail order">Retail order</option>
                <option value="Export &amp; distribution">Export &amp; distribution</option>
                <option value="Farm visit">Farm visit</option>
                <option value="Other">Other</option>
              </select>
            </div>
          </div>

          <div>
            <label for="contact_msg">Message *</label>
            <textarea id="contact_msg" name="message" placeholder="Tell us which botanicals, volumes or details you are interested in..." required></textarea>
          </div>

          <!-- Google reCAPTCHA v2 Checkbox -->
          @php
            $recaptchaSiteKey = config('services.recaptcha.site_key');
          @endphp
          @if(!empty($recaptchaSiteKey))
            <div class="recaptcha-box" style="margin:6px 0 10px;">
              <div class="g-recaptcha" data-sitekey="{{ $recaptchaSiteKey }}"></div>
            </div>
          @else
            <div class="recaptcha-note" style="padding:10px 14px; background:var(--paper); border:1px dashed var(--line); font-family:'IBM Plex Mono', monospace; font-size:0.72rem; color:var(--clay); border-radius:2px; display:flex; align-items:center; gap:10px;">
              <svg style="width:16px; height:16px; color:var(--brass); flex-shrink:0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              <span>reCAPTCHA v2 is configured. Add <code>RECAPTCHA_SITE_KEY</code> &amp; <code>RECAPTCHA_SECRET_KEY</code> in <code>.env</code> to display live tick box.</span>
            </div>
          @endif

          <button class="submit-btn" id="contactSubmitBtn" type="submit" style="margin-top:6px;">
            <span class="btn-text">Send Enquiry</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('contactSubmitBtn');
    const feedback = document.getElementById('contactFormFeedback');

    if (form) {
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Check reCAPTCHA if loaded on page
        const hasRecaptcha = document.querySelector('.g-recaptcha');
        if (hasRecaptcha && typeof grecaptcha !== 'undefined') {
          const recaptchaResponse = grecaptcha.getResponse();
          if (!recaptchaResponse) {
            feedback.className = 'form-feedback error';
            feedback.textContent = 'Please confirm that you are not a robot by ticking the reCAPTCHA box.';
            feedback.style.display = 'block';
            return;
          }
        }

        // Reset feedback
        feedback.className = 'form-feedback';
        feedback.style.display = 'none';
        feedback.textContent = '';

        const originalBtnText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>Processing enquiry...</span>';

        const formData = new FormData(form);

        fetch("{{ route('contact.submit') }}", {
          method: 'POST',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: formData
        })
        .then(response => {
          if (!response.ok) {
            return response.json().then(err => { throw err; });
          }
          return response.json();
        })
        .then(data => {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnText;

          if (data.success) {
            feedback.className = 'form-feedback success';
            feedback.textContent = '✓ ' + (data.message || 'Your message has been received by Motra Trade Desk.');
            feedback.style.display = 'block';
            form.reset();

            if (typeof grecaptcha !== 'undefined') {
              try { grecaptcha.reset(); } catch(e) {}
            }
          } else {
            feedback.className = 'form-feedback error';
            feedback.textContent = data.message || 'An error occurred. Please try again.';
            feedback.style.display = 'block';
            if (typeof grecaptcha !== 'undefined') {
              try { grecaptcha.reset(); } catch(e) {}
            }
          }
        })
        .catch(err => {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnText;

          if (typeof grecaptcha !== 'undefined') {
            try { grecaptcha.reset(); } catch(e) {}
          }

          let errorMsg = 'Could not submit your enquiry. Please check your information and try again.';
          if (err && err.message) {
            errorMsg = err.message;
          } else if (err && err.errors) {
            const firstKey = Object.keys(err.errors)[0];
            errorMsg = err.errors[firstKey][0];
          }

          feedback.className = 'form-feedback error';
          feedback.textContent = errorMsg;
          feedback.style.display = 'block';
        });
      });
    }
  });
</script>
@endpush
