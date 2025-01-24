<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class LanguageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $locale = $request->locale;
        $languages = Language::pluck('code')->toArray();
        if (!in_array($locale, $languages)) {
            abort(400);
        }

        session()->forget('code');
        Cache::forget('current_language');
        App::setLocale($locale);
        session()->put('code', $locale);

        return redirect()->back();
    }
}
