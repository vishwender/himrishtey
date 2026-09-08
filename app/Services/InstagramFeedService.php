<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InstagramFeedService
{
    public function getLatestMedia(int $limit = 6): Collection
    {
        $site = config('site.current', []);
        $instagram = $site['instagram'] ?? [];

        $enabled = (bool) ($instagram['enabled'] ?? false);
        $accessToken = $instagram['access_token'] ?? null;

        if (! $enabled || empty($accessToken)) {
            return collect();
        }

        $siteKey = $site['key'] ?? request()->getHost();

        $cacheKey = 'instagram_feed_' . md5($siteKey);

        $cacheMinutes = (int) config(
            'instagram.cache_minutes',
            60
        );

        return Cache::remember(
            $cacheKey,
            now()->addMinutes($cacheMinutes),
            function () use ($accessToken, $limit) {

                try {

                    $response = Http::timeout(15)
                        ->retry(2, 500)
                        ->get(
                            'https://graph.instagram.com/me/media',
                            [
                                'fields' => implode(',', [
                                    'id',
                                    'caption',
                                    'media_type',
                                    'media_product_type',
                                    'media_url',
                                    'thumbnail_url',
                                    'permalink',
                                    'timestamp',
                                ]),

                                'limit' => $limit,

                                'access_token' => $accessToken,
                            ]
                        );

                    if ($response->failed()) {

                        Log::warning('Instagram API request failed', [
                            'status' => $response->status(),
                            'body' => $response->body(),
                        ]);

                        return collect();
                    }

                    return collect(
                        $response->json('data', [])
                    );
                } catch (\Throwable $e) {

                    Log::warning('Instagram feed exception', [
                        'message' => $e->getMessage(),
                    ]);

                    return collect();
                }
            }
        );
    }

    public function clearCache(): void
    {
        $site = config('site.current', []);

        $siteKey = $site['key'] ?? request()->getHost();

        Cache::forget(
            'instagram_feed_' . md5($siteKey)
        );
    }
}
