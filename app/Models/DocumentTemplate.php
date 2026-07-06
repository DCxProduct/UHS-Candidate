<?php

namespace App\Models;

use Chanthoeun\FilamentDocumentBuilder\Models\DocumentTemplate as BaseDocumentTemplate;
use Spatie\Translatable\HasTranslations;

class DocumentTemplate extends BaseDocumentTemplate
{
    use HasTranslations;

    public array $translatable = [
        'name',
    ];

    protected $table = 'document_templates';

    protected $fillable = [
        'name',
        'type',
        'custom_form_id',
        'model_class',
        'content',
        'page_settings',
        'extra_data_sources',
    ];
}
