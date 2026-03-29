<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use App\Models\MockPwdRegistry;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        $user = auth()->user();

        // If it's an employer, load the new employer profile view
        if ($user->role === 'employer') {
            return view('employer.profile', compact('user'));
        }

        // Otherwise, load the standard job seeker profile (with the OCR scanner)
        return view('profile.index', compact('user'));
    }

    public function verifyPwd(Request $request)
    {
        // 1. Validate the uploaded file
        $request->validate([
            'pwd_image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB
        ]);

        $image = $request->file('pwd_image');
        $imageContent = file_get_contents($image->getRealPath());

        // 2. Send the image to OCRSpace API
        // We use asMultipart() because we are uploading a physical file
        $response = Http::asMultipart()->post('https://api.ocr.space/parse/image', [
            [
                'name' => 'apikey',
                'contents' => env('OCR_SPACE_API_KEY')
            ],
            [
                'name' => 'file',
                'contents' => $imageContent,
                'filename' => $image->getClientOriginalName()
            ],
            [
                'name' => 'OCREngine',
                'contents' => '2' // Engine 2 is generally better for ID cards and receipts
            ]
        ]);

        $result = $response->json();

        // 3. Handle API Errors
        if (isset($result['IsErroredOnProcessing']) && $result['IsErroredOnProcessing'] == true) {
            return back()->with('error', 'Could not read the image. Please try a clearer photo.');
        }

        // 4. Extract the text from OCRSpace response
        $parsedText = $result['ParsedResults'][0]['ParsedText'] ?? '';

        if (empty($parsedText)) {
            return back()->with('error', 'No text found in the image. Please try a clearer photo.');
        }

        // 5. The Regex Pattern for RR-PPMM-BBB-NNNNNNN
        // \b     = Word boundary (ensures it's a standalone number)
        // \d{2}  = Exactly 2 digits (Region)
        // \d{4}  = Exactly 4 digits (Province & Municipality)
        // \d{3}  = Exactly 3 digits (Barangay)
        // \d{7}  = Exactly 7 digits (Sequential Number)
        $pattern = '/\b\d{2}-\d{4}-\d{3}-\d{7}\b/';

        // 6. Search the OCR text for the pattern
        if (preg_match($pattern, $parsedText, $matches)) {
            
            // $matches[0] contains the exact ID found in the image (e.g., "07-2230-001-0000123")
            $extractedId = $matches[0]; 

            // 7. Check if this exact ID exists in your mock database
            $isVerified = MockPwdRegistry::where('id_number', $extractedId)->exists();

            if ($isVerified) {
                // Update the user's status
                $user = Auth::user();
                $user->is_pwd = true;
                $user->save();

                return back()->with('success', "Success! PWD ID ($extractedId) has been verified.");
            } else {
                return back()->with('error', "ID number $extractedId was found, but it is not registered in the system.");
            }

        } else {
            // The OCR read the text, but couldn't find a number matching the format
            return back()->with('error', 'Could not locate a valid PWD ID number on the card. Please ensure the ID is clear.');
        }
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}
