<?php
class library{
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
                   status = 'empruntÃ©'
               WHERE isbn = :isbn";

    $stmt2 = $this->pdo->prepare($update);
    $stmt2->execute(['isbn' => $isbn]);

    // 3. insert borrow
    $insert = "INSERT INTO emprunts (id_member, id_book, date_emprunt)
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
                   emprunts.date_emprunt
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
}
?>

    
