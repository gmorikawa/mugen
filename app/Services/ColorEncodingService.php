<?php

namespace App\Services;

use App\Models\ColorEncoding;

class ColorEncodingService
{
    function getAll()
    {
        return ColorEncoding::all();
    }

    function getById(String $id)
    {
        return ColorEncoding::find($id);
    }

    function getByName(String $name)
    {
        return ColorEncoding::where('name', $name)->first();
    }

    function create(ColorEncoding $entity)
    {
        $entity->save();

        return $entity;
    }

    function update(String $id, ColorEncoding $entity)
    {
        $colorEncoding = $this->getById($id);

        if ($colorEncoding) {
            $colorEncoding->name = $entity->name;
            $colorEncoding->description = $entity->description;

            $colorEncoding->save();
        }

        return $colorEncoding;
    }

    function remove(String $id)
    {
        return ColorEncoding::destroy($id);
    }
}
