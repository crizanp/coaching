<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach($blogs as $blog)
    <url>
    <loc>{{ route('blog.show', ['locale' => 'fr', 'blog' => $blog->slug]) }}</loc>
        <lastmod>{{ $blog->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    <xhtml:link rel="alternate" hreflang="en" href="{{ route('blog.show', ['locale' => 'en', 'blog' => $blog->slug]) }}" />
    <xhtml:link rel="alternate" hreflang="fr" href="{{ route('blog.show', ['locale' => 'fr', 'blog' => $blog->slug]) }}" />
    </url>
    <url>
    <loc>{{ route('blog.show', ['locale' => 'en', 'blog' => $blog->slug]) }}</loc>
        <lastmod>{{ $blog->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    <xhtml:link rel="alternate" hreflang="en" href="{{ route('blog.show', ['locale' => 'en', 'blog' => $blog->slug]) }}" />
    <xhtml:link rel="alternate" hreflang="fr" href="{{ route('blog.show', ['locale' => 'fr', 'blog' => $blog->slug]) }}" />
    </url>
@endforeach
</urlset>