<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentTemplateResource\Pages;
use App\Models\DocumentTemplate;
use Chanthoeun\FilamentDocumentBuilder\Resources\DocumentTemplateResource as BaseDocumentTemplateResource;

class DocumentTemplateResource extends BaseDocumentTemplateResource
{
    protected static ?string $model = DocumentTemplate::class;

    public static function getNavigationLabel(): string
    {
        return __('navigation.document_templates');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('navigation.groups.form_builder');
    }

    public static function getModelLabel(): string
    {
        return __('navigation.document_templates');
    }

    public static function getPluralModelLabel(): string
    {
        return __('navigation.document_templates');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocumentTemplates::route('/'),
            'create' => Pages\CreateDocumentTemplate::route('/create'),
            'edit' => Pages\EditDocumentTemplate::route('/{record}/edit'),
        ];
    }
}
