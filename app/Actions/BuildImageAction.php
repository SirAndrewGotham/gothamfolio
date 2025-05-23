<?php

namespace App\Actions;

class BuildImageAction
{
    public function handle($folder, $slug, $image): string
    {
        $imageName = $slug.'-'.now()->format('YmdHis').'.'.$image->extension();

        $image->move(public_path($folder), $imageName);

        return $imageName;
    }
}
