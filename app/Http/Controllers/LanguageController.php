<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function __invoke($lang)
    {
        // Validate if the language is supported
        if (!in_array($lang, ['en', 'np'])) {

            return response()->json([
                'status' => false,
                'message' => 'Unsupported language.',
            ]);
        }

        // Set the locale
        App::setLocale($lang);
        Session::put('applocale', $lang);

        return response()->json([
            'status' => true,
            'message' => 'Language switched successfully.',
        ]);
    }
}
