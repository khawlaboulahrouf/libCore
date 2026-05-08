<?php
class Library {

    private $pdo;

// librarian
    public function addBook()
    {
        $isbn = readline("ISBN: ");
        $title = readline("Titre: ");
        $author = readline("Auteur: ");
        $idLibrary = readline("ID Library: ");
        $sql = "INSERT INTO books (isbn, title, author, id_library)
            VALUES (:isbn, :title, :author, :id_library)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':isbn' => $isbn,
            ':title' => $title,
            ':author' => $author,
            ':id_library' => $idLibrary
        ]);

        echo "Livre ajouté";
    }
    public function createMember()
    {
        $name = readline("Nom: ");
        $email = readline("Email: ");
        $max = readline("Max books (3/10): ");
        // 1 - insert user
        $sql = "INSERT INTO users(name, email)
            VALUES(:name, :email)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':name' => $name,
            ':email' => $email
        ]);

        $userId = $this->pdo->lastInsertId();
        $sql = "INSERT INTO members(id_user, max_books, is_active)
            VALUES(:id_user, :max_books, 1)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id_user' => $userId,
            ':max_books' => $max
        ]);

        echo "Membre créé";
    }
    public function listBooks()
    {

        $sql = "SELECT * FROM books";

        $stmt = $this->pdo->query($sql);

        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $book) {
            echo "Livre ID :" . $book['id'] . "\n" . $book['title'] . " - " . $book['author'] . " - " .  $book['status'] . " ";
        }
    }
    public function markAsRepair()
    {
    $id = readline("ID Book: ");
        $sql = "UPDATE books
            SET status = 'en réparation',
                is_available = 0
            WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        echo "Livre en réparation";
    }
    public function deleteBook()
    {
    $id = readline("ID Book: ");
        $sql = "DELETE FROM books WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        echo "Livre supprimé";
    }
    
}