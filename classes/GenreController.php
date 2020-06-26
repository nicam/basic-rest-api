<?php

class GenreController extends BaseController
{
    /**
     * @return GenreController new GenreController instance
     */
    public static function get()
    {
        return new GenreController();
    }

    public function getAll()
    {
      $repository = GenreRepository::get();
      $genres = $repository->getAll();
      return $this->json($genres);
    }

    public function getOne($id)
    {
      $repository = GenreRepository::get();
      $genre = $repository->getOneById($id);
      if (!$genre) {
        return $this->json([
          'error' => 'Genre not found',
        ], 404);
      }
      return $this->json($genre);
    }

    public function create($data)
    {
      if (empty($data['title'])) {
        return $this->json([
          'error' => 'Title Missing',
        ], 400);
      }
      $repository = GenreRepository::get();
      $id = $repository->create($data['title']);
      return $this->getOne($id);
    }

    public function update($id, $data)
    {
      // Zu implementieren
    }

    public function delete($id)
    {
      // Zu implementieren
    }

}
