<?php

namespace model\Interface;

use model\Abstract\AbstractMapping;
use PDO;

interface InterfaceManager;
{
    public function __construct(PDO $pdo);
    public function selectAll();
    public function selectOneById(int $id);
    public function insert(AbstractMapping $mapping);
    public function update(AbstractMapping $mapping);
    public function delete(int $id);
}


require_once('path/to/database_connection.php'); // Replace with your connection details

interface InterfaceManager {

    public function createInterface(string $name, array $data): ?int
    {
        $slug = $this->generateSlug($name);
        $sql = "INSERT INTO interfaces (name, slug, data) VALUES (?, ?, ?)";

        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->execute([$name, $slug, json_encode($data)]);

        return $GLOBALS['pdo']->lastInsertId();
    }

    public function findInterface(int $id): ?array
    {
        $sql = "SELECT * FROM interfaces WHERE id = ?";
        $stmt = $GLOBALS['pdo']->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? json_decode($result['data'], true) : null;
    }

    public function updateInterface(int $id, string $name, array $data): bool
    {
        $slug = $this->generateSlug($name, $id);
        $sql = "UPDATE interfaces SET name = ?, slug = ?, data = ? WHERE id = ?";

        $stmt = $GLOBALS['pdo']->prepare($sql);
        return $stmt->execute([$name, $slug, json_encode($data), $id]);
    }

    public function deleteInterface(int $id): bool
    {
        $sql = "DELETE FROM interfaces WHERE id = ?";
        $stmt = $GLOBALS['pdo']->prepare($sql);
        return $stmt->execute([$id]);
    }

    // ... Add InterfaceSlugManager dependency and methods here (see previous response)
}
