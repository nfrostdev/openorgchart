@php
    // Custom site configuration variable are stored in the database for persistence, not the .env or docker runtime configuration.
    // Check for custom global site configuration and load them if they aren't present.
    use App\SiteSetting;
    if (!env('SITE_TITLE')) {
        $_ENV['SITE_TITLE'] = SiteSetting::where('name', 'SITE_TITLE')->first()->value;
    }

    if (!env('SITE_COLOR')) {
        $_ENV['SITE_COLOR'] = SiteSetting::where('name', 'SITE_COLOR')->first()->value;
    }
@endphp
