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
    public function color(): string
    {
        return match ($this) {
            static::QUALIFIED => 'info',
            static::UNQUALIFIED => 'warning',
            static::CONTACTED => '',
            static::INSTALLED => 'success',
        };
    }
}
