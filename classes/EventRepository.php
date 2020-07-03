<?php


class EventRepository
{

    private $allowedOrderColumns = ['title', 'subtitle', 'date_start', 'date_end', 'created_at', 'updated_at'];

    /**
     * @return EventRepository new DbUserLoader instance
     */
    public static function get()
    {
        return new EventRepository();
    }

    public function getAll($limit = 100, $orderColumn = 'id', $orderDirection = 'ASC')
    {
        $orderColumn = in_array($orderColumn, $this->allowedOrderColumns) ? $orderColumn : 'id';
        if ($orderDirection !== 'DESC' && $orderDirection !== 'ASC') {
            $orderDirection = 'ASC';
        }
        // It's not possible to use OrderBy as parameter in prepared statements
        $statement = DB::get()->prepare(
            "SELECT * FROM `events` ORDER BY $orderColumn $orderDirection LIMIT :limit"
        );
        $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneById($id)
    {
        $statement = DB::get()->prepare(
            "SELECT * FROM `events` WHERE `id` = :id;"
        );
        $statement->execute([':id' => $id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public function create($data)
    {
        $statement = DB::get()->prepare(
            "INSERT INTO events
                ( title, subtitle, desc_title, desc_lead, desc_text, date_start, date_end, youtube_link, genre_id, location_id )
            VALUES ( :title, :subtitle, :desc_title, :desc_lead, :desc_text, :date_start, :date_end, :youtube_link, :genre_id, :location_id );"
        );
        $statement->execute([
            ':title'=> $data['title'],
            ':subtitle'=> $data['subtitle'],
            ':desc_title'=> $data['desc_title'],
            ':desc_lead'=> $data['desc_lead'],
            ':desc_text'=> $data['desc_text'],
            ':date_start'=> $data['date_start'],
            ':date_end'=> $data['date_end'],
            ':youtube_link'=> $data['youtube_link'],
            ':genre_id'=> $data['genre_id'],
            ':location_id' => $data['location_id']
        ]);
        return DB::get()->lastInsertId();
    }

    public function deleteById($id)
    {
        $statement = DB::get()->prepare(
            "DELETE FROM events WHERE id = :id;"
        );
        $statement->execute([':id' => $id]);

        // Prüfen ob wirklich was gelöscht wurde
        if ($statement->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $statement = DB::get()->prepare(
            "UPDATE events SET
                title = :title,
                subtitle = :subtitle,
                desc_title = :desc_title,
                desc_lead = :desc_lead,
                desc_text = :desc_text,
                date_start = :date_start,
                date_end = :date_end,
                youtube_link = :youtube_link,
                genre_id = :genre_id,
                location_id = :location_id;
            WHERE id = :id"
        );
        $statement->execute([
            ':title'=> $data['title'],
            ':subtitle'=> $data['subtitle'],
            ':desc_title'=> $data['desc_title'],
            ':desc_lead'=> $data['desc_lead'],
            ':desc_text'=> $data['desc_text'],
            ':date_start'=> $data['date_start'],
            ':date_end'=> $data['date_end'],
            ':youtube_link'=> $data['youtube_link'],
            ':genre_id'=> $data['genre_id'],
            ':location_id' => $data['location_id'],
            ':id' => $id,
        ]);
    }
}
