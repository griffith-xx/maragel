<?php

namespace App\Http\Controllers;

use App\Models\Cosmic;
use App\Models\Episode;
use Inertia\Inertia;

class EpisodeController extends Controller
{
    public function index($slug)
    {

        $maxLengthTitle = 50;
        $maxLengthDescription = 150;

        $prefixes = [
            'manga' => 'อ่านมังงะ ',
            'manhwa' => 'อ่านมันฮวา ',
            'manhua' => 'อ่านมันฮัว '
        ];

        $cosmic = Cosmic::where('slug', $slug)->firstOrFail();
        $episodes = Episode::where('cosmic_id', $cosmic->id)->orderByRaw('CAST(number AS UNSIGNED) DESC')->get();

        $prefix = $prefixes[$cosmic->type] ?? '';
        $prefixLength = mb_strlen($prefix);

        $title = $prefix . (mb_strlen($cosmic->title) > $maxLengthTitle - $prefixLength
            ? mb_substr($cosmic->title, 0, $maxLengthTitle - $prefixLength - 3) . '...'
            : $cosmic->title);
        $description = mb_strlen($cosmic->description) > $maxLengthDescription ? mb_substr($cosmic->description, 0, $maxLengthDescription - 3) . '...' : $cosmic->description;
        $keywords = $cosmic->slug;
        $image_url = $cosmic->image_url;

        return Inertia::render("Episode", [
            'episodes' => $episodes,
            'title' => $title,
            'description' => $description,
            'cosmic' => $cosmic,
        ]);
    }
}
