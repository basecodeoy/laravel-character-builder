<?php

declare(strict_types=1);

namespace BaseCodeOy\CharacterBuilder\Concerns;

use BaseCodeOy\CharacterBuilder\Path;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait ManagesCharacter
{
    private function createCharacter(): void
    {
        $image = Image::canvas($this->config['width'], $this->config['height']);

        foreach (config('character-builder.parts') as $part) {
            $image->insert(File::get(Arr::random(File::files(Path::parts($part)))->getPathname()));
        }

        $image->save(Path::characters("{$this->identifier}.png"));
    }
}
