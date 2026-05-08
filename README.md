# LibCore – Partie 1 : Dashboard Admin (Bibliothécaire)

## Fichiers inclus

```
Partie1_Admin/
├── src/
│   ├── Entities/
│   │   ├── User.php         ← Classe abstraite (parent)
│   │   ├── Book.php         ← Entité Livre
│   │   ├── Member.php       ← Member + Student + Teacher
│   │   └── Librarian.php    ← Bibliothécaire
│   └── Services/
│       └── Library.php      ← Logique admin (catalogue, membres)
├── mainAdmin.php            ← Point d'entrée console
├── database.sql             ← Schéma BDD + données de démo
└── README.md
```

## Lancer

```bash
php mainAdmin.php
```

## User Stories couvertes

| US  | Description                         |
|-----|-------------------------------------|
| US1 | Ajouter un livre au catalogue       |
| US2 | Créer et lister des membres         |
| US3 | Voir tous les livres + leur état    |
| US4 | Retirer / changer l'état d'un livre |

## Concepts POO utilisés

- Classe **abstraite** : `User`
- **Héritage** : `Member`, `Librarian` → `User` | `Student`, `Teacher` → `Member`
- **Encapsulation** : toutes les propriétés sont `private`
- **Getters / Setters** dans chaque classe
- **Polymorphisme** : `getMaxBooks()` différent selon Student ou Teacher
