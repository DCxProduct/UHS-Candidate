<?php

namespace App\Filament\Resources\DocumentTemplateResource\Pages;

use App\Filament\Resources\DocumentTemplateResource;
use Chanthoeun\FilamentDocumentBuilder\Resources\DocumentTemplateResource\Pages\ListDocumentTemplates as BaseListDocumentTemplates;

class ListDocumentTemplates extends BaseListDocumentTemplates
{
    protected static string $resource = DocumentTemplateResource::class;
}
