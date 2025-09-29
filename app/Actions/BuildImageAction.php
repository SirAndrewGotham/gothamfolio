<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\Storage;

final readonly class BuildImageAction
{
    /**
     * Stores an uploaded image in the public storage disk under the given folder and returns the generated filename.
     *
     * @param string $folder Destination directory within the public storage disk.
     * @param string $slug   Identifier used as the base of the image filename.
     * @param \Illuminate\Http\UploadedFile $image Uploaded file instance.
     * @return string The generated filename (slug + timestamp + original extension).
     */
    public function handle($folder, $slug, $image): string
    {
        $imageName = $slug.'-'.now()->format('YmdHis').'.'.$image->getClientOriginalExtension();

        Storage::disk('public')->putFileAs($folder, $image, $imageName);

        return $imageName;
    }
}
