CREATE DATABASE alura_fiap;

CREATE TABLE students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    birth_date DATE NOT NULL,
    user_login VARCHAR(30) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO students (name, birth_date, user_login) VALUES 
('João Silva', '1995-03-15', 'joao_silva'),
('Maria Oliveira', '1993-08-22', 'maria_oliveira'),
('Carlos Souza', '1996-07-30', 'carlos_souza'),
('Ana Pereira', '1994-02-11', 'ana_pereira'),
('Lucas Martins', '1997-05-05', 'lucas_martins');

CREATE TABLE classes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    type ENUM('presencial', 'remoto') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO classes (name, description, type) VALUES 
('Matemática Básica', 'Curso de matemática para iniciantes', 'presencial'),
('Física Aplicada', 'Estudo da física com ênfase em práticas laboratoriais', 'remoto'),
('Programação em Python', 'Introdução à programação usando Python', 'presencial'),
('Banco de Dados', 'Curso sobre modelagem e gerenciamento de bancos de dados', 'remoto'),
('Algoritmos e Estruturas de Dados', 'Curso avançado sobre algoritmos e estruturas de dados', 'presencial');

CREATE TABLE enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT NOT NULL,
    class_id INT NOT NULL,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE,
    UNIQUE (student_id, class_id)
);

INSERT INTO enrollments (student_id, class_id) VALUES 
(1, 1), -- João Silva matriculado em Matemática Básica
(1, 3), -- João Silva matriculado em Programação em Python
(2, 2), -- Maria Oliveira matriculada em Física Aplicada
(3, 4), -- Carlos Souza matriculado em Banco de Dados
(4, 5); -- Ana Pereira matriculada em Algoritmos e Estruturas de Dados


