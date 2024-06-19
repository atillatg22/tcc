CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    matricula VARCHAR(20) NOT NULL UNIQUE,
    turma VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE chaves (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prateleira VARCHAR(255) NOT NULL
);

CREATE TABLE emprestimos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chave_id INT NOT NULL,
    aluno_cpf VARCHAR(14) NOT NULL,
    data_emprestimo TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chave_id) REFERENCES chaves(id),
    FOREIGN KEY (aluno_cpf) REFERENCES alunos(cpf)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES ('admin', 'admin');
