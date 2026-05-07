<?php


require_once __DIR__ . '/src/Services/Library.php';

// ─── 1. Création des objets de base ──────────────────────────
$library   = new Library();
$librarian = new Librarian(99, 'Clara Admin', 'clara@mail.com');

// ─── 2. Ajout des livres au catalogue (US1) ──────────────────
echo "\n══ Initialisation du catalogue ══\n";
$b1 = new Book(1, 'Clean Code',          'Robert C. Martin',       '9780132350884');
$b2 = new Book(2, 'Le Petit Prince',     'Antoine de Saint-Exupéry','9782070612758');
$b3 = new Book(3, 'PHP 8 Patterns',      'Matt Zandstra',          '9781484267912');
$b4 = new Book(4, 'Introduction à UML',  'Pascal Roques',          '9782212110708');

$library->addBook($b1);
$library->addBook($b2);
$library->addBook($b3);
$library->addBook($b4);

// ─── 3. Création des membres (US2) ───────────────────────────
echo "\n══ Enregistrement des membres ══\n";
$alice = new Student(1, 'Alice Dupont', 'alice@mail.com');
$bob   = new Teacher(2, 'Bob Martin',  'bob@mail.com');
$library->registerMember($alice);
$library->registerMember($bob);

// ─── 4. Menu interactif ──────────────────────────────────────
function afficherMenu(): void
{
    echo "     LibCore – Dashboard Bibliothécaire       \n";
    echo "  1. Voir tous les livres            \n";
    echo "  2. Ajouter un livre                \n";
    echo "  3. Retirer un livre               \n";
    echo "  4. Changer l'état d'un livre       \n";
    echo "  5. Voir tous les membres           \n";
    echo "  6. Ajouter un membre               \n";
    echo "  0. Quitter\n";
    echo "──────────────────────────────────────────────\n";
    echo "Votre choix : ";
}

// ─── Boucle principale ───────────────────────────────────────
while (true) {
    afficherMenu();
    $choix = trim(fgets(STDIN));

    switch ($choix) {

        // US3 – Voir le catalogue complet
        case '1':
            $library->listBooks();
            break;

        // US1 – Ajouter un nouveau livre
        case '2':
            echo "Titre du livre  : ";  $titre  = trim(fgets(STDIN));
            echo "Auteur          : ";  $auteur = trim(fgets(STDIN));
            echo "ISBN            : ";  $isbn   = trim(fgets(STDIN));
            $id = rand(100, 9999); // ID simple pour la démo
            $nouveau = new Book($id, $titre, $auteur, $isbn);
            $library->addBook($nouveau);
            break;

        // US4 – Retirer un livre
        case '3':
            $library->listBooks();
            echo "ID du livre à retirer : ";
            $id = (int) trim(fgets(STDIN));
            $library->removeBook($id);
            break;

        // US4 – Changer l'état d'un livre
        case '4':
            $library->listBooks();
            echo "ID du livre : ";
            $id = (int) trim(fgets(STDIN));
            echo "Nouvel état (available / repair / lost / borrowed) : ";
            $statut = trim(fgets(STDIN));
            $library->setBookStatus($id, $statut);
            break;

        // US2 – Voir les membres
        case '5':
            $library->listMembers();
            break;

        // US2 – Ajouter un membre
        case '6':
            echo "Nom du membre  : ";  $nom   = trim(fgets(STDIN));
            echo "Email          : ";  $email = trim(fgets(STDIN));
            echo "Type (1=Student / 2=Teacher) : ";
            $type = trim(fgets(STDIN));
            $id   = rand(10, 99);
            $membre = ($type === '2') ? new Teacher($id, $nom, $email) : new Student($id, $nom, $email);
            $library->registerMember($membre);
            break;

        case '0':
            echo "\n Au revoir !\n\n";
            exit(0);

        default:
            echo "Choix invalide, réessayez.\n";
    }
}
