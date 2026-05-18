<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Team;
use App\Models\WebsiteParameter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SeoController extends Controller
{
    private const CACHE_TTL = 3600;

    private const CACHE_KEY = 'seo.catalog.v1';

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function buildCatalog(): array
    {
        $items = [];
        $lan = config('app.locale', 'en');
        $wp = WebsiteParameter::query()->orderByDesc('id')->first();
        if (! $wp) {
            return [];
        }

        $push = function (
            string $loc,
            $lastmod = null,
            string $priority = '0.5',
            string $changefreq = 'weekly',
            ?string $title = null,
            ?string $description = null,
            string $type = 'page',
            ?string $image = null
        ) use (&$items) {
            $loc = $this->normalizeUrl($loc);
            if (! $loc) {
                return;
            }
            $items[] = [
                'loc' => $loc,
                'lastmod' => $lastmod,
                'priority' => $priority,
                'changefreq' => $changefreq,
                'title' => $title,
                'description' => $description ? Str::limit(strip_tags((string) $description), 300) : null,
                'type' => $type,
                'image' => $image ? $this->absoluteUrl((string) $image) : null,
            ];
        };

        $push(url('/'), $wp->updated_at ?? now(), '1.0', 'daily', $wp->title ?? null, $wp->meta_description, 'home', asset($wp->logo()));

        $static = [
            ['route' => 'user.categories', 'params' => [], 'p' => '0.7', 't' => 'Categories', 'd' => $wp->meta_description],
            ['route' => 'user.contactUs', 'params' => [], 'p' => '0.7', 't' => 'Contact', 'd' => null],
            ['route' => 'user.career', 'params' => [], 'p' => '0.6', 't' => 'Career', 'd' => null],
            ['route' => 'user.teams', 'params' => [], 'p' => '0.7', 't' => 'Featured projects', 'd' => null],
            ['route' => 'allbrochures', 'params' => [], 'p' => '0.6', 't' => 'Brochures', 'd' => null],
            ['route' => 'donateNow', 'params' => [], 'p' => '0.5', 't' => 'Donate', 'd' => null],
            ['route' => 'wantToKnowAboutProjects', 'params' => [], 'p' => '0.5', 't' => 'Projects info', 'd' => null],
            ['route' => 'customerReviews', 'params' => [], 'p' => '0.6', 't' => 'Customer reviews', 'd' => null],
            ['route' => 'landownerReviews', 'params' => [], 'p' => '0.6', 't' => 'Landowner reviews', 'd' => null],
            ['route' => 'donation.track.page', 'params' => [], 'p' => '0.4', 't' => 'Track donation', 'd' => null],
            ['route' => 'user.companyProfile', 'params' => [], 'p' => '0.6', 't' => 'Company profile', 'd' => null],
            ['route' => 'user.aboutUs', 'params' => [], 'p' => '0.6', 't' => 'About us', 'd' => null],
            ['route' => 'user.details', 'params' => [], 'p' => '0.5', 't' => 'Details', 'd' => null],
        ];

        foreach ($static as $row) {
            if (! \Illuminate\Support\Facades\Route::has($row['route'])) {
                continue;
            }
            try {
                $url = route($row['route'], $row['params']);
                $push($url, null, $row['p'], 'weekly', $row['t'], $row['d'], 'static');
            } catch (\Throwable $e) {
                continue;
            }
        }

        if (\Illuminate\Support\Facades\Route::has('allNews')) {
            try {
                $url = route('allNews', ['lan' => $lan]);
                $push($url, null, '0.6', 'daily', 'News', $wp->meta_description ?? null, 'listing');
            } catch (\Throwable $e) {
                // optional route params
            }
        }

        foreach (Category::query()->orderBy('drag_id')->get() as $category) {
            try {
                $url = route('user.categoryDetails', $category);
                $name = is_string($category->name) ? $category->name : (string) ($category->name ?? 'Category');
                $desc = $category->description ?? null;
                $push($url, $category->updated_at ?? null, '0.8', 'weekly', $name, $desc ? strip_tags($desc) : null, 'category', asset($wp->logo()));
            } catch (\Throwable $e) {
                continue;
            }
        }

        foreach (SubCategory::query()->orderBy('id')->get() as $sub) {
            try {
                $url = route('user.subcategoryDetails', $sub);
                $name = is_string($sub->name) ? $sub->name : ($sub->name ?? 'Subcategory');
                $push($url, $sub->updated_at ?? null, '0.65', 'weekly', $name, null, 'subcategory', asset($wp->logo()));
            } catch (\Throwable $e) {
                continue;
            }
        }

        foreach (Page::query()->where('active', true)->orderBy('drag_id')->get() as $page) {
            try {
                $url = route('user.pageDetails', ['url' => $page->slug, 'page' => $page->id]);
                $pageDesc = $page->meta_description ?? Str::limit(strip_tags($page->content ?? ''), 200);
                $push(
                    $url,
                    $page->updated_at ?? null,
                    '0.6',
                    'monthly',
                    $page->page_title,
                    $pageDesc ?: null,
                    'page',
                    asset($wp->logo())
                );
            } catch (\Throwable $e) {
                continue;
            }
        }

        foreach (Post::query()->where('publish_status', 'published')->orderByDesc('updated_at')->get() as $post) {
            try {
                $url = route('user.postDetails', ['post' => $post, 'slug' => $post->slug]);
                $excerpt = $post->excerpt ?? $post->description ?? null;
                $push(
                    $url,
                    $post->updated_at ?? null,
                    '0.75',
                    'weekly',
                    strip_tags((string) $post->title),
                    $excerpt ? strip_tags((string) $excerpt) : null,
                    'post',
                    asset('storage/media/image/'.$post->fi())
                );
            } catch (\Throwable $e) {
                continue;
            }
        }

        foreach (Team::query()->where('status', 1)->orderByRaw('drag_id IS NULL, drag_id ASC')->get() as $team) {
            if (empty($team->username)) {
                continue;
            }
            try {
                $url = route('team.show', $team->username);
                $push($url, $team->updated_at ?? null, '0.55', 'monthly', $team->name, Str::limit(strip_tags($team->bio ?? ''), 200), 'team', $team->image ? $team->imageUrl() : asset($wp->logo()));
            } catch (\Throwable $e) {
                continue;
            }
        }

        // De-duplicate by URL (keep richest lastmod)
        $byLoc = [];
        foreach ($items as $it) {
            $loc = $it['loc'];
            if (! isset($byLoc[$loc]) || ($it['lastmod'] && (! $byLoc[$loc]['lastmod'] || $it['lastmod'] > $byLoc[$loc]['lastmod']))) {
                $byLoc[$loc] = $it;
            }
        }

        return array_values($byLoc);
    }

    protected function getCatalog(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return $this->buildCatalog();
        });
    }

    public function sitemap()
    {
        $catalog = $this->getCatalog();
        $lines = ['<?xml version="1.0" encoding="UTF-8"?>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'];

        foreach ($catalog as $row) {
            $lines[] = '  <url>';
            $lines[] = '    <loc>'.e($row['loc']).'</loc>';
            if (! empty($row['lastmod'])) {
                $lines[] = '    <lastmod>'.Carbon::parse($row['lastmod'])->toAtomString().'</lastmod>';
            }
            $lines[] = '    <changefreq>'.e($row['changefreq']).'</changefreq>';
            $lines[] = '    <priority>'.e($row['priority']).'</priority>';
            if (! empty($row['image']) && ($row['type'] === 'post' || $row['type'] === 'team')) {
                $lines[] = '    <image:image>';
                $lines[] = '      <image:loc>'.e($row['image']).'</image:loc>';
                if (! empty($row['title'])) {
                    $lines[] = '      <image:title>'.e(Str::limit(strip_tags($row['title']), 100)).'</image:title>';
                }
                $lines[] = '    </image:image>';
            }
            $lines[] = '  </url>';
        }

        $lines[] = '</urlset>';
        $xml = implode("\n", $lines);

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots(Request $request)
    {
        $sitemap = route('seo.sitemap');
        $aiMap = route('seo.aiSitemap');
        $body = "User-agent: *\n";
        $body .= "Disallow: /admin\n";
        $body .= "Disallow: /login\n";
        $body .= "Disallow: /password\n";
        $body .= "Disallow: /home\n";
        $body .= "Allow: /\n\n";
        $body .= "Sitemap: {$sitemap}\n";
        $body .= "Sitemap: {$aiMap}\n";
        $body .= "\n# For AI agents / research crawlers\n";
        $body .= "# See: ".route('seo.llmsTxt')."\n";

        return response($body, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function llmsTxt()
    {
        $wp = WebsiteParameter::query()->orderByDesc('id')->first();
        if (! $wp) {
            return response('# Site', 200)->header('Content-Type', 'text/plain; charset=UTF-8');
        }
        $catalog = $this->getCatalog();
        $home = url('/');

        $lines = [];
        $lines[] = '# '.($wp->h1 ?? $wp->title ?? config('app.name'));
        $lines[] = '';
        $lines[] = '> '.Str::limit(strip_tags($wp->meta_description ?? ''), 500);
        $lines[] = '';
        $lines[] = '## Site';
        $lines[] = '- [Home]('.$home.')';
        $lines[] = '';
        $lines[] = '## Sitemaps & machine-readable discovery';
        $lines[] = '- [XML Sitemap]('.route('seo.sitemap').')';
        $lines[] = '- [AI / visual content map (JSON)]('.route('seo.aiSitemap').')';
        $lines[] = '';
        $lines[] = '## Main pages';
        foreach (array_slice($catalog, 0, 80) as $row) {
            if (empty($row['title'])) {
                continue;
            }
            $lines[] = '- ['.str_replace(['[', ']'], '', strip_tags($row['title'])).']('.$row['loc'].')';
        }
        $lines[] = '';
        $lines[] = '## Note';
        $lines[] = 'This file helps AI systems and research crawlers understand public pages on this site.';

        $text = implode("\n", $lines);

        return response($text, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function aiSitemap()
    {
        $wp = WebsiteParameter::query()->orderByDesc('id')->first();
        $catalog = $this->getCatalog();
        if (! $wp) {
            return response()->json(['version' => '1.0', 'pages' => []], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }

        $payload = [
            'version' => '1.0',
            'generated_at' => now()->toIso8601String(),
            'site' => [
                'name' => $wp->h1 ?? $wp->title ?? config('app.name'),
                'legal_name' => $wp->title,
                'url' => url('/'),
                'description' => Str::limit(strip_tags($wp->meta_description ?? ''), 500),
                'logo' => $this->absoluteUrl(asset($wp->logo())),
                'locale' => config('app.locale', 'en'),
            ],
            'discovery' => [
                'sitemap_xml' => route('seo.sitemap'),
                'llms_txt' => route('seo.llmsTxt'),
            ],
            'pages' => array_map(function ($row) {
                return [
                    'url' => $row['loc'],
                    'title' => $row['title'] ? strip_tags($row['title']) : null,
                    'description' => $row['description'],
                    'type' => $row['type'],
                    'image' => $row['image'],
                    'priority' => (float) $row['priority'],
                ];
            }, $catalog),
        ];

        return response()->json($payload, 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    protected function normalizeUrl(string $url): string
    {
        $url = trim($url);
        if ($url === '') {
            return '';
        }

        return $url;
    }

    protected function absoluteUrl(string $url): string
    {
        $url = trim($url);
        if (Str::startsWith($url, ['http://', 'https://'])) {
            return $url;
        }

        return url($url);
    }
}
