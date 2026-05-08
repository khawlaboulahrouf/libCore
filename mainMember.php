<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/src/Services/Library.php';
$db = $pdo;
$library = new Library($db);
while (true) {
    echo " LIBCORE - MENU MEMBER\n";
    echo "1. Search Book\n";
    echo "2. emprunt\n";
    echo "3. returner\n";
    echo "4. My Borrowed Books\n";
    echo "5. Exit\n";
    $choice = readline("Choose option: ");
    // choix 1 search a book
    if ($choice == 1) {
        $q = readline("Enter title or ISBN: ");
        $book = $library->searchBook($q);
        echo "\nRESULT:\n";
        if ($book) {
            echo "- " . $book['title'] . " | " . $book['isbn'] . "\n";
        }
        else {
            echo " No book found\n";
        }
    }
    // choix 2 borrow book (empunté)
    elseif ($choice == 2) {
    $memberId = readline("Member ID: ");
    $isbn = readline("ISBN: ");
    $result = $library->borrowBook($memberId, $isbn);
    if ($result) {
        echo "✔ Book borrowed successfully\n";
    }
    else {
        echo " Book not available\n";
    }
    }
    // choix 3 return book
     elseif ($choice == 3) {

        $isbn = readline("Enter ISBN: ");

        $result = $library->returnBook($isbn);

        if ($result) {

            echo " Book returned successfully\n";
        }
        else {

            echo " Return failed\n";
        }
    }
    // History of borrowing
    elseif ($choice == 4) {

    $memberId = readline("Enter Member ID: ");

    $books = $library->getBorrowedBooks($memberId);

    if ($books) {

        echo "\n=== MY BOOKS ===\n";

        foreach ($books as $book) {

            echo "Title: " . $book['title'] . "\n";
            echo "ISBN: " . $book['isbn'] . "\n";
            echo "date_emprunt: " . $book['date_emprunt'] . "\n";
            echo "----------------------\n";
        }
    }
        else {

            echo " No borrowed books\n";
        }
    }
    else{
        echo "not fount";
    }

}