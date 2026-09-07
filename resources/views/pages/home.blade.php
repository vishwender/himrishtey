 <!doctype html>
 <html lang="en" data-site="{{ $siteKey }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width,initial-scale=1">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <script>
         try {
             const savedTheme = localStorage.getItem('site-theme') || localStorage.getItem('public-theme') || (matchMedia('(prefers-color-scheme:dark)').matches ? 'dark' : 'light');
             document.documentElement.dataset.theme = savedTheme;
         } catch (e) {}
     </script>
     <title>{{ $siteName }} — Find someone who feels like home</title>
     <meta name="description" content="Meaningful connections. Genuine profiles. A simple way to find your life partner.">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
     @vite(['resources/css/home/home.css', 'resources/js/home.js'])
 </head>

 <body class="public-site tenant-{{ \Illuminate\Support\Str::slug($siteKey) }}" style="
        --site-primary: {{ $sitePrimaryColor }};
        --site-secondary: {{ $siteSecondaryColor }};
        --site-accent: {{ $siteAccentColor }};
        --brand: {{ $sitePrimaryColor }};
        --deep: {{ $siteSecondaryColor }};
        --gold: {{ $siteAccentColor }};
    ">
     @include('partials.public-header')
     <main>
         <section class="hero" style="background-image: url('{{ asset($siteHeroBackground) }}');">
             <div class="hero-copy">
                 <h1>Find someone<br><em>who feels like home.</em></h1>
                 <p>Meaningful connections. Genuine profiles.<br>A simple way to find your life partner.</p>
                 <div class="hero-buttons">
                     <a class="solid public-cta public-cta-primary" href="#matches">
                         <i data-lucide="heart" aria-hidden="true"></i>Find Matches
                     </a>
                     <a class="outline public-cta public-cta-secondary" href="{{ route('login-form') }}#register">
                         <i data-lucide="user-plus" aria-hidden="true"></i>Register Free
                     </a>
                 </div>
                 <div class="trusted">
                     <span class="mini-faces">
                         <i></i>
                         <i></i>
                         <i></i>
                     </span>
                     <small>Trusted by thousands of<br>happy members <i data-lucide="heart" aria-hidden="true"></i></small>
                 </div>
             </div>
         </section>

         <form class="finder" id="search" action="{{ auth('member')->check() ? route('search-results') : route('login-form') . '#register' }}" method="get">
             @auth('member')
             <input type="hidden" name="_source" value="advanced">
             @endauth
             <label for="lookingFor">
                 <span>Looking for</span>
                 <span class="finder-control">
                     <i data-lucide="user-search" aria-hidden="true"></i>
                     <select id="lookingFor" name="looking_for">
                         <option value="Female">Bride</option>
                         <option value="Male">Groom</option>
                     </select>
                 </span>
             </label>
             <label for="ageFrom">
                 <span>Age</span>
                 <span class="finder-control">
                     <i data-lucide="calendar-range" aria-hidden="true"></i>
                     <span class="finder-age-fields">
                         <select id="ageFrom" name="partner_age_from" aria-label="Minimum age">
                             @for ($age = 18; $age <= 70; $age++)
                                 <option value="{{ $age }}" @selected($age===24)>{{ $age }}</option>
                                 @endfor
                         </select>
                         <span aria-hidden="true">to</span>
                         <select id="ageTo" name="partner_age_to" aria-label="Maximum age">
                             @for ($age = 18; $age <= 70; $age++)
                                 <option value="{{ $age }}" @selected($age===30)>{{ $age }}</option>
                                 @endfor
                         </select>
                     </span>
                 </span>
             </label>
             <label for="partnerReligion">
                 <span>Religion</span>
                 <span class="finder-control">
                     <i data-lucide="landmark" aria-hidden="true"></i>
                     <select id="partnerReligion" name="partner_religion">
                         <option value="">Any</option>
                         <option value="Hindu">Hindu</option>
                         <option value="Sikh">Sikh</option>
                         <option value="Christian">Christian</option>
                         <option value="Buddhist">Buddhist</option>
                         <option value="Muslim">Muslim</option>
                     </select>
                 </span>
             </label>
             <label for="stateName">
                 <span>Location</span>
                 <span class="finder-control">
                     <i data-lucide="map-pin" aria-hidden="true"></i>
                     <select id="stateName" name="state_name">
                         <option value="">Any</option>
                         <option value="Himachal Pradesh">Himachal Pradesh</option>
                         <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                         <option value="Punjab">Punjab</option>
                         <option value="Chandigarh">Chandigarh</option>
                         <option value="Delhi">Delhi</option>
                         <option value="Uttarakhand">Uttarakhand</option>
                     </select>
                 </span>
             </label>
             <button class="public-cta public-cta-primary" type="submit">
                 <i data-lucide="search" aria-hidden="true"></i>
                 <span>Search Matches</span>
             </button>
         </form>

         <section class="trust-strip">
             <article><i data-lucide="badge-check" aria-hidden="true"></i>
                 <div><b>100% Verified Profiles</b><small>Manually verified for your safety</small></div>
             </article>
             <article><i data-lucide="shield-check" aria-hidden="true"></i>
                 <div><b>Secure &amp; Private</b><small>Your privacy is our priority</small></div>
             </article>
             <article><i data-lucide="users" aria-hidden="true"></i>
                 <div><b>Thousands of Matches</b><small>New matches every day</small></div>
             </article>
             <article><i data-lucide="headset" aria-hidden="true"></i>
                 <div><b>24/7 Customer Support</b><small>We are here to help you</small></div>
             </article>
         </section>

         @if($featuredProfiles->isNotEmpty())
         <section class="matches wrap" id="matches">
             <h2>Meet our verified members</h2>
             <div class="ornament"><i data-lucide="heart" aria-hidden="true"></i></div>
             <div class="cards">
                 @foreach($featuredProfiles as $profile)
                 @php
                 $photoPath = 'photos/photo/' . basename($profile->photo);
                 $photoOrigin = config('site.sites')[$siteKey]['app_url'] ?? config('app.url');
                 $photoUrl = is_file(public_path($photoPath))
                 ? asset($photoPath)
                 : rtrim($photoOrigin, '/') . '/' . $photoPath;
                 @endphp
                 <article class="profile-card">
                     <div class="profile-photo">
                         <img src="{{ $photoUrl }}" alt="{{ $profile->full_name }}" loading="lazy">
                         <span>● Verified</span>
                     </div>
                     <div>
                         <b>{{ $profile->full_name }}@if($profile->age), {{ $profile->age }}@endif</b>
                         <small>{{ $profile->city_living_in }}<br>{{ $profile->occupation }}</small>
                     </div>
                 </article>
                 @endforeach
             </div><a class="more outline public-cta public-cta-secondary" href="{{ route('login-form') }}#register">View More Profiles</a>
         </section>
         @endif

         <section class="split wrap">
             <article class="how" id="how">
                 <h2>How it works</h2>
                 <div class="ornament"><i data-lucide="heart" aria-hidden="true"></i></div>
                 <div class="three">
                     <div>
                         <i data-lucide="user-round-plus" aria-hidden="true"></i>
                         <b>1. Create Your Profile</b>
                         <small>Sign up and create your profile in just a few minutes.</small>
                     </div>
                     <div>
                         <i data-lucide="search" aria-hidden="true"></i>
                         <b>2. Discover Matches</b>
                         <small>Get matched with compatible profiles tailored for you.</small>
                     </div>
                     <div>
                         <i data-lucide="messages-square" aria-hidden="true"></i>
                         <b>3. Start a Conversation</b>
                         <small>Connect, chat and take the first step towards a beautiful journey.</small>
                     </div>
                 </div>
             </article>
             <article class="why">
                 <h2>Why choose {{ $siteName }}?</h2>
                 <div class="ornament"><i data-lucide="heart" aria-hidden="true"></i></div>
                 <div class="why-grid">
                     <p><i data-lucide="badge-check" aria-hidden="true"></i><span><b>Verified &amp; Genuine</b><small>Every profile is manually verified</small></span></p>
                     <p><i data-lucide="eye-off" aria-hidden="true"></i><span><b>Privacy Controls</b><small>You are in control of your privacy</small></span></p>
                     <p><i data-lucide="sparkles" aria-hidden="true"></i><span><b>Smart Matching</b><small>Advanced matching for better connections</small></span></p>
                     <p><i data-lucide="users-round" aria-hidden="true"></i><span><b>Community Focused</b><small>Find matches from your community</small></span></p>
                     <p><i data-lucide="shield-check" aria-hidden="true"></i><span><b>Secure Contact Access</b><small>Connect only when comfortable</small></span></p>
                     <p><i data-lucide="headset" aria-hidden="true"></i><span><b>Dedicated Support</b><small>Friendly support whenever needed</small></span></p>
                 </div>
             </article>
         </section>

         <section class="stories wrap" id="stories">
             <h2>Real stories. Real happiness.</h2>
             <div class="ornament"><i data-lucide="heart" aria-hidden="true"></i></div>
             <div class="story-grid">
                 <article><img src="{{ asset('uploads/success-stories/story_1785477068_6a6c37cc05b8a.jpeg') }}" alt="Happy couple">
                     <div><b>Pooja &amp; Ankush</b><strong>Shimla, Himachal Pradesh</strong>
                         <p>“We met on {{ $siteName }} and instantly connected. Today, we are happily building our future together.”</p><small><i data-lucide="heart" aria-hidden="true"></i> Married on 12th Feb 2024</small>
                     </div>
                 </article>
                 <article><img src="{{ asset('uploads/gallery/photo_1787825379_6a900ce3763a3.jpeg') }}" alt="Happy couple">
                     <div><b>Megha &amp; Saurav</b><strong>Kangra, Himachal Pradesh</strong>
                         <p>“Thanks to {{ $siteName }}, we found not just a life partner but a best friend for life.”</p><small><i data-lucide="heart" aria-hidden="true"></i> Married on 5th Nov 2023</small>
                     </div>
                 </article>
             </div><a class="more outline public-cta public-cta-secondary" href="{{ route('success-stories') }}">Read More Success Stories</a>
         </section>

         <section class="communities wrap">
             <h2>Explore by community</h2>
             <div class="community-grid">@foreach(['Himachali Matches','Jammu Matches','Kangra Matches','Kullu Matches','Professionals','Recently Joined'] as $i=>$community)<a href="{{ route('login-form') }}#register" style="--bg:url('{{ asset(['assets/images/hero-devbhoomi.jpg','assets/images/hero-dogri.jpg','assets/images/hero-himrishtey.jpg','assets/images/hero-gallpakki.jpg','uploads/gallery/photo_1787814410_6a8fe20a0ead2.jpeg','uploads/gallery/photo_1787743596_6a8ecd6ccb322.jpg'][$i]) }}')"><b>{{ $community }}</b></a>@endforeach</div>
         </section>

         <section class="app-cta">
             <div class="phone"><i data-lucide="smartphone" aria-hidden="true"></i><small>{{ $siteName }}</small></div>
             <div>
                 <h2>Take the next step towards<br>your happily ever after.</h2>
                 <p>Create your free profile today and start your journey.</p>
             </div>
             @if($siteAndroidAppUrl)
             <a class="store" href="{{ $siteAndroidAppUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Download {{ $siteName }} from Google Play">
                 <svg class="store-icon play-icon" viewBox="0 0 28 31" aria-hidden="true">
                     <path fill="#00d4ff" d="M2 2.2 16.3 15.5 2 28.8c-.6-.7-1-1.7-1-2.9V5.1c0-1.2.4-2.2 1-2.9Z" />
                     <path fill="#00e676" d="m2.8 1.5 17.5 10-4 4L2 2.2c.2-.3.5-.5.8-.7Z" />
                     <path fill="#ffcf3f" d="m16.3 15.5 4-4 5.1 2.9c1.5.8 1.5 2.3 0 3.2l-5.1 2.9-4-5Z" />
                     <path fill="#ff4b55" d="m2 28.8 14.3-13.3 4 5L2.8 29.5c-.3-.2-.6-.4-.8-.7Z" />
                 </svg>
                 <span>Get it on<b>Google Play</b></span>
             </a>
             @endif @if($siteIosAppUrl)
             <a class="store" href="{{ $siteIosAppUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Download {{ $siteName }} from the Apple App Store">
                 <svg class="store-icon apple-icon" viewBox="0 0 24 24" aria-hidden="true">
                     <path fill="currentColor" d="M17.1 12.5c0-2.6 2.1-3.9 2.2-4-1.2-1.8-3.1-2-3.8-2-1.6-.2-3.1.9-3.9.9-.8 0-2-1-3.4-.9-1.7 0-3.4 1-4.3 2.6-1.9 3.2-.5 8 1.3 10.6.9 1.3 1.9 2.7 3.3 2.6 1.3-.1 1.8-.8 3.4-.8 1.6 0 2 .8 3.4.8 1.4 0 2.3-1.3 3.2-2.6 1-1.5 1.5-3 1.5-3.1-.1 0-2.9-1.1-2.9-4.1ZM14.4 4.8c.7-.9 1.2-2.1 1.1-3.3-1.1.1-2.4.7-3.2 1.6-.7.8-1.3 2-1.1 3.2 1.2.1 2.4-.6 3.2-1.5Z" />
                 </svg>
                 <span>Download on the<b>App Store</b></span>
             </a>
             @endif
             <a class="cta-white public-cta public-cta-primary" href="{{ route('login-form') }}#register">Create Free Profile
                 <i class="cta-profile-icon" data-lucide="user-plus" aria-hidden="true"></i>
             </a>
         </section>
     </main>

     @include('partials.public-footer')
 </body>

 </html>