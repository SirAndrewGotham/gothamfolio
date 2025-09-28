<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Storage;

final readonly class BuildImageAction
{
    public function handle($folder, $slug, $image): string
    {
        $imageName = $slug.'-'.now()->format('YmdHis').'.'.$image->getClientOriginalExtension();

        Storage::disk('public')->putFileAs($folder, $image, $imageName);

        return $imageName;
    }
}
