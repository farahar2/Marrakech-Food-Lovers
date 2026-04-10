<?php
require_once '/../config/Database.php';
class Category
{
    private $conn;
    private $id;
    private $name;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }
// Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
// Setters
    public function setName($name)
    {
      $name = trim($name);
      if (empty($name)) {
          throw new Exception("Le nom est obligatoire.");
          }
      $this->name = $name;
    }

//Create 
    public function create()
    {
        $query = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $this->name);
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
//Read All
    public function getAll()
    {
        $query = "SELECT * FROM categories ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
      
        $categories = [];
        while ($row = $stmt->fetch()) {
            $category = new Category();
            $category->id = $row['id'];
            $category->name = $row['name'];
            $categories[] = $category;
        }
        return $categories;
    }
// Read by ID
    public function getById($id)
    {
        $query = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
      
        if ($row = $stmt->fetch()) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            return true;
        }
        return false;
    }
// Update
    public function update()
    {
        $query = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }

// Delete
    public function delete()
    {
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        return $stmt->execute();
}

public function countRecipes()
{
    $query = "SELECT COUNT(*) FROM recipes WHERE category_id = :category_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':category_id', $this->id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();
    return (int)$result['count'];
}
}

?>