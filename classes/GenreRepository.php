<?php


class GenreRepository
{
    /**
     * @return GenreRepository new DbUserLoader instance
     */
    public static function get()
    {
        return new GenreRepository();
    }

    public function getAll()
    {
        $statement = DB::get()->prepare(
            "SELECT * FROM `genres` LIMIT 100"
        );
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
            "UPDATE genres set title = :title;"
        );
        $statement->execute([':title' => $title]);
    }
}
