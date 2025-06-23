USE feira;

-- Bloco A – 8 salas
INSERT INTO tbl_projetos (titulo_projeto, descricao_projeto, ods, bloco, sala, stand, prof_orientador, posicao_projeto) VALUES
('Projeto A1', 'Descrição do Projeto A1', 'ODS 1', 'A', '101', 'A1', 'Prof. Silva', 1),
('Projeto A2', 'Descrição do Projeto A2', 'ODS 2', 'A', '101', 'A2', 'Prof. Silva', 2),
('Projeto A3', 'Descrição do Projeto A3', 'ODS 3', 'A', '102', 'A1', 'Prof. Souza', 1),
('Projeto A4', 'Descrição do Projeto A4', 'ODS 4', 'A', '102', 'A2', 'Prof. Souza', 2),
('Projeto A5', 'Descrição do Projeto A5', 'ODS 5', 'A', '103', 'A1', 'Prof. Lima', 1),
('Projeto A6', 'Descrição do Projeto A6', 'ODS 6', 'A', '104', 'A1', 'Prof. Lima', 1),
('Projeto A7', 'Descrição do Projeto A7', 'ODS 7', 'A', '105', 'A1', 'Prof. Tavares', 1),
('Projeto A8', 'Descrição do Projeto A8', 'ODS 8', 'A', '106', 'A1', 'Prof. Tavares', 1);

-- Bloco B – 4 salas
INSERT INTO tbl_projetos (titulo_projeto, descricao_projeto, ods, bloco, sala, stand, prof_orientador, posicao_projeto) VALUES
('Projeto B1', 'Descrição do Projeto B1', 'ODS 9', 'B', '201', 'B1', 'Prof. Nunes', 1),
('Projeto B2', 'Descrição do Projeto B2', 'ODS 10', 'B', '202', 'B1', 'Prof. Nunes', 1),
('Projeto B3', 'Descrição do Projeto B3', 'ODS 11', 'B', '203', 'B1', 'Prof. Braga', 1),
('Projeto B4', 'Descrição do Projeto B4', 'ODS 12', 'B', '204', 'B1', 'Prof. Braga', 1);

-- Quadra (agora sala do Bloco B)
INSERT INTO tbl_projetos (titulo_projeto, descricao_projeto, ods, bloco, sala, stand, prof_orientador, posicao_projeto) VALUES
('Projeto Q1', 'Projeto da Quadra 1', 'ODS 13', 'B', 'Quadra', 'Q1', 'Prof. Quadra', 1),
('Projeto Q2', 'Projeto da Quadra 2', 'ODS 14', 'B', 'Quadra', 'Q2', 'Prof. Quadra', 2),
('Projeto Q3', 'Projeto da Quadra 3', 'ODS 15', 'B', 'Quadra', 'Q3', 'Prof. Quadra', 3),
('Projeto Q4', 'Projeto da Quadra 4', 'ODS 16', 'B', 'Quadra', 'Q4', 'Prof. Quadra', 4);

-- Biblioteca (sala do Bloco A)
INSERT INTO tbl_projetos (titulo_projeto, descricao_projeto, ods, bloco, sala, stand, prof_orientador, posicao_projeto) VALUES
('Projeto Biblioteca 1', 'Projeto na Biblioteca 1', 'ODS 1', 'A', 'Biblioteca', 'L1', 'Prof. Leitura', 1),
('Projeto Biblioteca 2', 'Projeto na Biblioteca 2', 'ODS 2', 'A', 'Biblioteca', 'L2', 'Prof. Leitura', 2);

-- Pátio (sala do Bloco A)
INSERT INTO tbl_projetos (titulo_projeto, descricao_projeto, ods, bloco, sala, stand, prof_orientador, posicao_projeto) VALUES
('Projeto Patio 1', 'Projeto no Pátio 1', 'ODS 3', 'A', 'Patio', 'P1', 'Prof. Campo', 1),
('Projeto Patio 2', 'Projeto no Pátio 2', 'ODS 4', 'A', 'Patio', 'P2', 'Prof. Campo', 2);

-- Auditório (sala do Bloco A) – com palestras
INSERT INTO tbl_projetos (titulo_projeto, descricao_projeto, ods, bloco, sala, stand, prof_orientador, posicao_projeto) VALUES
('Palestra 1', 'Tema: Sustentabilidade e Energia', 'ODS 7', 'B', 'Auditorio', 'AU1', 'Prof. Palestra', 1),
('Palestra 2', 'Tema: Inovação na Educação', 'ODS 4', 'B', 'Auditorio', 'AU2', 'Prof. Palestra', 2);