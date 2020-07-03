<?php

class EventController extends BaseController
{

    /**
     * @return EventController new EventController instance
     */
    public static function get()
    {
      return new EventController();
    }

    public function getAll($query)
    {
      $limit = (!empty($query['limit']) && is_numeric($query['limit']) && $query['limit'] > 0) ? $query['limit'] : 100;

      $column = 'title';
      $direction = 'ASC';
      if (!empty($query['orderBy'])) {
        $columnRequested = $query['orderBy'];
        if (substr($query['orderBy'], 0, 1) === "-") { // Prüfen ob mit - anfängt
          $direction = 'DESC';
          $columnRequested = substr($columnRequested, 1); // - entfernen
        }
      }

      $repository = EventRepository::get();
      $events = $repository->getAll($limit, $column, $direction);
      return $this->json($events);
    }

    public function getOne($id)
    {
      $repository = EventRepository::get();
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
      $repository = EventRepository::get();
      $id = $repository->create($data);
      return $this->getOne($id);
    }

    public function update($id, $data)
    {
      if (empty($data['title'])) {
        return $this->json([
          'error' => 'Title Missing',
        ], 400);
      }
      $repository = EventRepository::get();
      $repository->update($id, $data);
      return $this->getOne($id);
    }

    public function delete($id)
    {
      $repository = EventRepository::get();
      $wasDeleted = $repository->deleteById($id);
      if ($wasDeleted) {
        return $this->json([
          'status' => 'success',
        ], 200);
      }
      return $this->json([
        'status' => 'not found',
      ], 404);
    }

}
