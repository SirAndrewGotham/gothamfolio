<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\WorkStatus;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Language;
use App\Models\Work;
use App\Models\WorkTranslation;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function __invoke()
    {
        session()->put('language', config('app.locale'));
        [$works, $tags] = $this->prepareIndex();
        $customers = Customer::all();

        return view('frontend.'.config('gothamfolio.frontend.theme').'.home.index', compact('works', 'customers'));
    }

    public function prepareIndex(): array
    {
//        $languages[] = Language::where('code', app()->getLocale())->first()->id;
//        if (auth()->check()) {
//            $languages = Language::where('id', auth()->user()->language_id)->pluck('id');
//            if (auth()->user()->languages) {
//                $languages = auth()->user()->languages->pluck('id');
//            }
//        }
        $languages = $this->getLanguages();

        $works = WorkTranslation::where(function (Builder $query) {
            $query->where('status', WorkStatus::Published)
                ->where(function (Builder $query) {
                    $query->whereNull('published_at')
                        ->orWhere('published_at', '<=', now());
                })
                ->where(function (Builder $query) {
                    $query->whereNull('published_through')
                        ->orWhere('published_through', '>=', now());
                });
        })
            ->whereIn('language_id', $languages)
//            ->latest()
            ->orderBy('order', 'asc')
            ->with(['tags'])
            ->paginate(10);

        $tags = collect();

        foreach ($works as $work) {
            foreach ($work->tags as $tag) {
                if($tags->doesntContain('id', $tag->id)) {
                    $tags->push($tag);
                }
            }
        }

        return [$works, $tags];
    }
}
