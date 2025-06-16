USE feira;

CREATE TABLE stand (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bloco ENUM('Bloco A', 'Bloco B', 'Pátio', 'Biblioteca', 'Auditório', 'Quadra') NOT NULL,
    sala ENUM( 'Sala 1', 'Sala 2', 'Sala 3','Sala 4', 'Sala 5','Sala 6','Sala 7', 'Sala 8', 'Pátio', 'Biblioteca', 'Auditório', 'Quadra' ) NOT NULL,
    posicao INT  NOT NULL,
    nome_stand	VARCHAR(100) NOT NULL
);

INSERT INTO stand (bloco, sala, posicao, nome_stand) VALUES
('Bloco A', 'Sala 1', 1, 'stand 1'),
('Bloco A', 'Sala 1', 2, 'stand 2'),
('Bloco A', 'Sala 1', 3, 'stand 3'),
('Bloco A', 'Sala 1', 4, 'stand 4'),
('Bloco A', 'Sala 1', 5, 'stand 5'),
('Bloco A', 'Sala 1', 6, 'stand 6'),
('Bloco A', 'Sala 1', 7, 'stand 7'),
('Bloco A', 'Sala 1', 8, 'stand 8'),
('Bloco A', 'Sala 2', 1, 'stand 1'),
('Bloco A', 'Sala 3', 2, 'stand 2'),
('Bloco A', 'Sala 4', 3, 'stand 3'),
('Bloco A', 'Sala 5', 4, 'stand 4'),
('Bloco A', 'Sala 6', 5, 'stand 5'),
('Bloco A', 'Sala 7', 6, 'stand 6'),
('Bloco A', 'Sala 8', 7, 'stand 7');

