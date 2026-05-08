
<?php


require_once __DIR__ . '/src/Entities/Book.php';
require_once __DIR__ . '/src/Entities/User.php';
require_once __DIR__ . '/src/Entities/Member.php';
require_once __DIR__ . '/src/Services/Library.php';
// ============================================================
//  PARTIE 2 – MEMBRE
//  Fichier : mainMember.php
//  Lancer  : php mainMember.php
//  Rôle    : Interface console pour un Membre
//            Démo de toutes les US Membre (US5, US6, US7, US8)
// ============================================================


// ─── 1. Préparer la bibliothèque avec des livres ─────────────
$library = new Library();

$b1 = new Book(1, 'Clean Code',         'Robert C. Martin',        '9780132350884');
$b2 = new Book(2, 'Le Petit Prince',    'Antoine de Saint-Exupéry','9782070612758');
$b3 = new Book(3, 'PHP 8 Patterns',     'Matt Zandstra',           '9781484267912');
$b4 = new Book(4, 'Introduction à UML', 'Pascal Roques',           '9782212110708');

$library->addBook($b1);
$library->addBook($b2);
$library->addBook($b3);
$library->addBook($b4);

// ─── 2. Enregistrer les membres 
$alice = new Student(1, 'Alice Dupont', 'alice@mail.com');  // max 3 livres
$bob   = new Teacher(2, 'Bob Martin',  'bob@mail.com');    // max 10 livres

$library->registerMember($alice);
$library->registerMember($bob);

// ─── 3. Connexion : choisir qui on est 
echo " LibCore - Espace Membre\n";
echo "\nQui êtes-vous ?\n";
echo "  1. Alice Dupont (Student - max 3 livres)\n";
echo "  2. Bob Martin   (Teacher - max 10 livres)\n";
echo "Votre choix : ";

$choixMembre = (int) readline("ID du membre : ");

$membre = $library->getMember($choixMembre);

if (!$membre) {
    echo "Membre introuvable. Fin du programme.\n";
    exit;
}

$type = ($membre instanceof Teacher) ? 'Teacher' : 'Student';

echo "\nBienvenue {$membre->getName()} ! [{$type} - max {$membre->getMaxBooks()} livres]\n";

