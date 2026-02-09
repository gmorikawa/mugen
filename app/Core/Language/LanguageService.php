<?php

namespace App\Core\Language;

use App\Core\Language\Exceptions\DuplicatedLanguageCodeException;
use App\Core\Language\Interfaces\LanguageRepository;
use App\Core\Language\Language;

class LanguageService
{
    public function __construct(
        private LanguageRepository $repository
    ) {}

    function getAll()
    {
        return $this->repository->findAll();
    }

    function getById(string $id)
    {
        return $this->repository->findById($id);
    }

    function getByCode(string $code)
    {
        return $this->repository->findByIsoCode($code);
    }

    function create(Language $entity)
    {
        if (!$this->isCodeUnique($entity->isoCode)) {
            throw new DuplicatedLanguageCodeException();
        }

        return $this->repository->create($entity);
    }

    function update(String $id, Language $entity)
    {
        if (!$this->isCodeUnique($entity->isoCode, $id)) {
            throw new DuplicatedLanguageCodeException();
        }

        $language = $this->getById($id);

        if ($language) {
            $this->repository->update(
                $id,
                new Language([
                    'id' => $id,
                    'name' => $entity->name,
                    'isoCode' => $entity->isoCode
                ])
            );
        }

        return $language;
    }

    function delete(String $id)
    {
        return $this->repository->delete($id);
    }

    function isCodeUnique(String $code, String $ignoreId = '')
    {
        $language = $this->getByCode($code);

        return is_null($language) || $language->id == $ignoreId;
    }
}
