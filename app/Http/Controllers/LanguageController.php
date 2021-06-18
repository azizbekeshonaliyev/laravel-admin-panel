<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Domain\Language\Entities\Language;

/**
 * Class LanguageController.
 */
class LanguageController extends Controller
{
    /**
     * @param $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function swap($locale)
    {
        if (! $languages = Cache::get('languages')) {
            $languages = Language::orderBy('rank', 'asc')->get();
            Cache::put('languages', $languages);
        }
        $languages = $languages->pluck('locale')->toArray();

        if (in_array($locale, $languages)) {
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }

    public function convertor()
    {
        $locale = 'en';
        $folder_path = "\\$locale\\";
        $files = Storage::disk('locale')->files($folder_path);
        $locales_nested = [];
        foreach ($files as $file) {
            $key = basename($file, '.php');
            $locales_nested[$key] = require resource_path('lang\\'.$file);
        }
        $locales = Arr::dot($locales_nested);

        dd($locales);
    }

    public function saveToFile()
    {
        $locale = 'en';
        $folder_path = "\\$locale\\";
        dd($locale);
        $data = [
            'keys.ismlar.azizbek' => 'Shaxzodbek',
        ];
        $nested_locales = [];
        foreach ($data as $key => $value) {
            Arr::set($nested_locales, $key, $value);
        }
        foreach ($nested_locales as $file_name => $value) {
            $file = Storage::disk('locale')->put("$folder_path\\$file_name.php", '<?php return '.var_export($value, true).';');
        }
    }
}
