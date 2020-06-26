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
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public function deleteById($id)
    {
        $statement = DB::get()->prepare("DELETE FROM `genres` WHERE id = :id");
        $result = $statement->execute([':id' => $id]);
        if ($result) {
            return $result;
        }
        throw new Exception("konnte Genre nicht löschen!");
    }

    public function create($title)
    {
        $statement = DB::get()->prepare(
            "INSERT INTO genres ( title )
            VALUES ( :title );");
        $statement->execute([':title' => $title]);
    }

    public function update($id, $title)
    {
        // prepare mit named Parameter ':id' => $id
        $statement = DB::get()->prepare(
            "UPDATE `genres` SET title= :title WHERE id = :id");
        $statement->execute([':id' => $id, ':title' => $title]);
    }
}
