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
        $statement = DB::get()->prepare("SELECT * FROM `genres` LIMIT 100");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneById($id)
    {
        $statement = DB::get()->prepare("SELECT * FROM `genres` WHERE `id` = :id;");
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
            "INSERT INTO genres ( title )
            VALUES ( :title );");
        $statement->execute([':title' => $title]);
        return DB::get()->lastInsertId();
    }

    public function deleteById($id)
    {
        // TBD
    }

    public function update($id, $title)
    {
        // TBD
    }
}
