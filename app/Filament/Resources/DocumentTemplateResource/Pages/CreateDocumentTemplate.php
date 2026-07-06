<?php

namespace App\Filament\Resources\DocumentTemplateResource\Pages;

use App\Filament\Resources\DocumentTemplateResource;
use Chanthoeun\FilamentDocumentBuilder\Resources\DocumentTemplateResource\Pages\CreateDocumentTemplate as BaseCreateDocumentTemplate;

class CreateDocumentTemplate extends BaseCreateDocumentTemplate
{
    protected static string $resource = DocumentTemplateResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['name'] = $this->translationPayload((string) ($data['name'] ?? ''));

        return $data;
    }

    private function translationPayload(string $value): array
    {
        $locale = app()->getLocale();

        $translations = [
            'en' => $value,
            'km' => $value,
            'kh' => $value,
        ];

        $translations[$locale] = $value;

        if ($locale === 'km') {
            $translations['kh'] = $value;
        }

        if ($locale === 'kh') {
            $translations['km'] = $value;
        }

        return $translations;
    }
}
