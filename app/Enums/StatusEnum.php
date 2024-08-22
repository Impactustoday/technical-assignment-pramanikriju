<?php
namespace App\Enums;

enum StatusEnum: string
{

    // Roles and their enum values
    case QUALIFIED = 'qualified';
    case UNQUALIFIED = 'unqualified';
    case CONTACTED = 'contacted';
    case INSTALLED = 'installed';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::QUALIFIED => 'Qualified for process',
            static::UNQUALIFIED => 'Not Qualified',
            static::CONTACTED => 'Contacted successfully',
            static::INSTALLED => 'Installation complete',
        };
    }
}
