<?php

namespace App\View\Components;

use App\Services\InstagramFeedService;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class InstagramFeed extends Component
{
    public bool $enabled;
    public Collection $items;
    public ?string $username;
    public ?string $instagramUrl;

    public function __construct(
        InstagramFeedService $instagramFeedService,
        public int $limit = 6
    ) {
        $instagram = config('site.current.instagram', []);

        $this->enabled = (bool) ($instagram['enabled'] ?? false);
        $this->username = $instagram['username'] ?? null;
        $this->instagramUrl = $instagram['url'] ?? null;

        $this->items = collect();

        if ($this->enabled) {
            $this->items = $instagramFeedService->getLatestMedia(
                $this->limit
            );
        }
    }

    public function render(): View
    {
        return view('components.instagram-feed');
    }
}
