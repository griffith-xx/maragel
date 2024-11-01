<?php

namespace App\Console\Commands;

use App\Models\Cosmic;
use App\Models\Episode;
use Illuminate\Console\Command;

use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class CreateSitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-sitemap-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Sitemap Command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemaps...');

        if (!is_dir(public_path('/sitemap'))) {
            mkdir(public_path('/sitemap'), 0755, true);
        }

        Sitemap::create()
            ->add(
                Url::create(route('welcome.index'))
                    ->setLastModificationDate(Carbon::yesterday())
            )
            ->writeToFile(public_path('sitemap/sitemap_home.xml'));
        $sitemapIndex =  SitemapIndex::create();
        $sitemapIndex->add(url('sitemap/sitemap_home.xml'));

        $cosmics = Cosmic::get();
        foreach ($cosmics as $cosmic) {
            $sitemap = Sitemap::create();
            $sitemap->add(
                Url::create(route('episode.index', ['slug' => $cosmic->slug]))
                    ->setLastModificationDate($cosmic->updated_at)
            );

            $episodes = Episode::where('cosmic_id', $cosmic->id)->get();

            foreach ($episodes as $episode) {
                $sitemap->add(
                    Url::create(route('picture.index', ['slug' => $cosmic->slug, 'episode' => $episode->number]))
                        ->setLastModificationDate($episode->updated_at)
                );
            }
            $sitemap->writeToFile(public_path('sitemap/' . $cosmic->slug . '.xml'));
            $sitemapIndex->add(url('sitemap/' . $cosmic->slug . '.xml'));
        }
        $sitemapIndex->writeToFile(public_path('sitemap.xml'));
        $this->info('Sitemaps generated successfully!');
    }
}
