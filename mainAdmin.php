<?php
require 'script/db.php';
require 'src/Services/library.php';
$library = new Library($pdo);
while (true) {
    echo "\n===== ADMIN DASHBOARD =====\n";
    echo "1 - Ajouter un livre\n";
    echo "2 - Ajouter un membre\n";
    echo "3 - Liste des livres\n";
    echo "4 - Mettre livre en réparation\n";
    echo "5 - Supprimer un livre\n";
    echo "0 - Quitter\n";
    $choice = readline("Choix: ");
    if ($choice == 0) {
        echo "Bye Admin ";
        break;
    }
    switch ($choice) {
        case 1:
            $library->addBook();
            break;
        case 2:
            $library->createMember();
            break;
        case 3:
            $library->listBooks();
            break;
        case 4:     
            $library->markAsRepair();
            break;
        case 5:     
            $library->deleteBook();
            break;
        default:
            echo "Option invalide\n";
    }
}