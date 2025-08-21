<?php

namespace App\Services;

use App\Exceptions\Language\DuplicatedLanguageCodeException;
use App\Models\Language;

class LanguageService
{
    function getAll()
    {
        return Language::all();
    }

    function getById(String $id)
    {
        return Language::find($id);
    }

    function getByCode(String $code)
    {
        return Language::where('iso_code', $code)->first();
    }

    function create(Language $entity)
    {
        if (!$this->isCodeUnique($entity->name)) {
            throw new DuplicatedLanguageCodeException();
        }

        $entity->save();

        return $entity;
    }

    function update(String $id, Language $entity)
    {
        if (!$this->isCodeUnique($entity->name, $id)) {
            throw new DuplicatedLanguageCodeException();
        }

        $language = $this->getById($id);

        if ($language) {
            $language->name = $entity->name;
            $language->iso_code = $entity->iso_code;

            $language->save();
        }

        return $language;
    }

    function remove(String $id)
    {
        return Language::destroy($id);
    }

    function isCodeUnique(String $name, String $ignoreId = '')
    {
        $language = $this->getByCode($name);

        return is_null($language) || $language->id == $ignoreId;
    }
}
