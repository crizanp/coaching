<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [
            [
                'loc' => url('/'),
                'lastmod' => now()->toISOString(),
                'changefreq' => 'weekly',
                'priority' => '1.0'
            ],
            [
                'loc' => url('/about'),
                'lastmod' => now()->toISOString(),
                'changefreq' => 'monthly',
                'priority' => '0.9'
            ],
            [
                'loc' => url('/practices'),
                'lastmod' => now()->toISOString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => url('/events'),
                'lastmod' => now()->toISOString(),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ],
            [
                'loc' => url('/contact'),
                'lastmod' => now()->toISOString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => url('/testimonials'),
                'lastmod' => now()->toISOString(),
                'changefreq' => 'monthly',
                'priority' => '0.6'
            ],
        ];

        // Add multilingual versions
        $multilingualUrls = [];
        foreach ($urls as $url) {
            $multilingualUrls[] = $url;
            $multilingualUrls[] = [
                'loc' => $url['loc'] . '?lang=en',
                'lastmod' => $url['lastmod'],
                'changefreq' => $url['changefreq'],
                'priority' => $url['priority']
            ];
            $multilingualUrls[] = [
                'loc' => $url['loc'] . '?lang=fr',
                'lastmod' => $url['lastmod'],
                'changefreq' => $url['changefreq'],
                'priority' => $url['priority']
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($multilingualUrls as $url) {
            $xml .= '  <url>' . PHP_EOL;
            $xml .= '    <loc>' . htmlspecialchars($url['loc']) . '</loc>' . PHP_EOL;
            $xml .= '    <lastmod>' . $url['lastmod'] . '</lastmod>' . PHP_EOL;
            $xml .= '    <changefreq>' . $url['changefreq'] . '</changefreq>' . PHP_EOL;
            $xml .= '    <priority>' . $url['priority'] . '</priority>' . PHP_EOL;
            $xml .= '  </url>' . PHP_EOL;
        }

        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }
}