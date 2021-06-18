<?php

namespace App\Http\Controllers\Backend\Language;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Domain\Language\Entities\Language;
use Illuminate\Support\Facades\Storage;
use App\Http\Responses\RedirectResponse;
use Domain\Language\Entities\Translation;
use App\Domain\Language\Service\LanguageService;
use App\Domain\Language\Service\TranslationService;
use App\Domain\Language\Requests\LanguageStoreRequest;
use App\Domain\Language\Requests\LanguageUpdateRequest;

class LanguageController extends Controller
{
    private $languageService;

    private $translationService;

    private $view_location = 'backend.languages.';

    public function __construct(LanguageService $languageService, TranslationService $translationService)
    {
        $this->languageService = $languageService;
        $this->translationService = $translationService;
    }

    public function index(Request $request)
    {
        $languages = $this->languageService->findAll($request->all());

        $languages = $languages->paginate();

        return view($this->view_location.'index', [
            'languages' => $languages,
        ]);
    }

    public function create()
    {
        return view($this->view_location.'create');
    }

    public function store(LanguageStoreRequest $request)
    {
        $this->languageService->create($request->except(['_token', '_method']));

        $languages = $this->languageService->findAll([])->get();

        cache()->put('languages', $languages);

        return new RedirectResponse(route('admin.languages.index'), ['flash_success' => __('alerts.backend.languages.created')]);
    }

    public function show($id)
    {
        //
    }

    public function edit(Language $language)
    {
        return view($this->view_location.'edit', [
            'language' => $language,
        ]);
    }

    public function update(LanguageUpdateRequest $request, Language $language)
    {
        $this->languageService->update($language, $request->except(['_token', '_method']));

        $languages = $this->languageService->findAll([])->get();

        cache()->put('languages', $languages);

        return new RedirectResponse(route('admin.languages.index'), ['flash_success' => __('alerts.backend.languages.updated')]);
    }

    public function destroy(Language $language)
    {
        $this->languageService->delete($language);

        return new RedirectResponse(route('admin.languages.index'), ['flash_success' => __('alerts.backend.languages.deleted')]);
    }

    public function loadFromFile(Language $language)
    {
        $locale = $language->locale;
        $folder_path = "\\$locale\\";

        $files = Storage::disk('locale')->files($folder_path);
        $locales_nested = [];

        foreach ($files as $file) {
            $path = resource_path('lang\\'.$file);

            if (config('app.env') === 'production') {
                $path = str_replace('\\', '/', $path);
            }
            $key = basename($file, '.php');
            $locales_nested[$key] = require $path;
        }

        $locales = Arr::dot($locales_nested);

        foreach ($locales as $key => $value) {
            Translation::create([
                'locale' => $language->locale,
                'key' => $key,
                'value' => $value,
            ]);
        }

        return new RedirectResponse(route('admin.languages.index'), ['flash_success' => __('alerts.backend.languages.created')]);
    }

    public function writeToFile(Language $language)
    {
        $locale = $language->locale;
        $folder_path = "\\$locale\\";
        $data = $this->translationService->findAll(['locale' => $language->locale])->get()->pluck('value', 'key');
        $nested_locales = [];
        foreach ($data as $key => $value) {
            Arr::set($nested_locales, $key, $value);
        }
        foreach ($nested_locales as $file_name => $value) {
            $file = Storage::disk('locale')->put("$folder_path\\$file_name.php", '<?php return '.var_export($value, true).';');
        }

        return new RedirectResponse(route('admin.languages.index'), ['flash_success' => __('alerts.backend.languages.created')]);
    }

    public function refresh(Language $language)
    {
        $translations = Translation::distinct('key')->get()->pluck('value', 'key');

        foreach ($translations as $key => $value) {
            Translation::updateOrCreate(
                [
                    'locale' => $language->locale,
                    'key' => $key,
                ],
                [
                    'value' => $value,
                ]
            );
        }

        return new RedirectResponse(route('admin.languages.index'), ['flash_success' => __('alerts.backend.languages.created')]);
    }

    public function translationsEdit(Language $language)
    {
        return view($this->view_location.'translation', [
            'language' => $language,
        ]);
    }

    public function translationsStore(Request $request)
    {
        if (isset($request['value'])) {
            foreach ($request['value'] as $key => $value) {
                DB::table('translations')->where('id', $key)->update(['value' => $value]);
            }
        }

        return new RedirectResponse(route('admin.languages.index'), ['flash_success' => __('alerts.backend.languages.created')]);
    }

    public function getTranslations(Language $language)
    {
        $translations = $this->translationService->findAll(['locale' => $language->locale])
            ->latest()
            ->get();

        return response()->json([
            'translations' => $translations,
        ]);
    }

    public function translationUpdate(Request $request, Translation $translation)
    {
        $translation->update([
            'value' => $request->value,
        ]);

        return response()->json([
            'message' => 'Successfully updated',
        ]);
    }
}
