<?php

namespace App\Models;

use App\Enums\StatusEnum;
use App\Filament\Resources\SolarFormResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolarForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'hasSolar',
        'panel_count',
        'status',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function (SolarForm $form) {
            //If form panels is less than 5, make it unqualified
            if($form->panel_count < 5)
            {
                $form->status = StatusEnum::UNQUALIFIED->value;
            }
            else
            {
                $form->status = StatusEnum::QUALIFIED->value;
            }
            $form->save();
        });
    }
}
