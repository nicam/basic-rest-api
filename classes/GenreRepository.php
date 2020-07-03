<?php


class GenreRepository
{

    private $allowedOrderColumns = ['title', 'created_at', 'updated_at'];

    /**
     * @return GenreRepository new DbUserLoader instance
     */
    public static function get()
    {
        return new GenreRepository();
    }

    public function getAll($limit = 100, $orderColumn = 'id', $orderDirection = 'ASC')
    {
        $orderColumn = in_array($orderColumn, $this->allowedOrderColumns) ? $orderColumn : 'id';
        if ($orderDirection !== 'DESC' && $orderDirection !== 'ASC') {
            $orderDirection = 'ASC';
        }
        // It's not possible to use OrderBy as parameter in prepared statements
        $statement = DB::get()->prepare(
            "SELECT * FROM `genres` ORDER BY $orderColumn $orderDirection LIMIT :limit"
        );
        $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneById($id)
    {
        $statement = DB::get()->prepare(
            "SELECT * FROM `genres` WHERE `id` = :id;"
        );
        $statement->execute([':id' => $id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public function create($title)
    {
        $statement = DB::get()->prepare(
            "INSERT INTO genres ( title ) VALUES ( :title );"
        );
        $statement->execute([':title' => $title]);
        return DB::get()->lastInsertId();
    }

    public function deleteById($id)
    {
        $statement = DB::get()->prepare(
            "DELETE FROM genres WHERE id = :id;"
        );
        $statement->execute([':id' => $id]);

        // Prüfen ob wirklich was gelöscht wurde
        if ($statement->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function update($id, $title)
    {
        $statement = DB::get()->prepare(
            "UPDATE genres set title = :title WHERE id = :id"
        );
        $statement->execute([':title' => $title, ':id' => $id]);
    }
}
