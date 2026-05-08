<?php
class Library {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    //  Search Book 
    public function searchBook($keyword){

        $sql = "SELECT * FROM books 
                WHERE title LIKE :kw
                OR isbn LIKE :kw
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'kw' => "%$keyword%"
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //  US6: Borrow Book
public function borrowBook($memberId, $isbn){

    $isbn = trim($isbn);

    // 1. get book
    $sql = "SELECT * FROM books WHERE isbn = :isbn";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['isbn' => $isbn]);

    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book || $book['is_available'] != 1) {
        return false;
    }

    // 2. update book
    $update = "UPDATE books 
               SET is_available = 0,
                   status = 'emprunté'
               WHERE isbn = :isbn";

    $stmt2 = $this->pdo->prepare($update);
    $stmt2->execute(['isbn' => $isbn]);

    // 3. insert borrow
    $insert = "INSERT INTO emprunts (id_member, id_book, borrow_date)
               VALUES (:id_member, :id_book, NOW())";

    $stmt3 = $this->pdo->prepare($insert);

    $stmt3->execute([
        'id_member' => $memberId,
        'id_book' => $book['id']
    ]);

    return true;
}

public function returnBook($isbn){

    $isbn = trim($isbn);

    // 1. get book
    $sql = "SELECT * FROM books WHERE isbn = :isbn";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        'isbn' => $isbn
    ]);

    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    // book not found
    if (!$book) {
        return false;
    }

    // 2. update availability
    $update = "UPDATE books
               SET is_available = 1,
                   status = 'disponible'
               WHERE isbn = :isbn";

    $stmt2 = $this->pdo->prepare($update);

    $stmt2->execute([
        'isbn' => $isbn
    ]);

    // 3. delete borrow record
    $delete = "DELETE FROM emprunts
               WHERE id_book = :id_book";

    $stmt3 = $this->pdo->prepare($delete);

    $stmt3->execute([
        'id_book' => $book['id']
    ]);

    return true;
}

    
public function getBorrowedBooks($memberId){

    $sql = "SELECT books.title,
                   books.isbn,
                   emprunts.borrow_date
            FROM emprunts
            INNER JOIN books
            ON emprunts.id_book = books.id
            WHERE emprunts.id_member = :id_member";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        'id_member' => $memberId
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

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