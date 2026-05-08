CREATE DATABASE libcore;

USE libcore;

-- =========================
-- TABLE LIBRARIES
-- =========================
CREATE TABLE libraries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- =========================
-- TABLE USERS
-- =========================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL
);

-- =========================
-- TABLE MEMBERS
-- =========================
CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT UNIQUE,
    max_books INT DEFAULT 3,
    is_active BOOLEAN DEFAULT TRUE,

    FOREIGN KEY (id_user)
    REFERENCES users(id)
    ON DELETE CASCADE
);

-- =========================
-- TABLE LIBRARIANS
-- =========================
CREATE TABLE librarians (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT UNIQUE,

    FOREIGN KEY (id_user)
    REFERENCES users(id)
    ON DELETE CASCADE
);

-- =========================
-- TABLE BOOKS
-- =========================
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    isbn VARCHAR(100) UNIQUE NOT NULL,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    is_available BOOLEAN DEFAULT TRUE,
    status ENUM('disponible', 'emprunté', 'en réparation', 'perdu') DEFAULT 'disponible',
    id_library INT,

    FOREIGN KEY (id_library)
    REFERENCES libraries(id)
    ON DELETE SET NULL
);

-- =========================
-- TABLE EMPRUNTS
-- =========================
CREATE TABLE emprunts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_emprunt DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_retour DATETIME NULL,

    id_book INT,
    id_member INT,

    FOREIGN KEY (id_book)
    REFERENCES books(id)
    ON DELETE CASCADE,

    FOREIGN KEY (id_member)
    REFERENCES members(id)
    ON DELETE CASCADE
);


-- =========================
-- INSERT LIBRARIES
-- =========================
INSERT INTO libraries (name) VALUES
('Bibliothèque Centrale'),
('Bibliothèque Sciences'),
('Bibliothèque Informatique');


-- =========================
-- INSERT USERS
-- =========================
INSERT INTO users (name, email) VALUES
('Ahmed Alaoui', 'ahmed@gmail.com'),
('Sara Benali', 'sara@gmail.com'),
('Youssef Idrissi', 'youssef@gmail.com'),
('Imane Tazi', 'imane@gmail.com'),
('Khalid Amrani', 'khalid@gmail.com'),
('Nadia Lahlou', 'nadia@gmail.com');

-- =========================
-- INSERT MEMBERS
-- =========================
INSERT INTO members (id_user, max_books, is_active) VALUES
(1, 3, TRUE),
(2, 5, TRUE),
(3, 2, TRUE),
(4, 3, FALSE);

-- =========================
-- INSERT LIBRARIANS
-- =========================
INSERT INTO librarians (id_user) VALUES
(5),
(6);

-- =========================
-- INSERT BOOKS
-- =========================
INSERT INTO books (
    isbn,
    title,
    author,
    is_available,
    status,
    id_library
) VALUES
('9780001', 'Clean Code', 'Robert C. Martin', TRUE, 'disponible', 1),
('9780002', 'Design Patterns', 'Erich Gamma', FALSE, 'emprunté', 1),
('9780003', 'Database Systems', 'Elmasri', TRUE, 'disponible', 2),
('9780004', 'Operating Systems', 'Silberschatz', TRUE, 'en réparation', 2),
('9780005', 'Introduction to Algorithms', 'Thomas H. Cormen', FALSE, 'emprunté', 3),
('9780006', 'Artificial Intelligence', 'Stuart Russell', TRUE, 'disponible', 3);

-- =========================
-- INSERT EMPRUNTS
-- =========================
INSERT INTO emprunts (
    date_emprunt,
    date_retour,
    id_book,
    id_member
) VALUES
('2026-05-01 10:00:00', NULL, 2, 1),
('2026-05-02 14:30:00', '2026-05-05 16:00:00', 3, 2),
('2026-05-03 09:15:00', NULL, 5, 3);