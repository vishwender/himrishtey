@php
$instagram = config('site.current.instagram', []);

$enabled = (bool) ($instagram['enabled'] ?? false);
$username = $instagram['username'] ?? null;
$instagramUrl = $instagram['url'] ?? null;

$items = collect();

if ($enabled) {
$items = app(\App\Services\InstagramFeedService::class)
->getLatestMedia($limit ?? 6);
}
@endphp

@if($enabled)
<section class="instagram-feed">

    <div class="instagram-feed__header">
        <div>
            <span class="instagram-feed__eyebrow">
                Follow us on Instagram
            </span>

            <h2>Latest from Instagram</h2>
        </div>

        <a
            href="{{ $instagramUrl }}"
            target="_blank"
            rel="noopener noreferrer"
            class="instagram-feed__follow">
            <svg
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                aria-hidden="true">
                <rect
                    x="3"
                    y="3"
                    width="18"
                    height="18"
                    rx="5"
                    stroke="currentColor"
                    stroke-width="2" />

                <circle
                    cx="12"
                    cy="12"
                    r="4"
                    stroke="currentColor"
                    stroke-width="2" />

                <circle
                    cx="17.5"
                    cy="6.5"
                    r="1"
                    fill="currentColor" />
            </svg>

            {{ $username ? '@' . $username : 'Instagram' }}
        </a>
    </div>

    @if($items->isNotEmpty())

    <div class="instagram-feed__grid">

        @foreach($items as $item)

        @php
        $mediaType = $item['media_type'] ?? '';
        $productType = $item['media_product_type'] ?? '';

        $isReel =
        $mediaType === 'VIDEO'
        && $productType === 'REELS';

        $image =
        $item['thumbnail_url']
        ?? $item['media_url']
        ?? null;
        @endphp

        @if($image)

        <a
            href="{{ $item['permalink'] ?? '#' }}"
            target="_blank"
            rel="noopener noreferrer"
            class="instagram-feed__card">

            <img
                src="{{ $image }}"
                alt="{{ \Illuminate\Support\Str::limit(
                                    strip_tags($item['caption'] ?? 'Instagram post'),
                                    80
                                ) }}"
                loading="lazy">

            @if($isReel)

            <span class="instagram-feed__play">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    aria-hidden="true">
                    <path d="M8 5v14l11-7z" />
                </svg>
            </span>

            @endif

        </a>

        @endif

        @endforeach

    </div>

    @else

    <div class="instagram-feed__empty">
        Instagram posts are temporarily unavailable.
    </div>

    @endif

</section>
@endif