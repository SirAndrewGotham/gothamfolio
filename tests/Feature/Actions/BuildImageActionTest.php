<?php

use App\Actions\BuildImageAction;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('builds and stores an image with a unique name', function () {
    Storage::fake('public');

    $folder = 'test-images';
    $slug = 'my-test-image';

    // Set a fixed time for predictable naming
    Carbon::setTestNow(Carbon::create(2023, 1, 1, 12, 0, 0));

    $image = UploadedFile::fake()->image('original.png');

    $action = new BuildImageAction;
    $imageName = $action->handle($folder, $slug, $image);

    $expectedImageName = $slug.'-'.Carbon::now()->format('YmdHis').'.'.$image->getClientOriginalExtension();

    expect($imageName)->toBe($expectedImageName);
    Storage::disk('public')->assertExists($folder.'/'.$imageName);
});
