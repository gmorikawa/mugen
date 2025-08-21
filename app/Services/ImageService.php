<?php

namespace App\Services;

use App\Models\Image;

class ImageService
{
    function getAll()
    {
        return Image::all();
    }

    function getById(String $id)
    {
        return Image::find($id);
    }

    function create(Image $entity, $languages)
    {
        $entity->save();

        $entity->languages()->sync($languages);

        return $entity;
    }

    function update(String $id, Image $entity, $languages)
    {
        $image = $this->getById($id);

        if ($image) {
            $image->game_id = $entity->game_id;
            $image->color_encoding_id = $entity->color_encoding_id;
            $image->file_id = $entity->file_id;
            $image->description = $entity->description;

            $image->save();

            $entity->languages()->sync($languages);
        }

        return $image;
    }

    function remove(String $id)
    {
        return Image::destroy($id);
    }
}
