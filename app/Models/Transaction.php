<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['descricao', 'valor'];

    public function valor(): Attribute
    {
        return new Attribute(
            get: fn($value) => number_format($value / 100, 2, ',', '.'),
            set: fn($value) => $this->removeMascara($value),
        );
    }

    public function removeMascara($value): string
    {
        return preg_replace('/[^0-9-]/', '', $value);
    }

}
