<?php

namespace Tests\Feature\Concerns\Models;

use App\Concerns\Translatable;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Dummy model to test the Translatable trait for feature tests
class TestTranslatableModelFeature extends Model
{
    use HasFactory, Translatable;

    protected $table = 'test_translatable_models';

    public $translatable = ['title', 'body'];

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Tests\Feature\Concerns\Database\Factories\TestTranslatableModelFeatureFactory::new();
    }

    public function translations(): HasMany
    {
        return $this->hasMany(Translation::class, 'foreign_key', $this->getKeyName())
            ->where('table_name', $this->getTable());
    }
}
