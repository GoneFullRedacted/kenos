<?php

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;

final class SlugService
{
    public function __construct(
        private SluggerInterface $slugger,
        private string $defaultLocale = 'fr',
    ) {}

    /** Slugifie un texte libre */
    public function fromText(?string $text, ?string $locale = null, string $sep = '-'): string
    {
        $text = trim((string) $text);
        if ($text === '') return 'n-a';
        $segment = mb_substr(strip_tags($text), 0, 120);
        $slug = $this->slugger->slug($segment, $sep, $locale ?? $this->defaultLocale)->lower()->toString();
        return $slug !== '' ? $slug : 'n-a';
    }

    /** Slugifie le dernier segment d'une URL */
    public function fromUrl(string $url, ?string $locale = null, string $sep = '-'): string
    {
        $path = (string) (parse_url($url, PHP_URL_PATH) ?? '');
        $base = $path !== '' ? basename(rtrim($path, '/')) : $url;
        $base = urldecode($base);
        $base = (string) preg_replace('/\.[a-z0-9]+$/i', '', $base); // retire .html/.jpg...
        return $this->fromText($base, $locale ?? $this->defaultLocale, $sep);
    }

    /** Assure l'unicité via callback exists(slug):bool (ajoute -2, -3, ...) */
    public function makeUnique(string $baseSlug, callable $exists): string
    {
        $unique = $baseSlug;
        $i = 2;
        while ($exists($unique)) {
            $unique = sprintf('%s-%d', $baseSlug, $i++);
            if ($i > 9999) break;
        }
        return $unique;
    }
}
