<?php

namespace App\Services;

use App\Models\Game;

class GameService
{
    function getAll()
    {
        return Game::all();
    }

    function getById(String $id)
    {
        return Game::find($id);
    }

    function create(Game $entity, $categories, $developers, $publishers)
    {
        $entity->save();

        $entity->categories()->sync($categories);
        $entity->developers()->sync($developers);
        $entity->publishers()->sync($publishers);

        return $entity;
    }

    function update(String $id, Game $entity, $categories, $developers, $publishers)
    {
        $game = $this->getById($id);

        if ($game) {
            $game->title = $entity->title;
            $game->platform_id = $entity->platform_id;
            $game->cover_id = $entity->cover_id;
            $game->release_date = $entity->release_date;

            $game->save();

            $game->categories()->sync($categories);
            $game->developers()->sync($developers);
            $game->publishers()->sync($publishers);
        }

        return $game;
    }

    function remove(String $id)
    {
        return Game::destroy($id);
    }
}
