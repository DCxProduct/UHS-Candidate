<?php

namespace App\Filament\Resources\DocumentTemplateResource\Pages;

use App\Filament\Resources\DocumentTemplateResource;
use Chanthoeun\FilamentDocumentBuilder\Resources\DocumentTemplateResource\Pages\EditDocumentTemplate as BaseEditDocumentTemplate;

class EditDocumentTemplate extends BaseEditDocumentTemplate
{
    protected static string $resource = DocumentTemplateResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['name'] = $this->localizedName($data['name'] ?? null);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['name'] = $this->mergedNameTranslations((string) ($data['name'] ?? ''));

        return $data;
    }

    private function localizedName(mixed $value): string
    {
        $translations = $this->normalizeTranslations($value);
        $locale = app()->getLocale();

        return (string) (
            $translations[$locale]
            ?? ($locale === 'km' ? ($translations['kh'] ?? null) : null)
            ?? ($locale === 'kh' ? ($translations['km'] ?? null) : null)
            ?? $translations['en']
            ?? reset($translations)
            ?: ''
        );
    }

    private function mergedNameTranslations(string $value): array
    {
        $translations = $this->normalizeTranslations($this->record->getRawOriginal('name'));
        $locale = app()->getLocale();

        $translations[$locale] = $value;

        if ($locale === 'km') {
            $translations['kh'] = $value;
        }

        if ($locale === 'kh') {
            $translations['km'] = $value;
        }

        if (blank($translations['en'] ?? null)) {
            $translations['en'] = $value;
        }

        if (blank($translations['km'] ?? null)) {
            $translations['km'] = $value;
        }

        if (blank($translations['kh'] ?? null)) {
            $translations['kh'] = $translations['km'];
        }

        return $translations;
    }

    private function normalizeTranslations(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode((string) $value, true);

        if (is_array($decoded)) {
            return $decoded;
        }

        return filled($value) ? ['en' => (string) $value] : [];
    }
}
