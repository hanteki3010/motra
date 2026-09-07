<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Store a new contact enquiry from the frontend form.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:190',
            'email' => 'required|email|max:190',
            'company' => 'nullable|string|max:190',
            'interest' => 'required|string|max:100',
            'message' => 'required|string|max:5000',
        ]);

        // Validate reCAPTCHA v2 if secret_key is configured in .env
        $recaptchaSecret = config('services.recaptcha.secret_key');
        if (!empty($recaptchaSecret)) {
            $recaptchaToken = $request->input('g-recaptcha-response');

            if (empty($recaptchaToken)) {
                $errorMsg = 'Please verify that you are not a robot by ticking the reCAPTCHA checkbox.';
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => $errorMsg,
                    ], 422);
                }
                return back()->withErrors(['recaptcha' => $errorMsg])->withInput();
            }

            try {
                $verifyResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret'   => $recaptchaSecret,
                    'response' => $recaptchaToken,
                    'remoteip' => $request->ip(),
                ]);

                if (!$verifyResponse->json('success')) {
                    $errorMsg = 'reCAPTCHA verification failed. Please check the box again.';
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => $errorMsg,
                        ], 422);
                    }
                    return back()->withErrors(['recaptcha' => $errorMsg])->withInput();
                }
            } catch (\Exception $e) {
                Log::warning('reCAPTCHA verification exception: ' . $e->getMessage());
            }
        }

        $contact = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => $validated['company'] ?? null,
            'interest' => $validated['interest'],
            'message' => $validated['message'],
            'status' => 'unread',
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you. Your message has been received by the Motra Trade Desk.',
                'contact_id' => $contact->id,
            ]);
        }

        return redirect()->to(url()->previous() . '#contact')
            ->with('success', 'Thank you. Your message has been received by the Motra Trade Desk.');
    }
}
