<?php

namespace NinjaPortal\Shadow\Controllers;

use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function change($lang)
    {
        if (in_array($lang, array_keys(config("shadow.locales")))) {
            cookie()->queue(cookie()->forever("lang", $lang));
        }

        return back();
    }
}
