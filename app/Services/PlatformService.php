<?php

namespace App\Services;

use App\Exceptions\Platform\DuplicatedPlatformAbbreviationException;
use App\Exceptions\Platform\DuplicatedPlatformNameException;
use App\Models\Platform;

class PlatformService
{
    function getAll()
    {
        return Platform::all();
    }

    function getById(String $id)
    {
        return Platform::find($id);
    }

    function getByName(String $name)
    {
        return Platform::where('name', $name)->first();
    }

    function getByAbbreviation(String $abbreviation)
    {
        return Platform::where('abbreviation', $abbreviation)->first();
    }

    function create(Platform $entity)
    {
        if (!$this->isNameUnique($entity->name)) {
            throw new DuplicatedPlatformNameException();
        }

        if (!$this->isAbbreviationUnique($entity->abbreviation)) {
            throw new DuplicatedPlatformAbbreviationException();
        }

        $entity->save();

        return $entity;
    }

    function update(String $id, Platform $entity)
    {
        if (!$this->isNameUnique($entity->name, $id)) {
            throw new DuplicatedPlatformNameException();
        }

        if (!$this->isAbbreviationUnique($entity->abbreviation, $id)) {
            throw new DuplicatedPlatformAbbreviationException();
        }

        $platform = $this->getById($id);

        if ($platform) {
            $platform->name = $entity->name;
            $platform->abbreviation = $entity->abbreviation;
            $platform->type = $entity->type;
            $platform->developer_id = $entity->developer_id;
            $platform->manufacturer_id = $entity->manufacturer_id;

            $platform->save();
        }

        return $platform;
    }

    function remove(String $id)
    {
        return Platform::destroy($id);
    }

    function isNameUnique(String $name, String $ignoreId = '')
    {
        $platform = $this->getByName($name);

        return is_null($platform) || $platform->id == $ignoreId;
    }

    function isAbbreviationUnique(String $abbreviation, String $ignoreId = '')
    {
        $platform = $this->getByAbbreviation($abbreviation);

        return is_null($platform) || $platform->id == $ignoreId;
    }
}
