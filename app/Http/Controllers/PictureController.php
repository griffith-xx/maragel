<?php

namespace App\Http\Controllers;

use App\Models\Cosmic;
use App\Models\Episode;
use App\Models\Picture;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PictureController extends Controller
{
    public function index($slug, $ep)
    {

        $maxLengthTitle = 50;
        $maxLengthDescription = 150;

        $prefixes = [
            'manga' => 'อ่านมังงะ ',
            'manhwa' => 'อ่านมันฮวา ',
            'manhua' => 'อ่านมันฮัว '
        ];

        $cosmic = Cosmic::where('slug', $slug)->firstOrFail();
        $episodes = Episode::select('number')->where('cosmic_id', $cosmic->id)->get();
        $episode = Episode::where('cosmic_id', $cosmic->id)->where('number', $ep)->first();

        $prevEpisode = Episode::where('cosmic_id', $cosmic->id)
            ->where('number', '<', $episode->number)
            ->orderBy('number', 'desc')
            ->first();

        $nextEpisode = Episode::where('cosmic_id', $cosmic->id)
            ->where('number', '>', $episode->number)
            ->orderBy('number', 'asc')
            ->first();

        $pictures = Picture::where('episode_id', $episode->id)->orderBy('picture_index', 'ASC')->get();

        $prefix = $prefixes[$cosmic->type] ?? '';
        $prefixLength = mb_strlen($prefix);

        $title = $prefix . (mb_strlen($cosmic->title) > $maxLengthTitle - $prefixLength
            ? mb_substr($cosmic->title, 0, $maxLengthTitle - $prefixLength - 3) . '...'
            : $cosmic->title);
        $title .= ' ตอนที่ ' . $ep;

        $description = mb_strlen($cosmic->description) > $maxLengthDescription ? mb_substr($cosmic->description, 0, $maxLengthDescription - 3) . '...' : $cosmic->description;
        $keywords = $cosmic->slug;
        $image_url = $cosmic->image_url;

        return Inertia::render("Picture", [
            'pictures' => $pictures,
            'episodes' => $episodes,
            'prevEpisode' => $prevEpisode,
            'nextEpisode' => $nextEpisode,
            'cosmic_title' => $cosmic->title,
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'image_url' => $image_url,
            'slug' => $cosmic->slug,
            'ep' => $ep,
        ]);
    }
}
