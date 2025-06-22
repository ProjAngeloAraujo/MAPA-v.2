USE feira;

-- ✅ Bloco A – 8 salas, 2 projetos cada (16 total)
INSERT INTO `tbl_projetos` (`titulo_projeto`, `descricao_projeto`, `ods`, `bloco`, `sala`, `posicao_projeto`, `stand`, `prof_orientador`) VALUES
('Robótica Educacional', 'Iniciação à robótica com Arduino.', 'ODS 4', 'A', '1', 1, 'A1', 'Prof. Marcos'),
('Filtro de Água Natural', 'Purificação de água com carvão.', 'ODS 6', 'A', '1', 2, 'A2', 'Prof. Joana'),
('Casa Sustentável', 'Modelo de casa com energia solar.', 'ODS 7', 'A', '2', 3, 'A3', 'Prof. Luana'),
('Telhado Verde', 'Uso de plantas para isolamento térmico.', 'ODS 13', 'A', '2', 4, 'A4', 'Prof. Bruno'),
('Reciclagem Criativa', 'Objetos feitos com materiais recicláveis.', 'ODS 12', 'A', '3', 5, 'A5', 'Prof. Amanda'),
('Painel Solar Artesanal', 'Painel solar de baixo custo.', 'ODS 7', 'A', '3', 6, 'A6', 'Prof. Daniel'),
('Horta Escolar', 'Plantio de horta para merenda.', 'ODS 2', 'A', '4', 7, 'A7', 'Prof. Sofia'),
('Compostagem', 'Aproveitamento de resíduos orgânicos.', 'ODS 12', 'A', '4', 8, 'A8', 'Prof. Jorge'),
('Robô Seguidor de Linha', 'Robô que segue percurso programado.', 'ODS 9', 'A', '5', 9, 'A9', 'Prof. Lúcia'),
('Controle por Bluetooth', 'Automação com celular.', 'ODS 9', 'A', '5', 10, 'A10', 'Prof. Fábio'),
('Energias Renováveis', 'Comparativo de fontes limpas.', 'ODS 7', 'A', '6', 11, 'A11', 'Prof. Cláudia'),
('Lâmpadas LED', 'Eficiência energética.', 'ODS 7', 'A', '6', 12, 'A12', 'Prof. Eduardo'),
('Plásticos nos Oceanos', 'Impactos ambientais e soluções.', 'ODS 14', 'A', '7', 13, 'A13', 'Prof. Alice'),
('Despoluição da Água', 'Modelos de filtragem sustentável.', 'ODS 6', 'A', '7', 14, 'A14', 'Prof. Paulo'),
('Árvore da Vida', 'Ecossistemas brasileiros.', 'ODS 15', 'A', '8', 15, 'A15', 'Prof. Carla'),
('Vida na Floresta', 'Preservação da fauna e flora.', 'ODS 15', 'A', '8', 16, 'A16', 'Prof. Samuel');

-- ✅ Bloco B – 4 salas, 1 projeto cada (4 total)
INSERT INTO `tbl_projetos` (`titulo_projeto`, `descricao_projeto`, `ods`, `bloco`, `sala`, `posicao_projeto`, `stand`, `prof_orientador`) VALUES
('Inclusão Digital', 'Ensino de informática para idosos.', 'ODS 10', 'B', '1', 1, 'B1', 'Prof. Renata'),
('Aplicativo de Socorro', 'App de emergência com geolocalização.', 'ODS 3', 'B', '2', 2, 'B2', 'Prof. André'),
('App de Estudo', 'Aplicativo para reforço escolar.', 'ODS 4', 'B', '3', 3, 'B3', 'Prof. Tatiana'),
('Gestão de Água', 'Controle de consumo hídrico.', 'ODS 6', 'B', '4', 4, 'B4', 'Prof. Murilo');

-- ✅ Biblioteca – 1 projeto
INSERT INTO `tbl_projetos` (`titulo_projeto`, `descricao_projeto`, `ods`, `bloco`, `sala`, `posicao_projeto`, `stand`, `prof_orientador`) VALUES
('Biblioteca Inteligente', 'Sistema de gerenciamento com QR Code.', 'ODS 9', 'Biblioteca', '', 1, 'L1', 'Prof. Tereza');

-- ✅ Quadra – 32 projetos
INSERT INTO `tbl_projetos` (`titulo_projeto`, `descricao_projeto`, `ods`, `bloco`, `sala`, `posicao_projeto`, `stand`, `prof_orientador`) VALUES
('Atividade Física e Saúde', 'Aula prática com circuito funcional.', 'ODS 3', 'Quadra', '', 1, 'Q1', 'Prof. Bianca'),
('Esportes e Cooperação', 'Trabalho em equipe e valores humanos.', 'ODS 16', 'Quadra', '', 2, 'Q2', 'Prof. Igor'),
('Ginástica Funcional', 'Atividades físicas para adolescentes.', 'ODS 3', 'Quadra', '', 3, 'Q3', 'Prof. Bruna'),
('Alongamento e Bem-Estar', 'Rotina saudável para jovens.', 'ODS 3', 'Quadra', '', 4, 'Q4', 'Prof. Carlos'),
('Corrida de Orientação', 'Jogo com mapas e bússola.', 'ODS 4', 'Quadra', '', 5, 'Q5', 'Prof. Vitor'),
('Educação Física Inclusiva', 'Jogos adaptados para PCDs.', 'ODS 10', 'Quadra', '', 6, 'Q6', 'Prof. Elisa'),
('Treino de Agilidade', 'Atividades de desempenho físico.', 'ODS 3', 'Quadra', '', 7, 'Q7', 'Prof. Nádia'),
('Circuito Motor', 'Desenvolvimento físico infantil.', 'ODS 3', 'Quadra', '', 8, 'Q8', 'Prof. Jorge'),
('Capoeira e Cultura', 'Expressão corporal e tradição.', 'ODS 11', 'Quadra', '', 9, 'Q9', 'Prof. Ricardo'),
('Basquete 3x3', 'Modalidade esportiva para jovens.', 'ODS 3', 'Quadra', '', 10, 'Q10', 'Prof. Amanda'),
('Treinamento Funcional', 'Fortalecimento com pouco material.', 'ODS 3', 'Quadra', '', 11, 'Q11', 'Prof. Isabel'),
('Projeto Dança', 'Expressão corporal e ritmo.', 'ODS 4', 'Quadra', '', 12, 'Q12', 'Prof. Lucas'),
('Futebol Inclusivo', 'Esporte para todos.', 'ODS 10', 'Quadra', '', 13, 'Q13', 'Prof. Paula'),
('Queimada Cooperativa', 'Jogo sem eliminação.', 'ODS 16', 'Quadra', '', 14, 'Q14', 'Prof. Márcia'),
('Slackline', 'Equilíbrio e foco.', 'ODS 3', 'Quadra', '', 15, 'Q15', 'Prof. Nelson'),
('Jogo de Tabuleiro Vivo', 'Lúdico e educativo.', 'ODS 4', 'Quadra', '', 16, 'Q16', 'Prof. Camila'),
('Corda e Habilidades', 'Trabalho com cordas.', 'ODS 3', 'Quadra', '', 17, 'Q17', 'Prof. Tatiane'),
('Dança das Cadeiras com Valores', 'Atividade com reflexão.', 'ODS 16', 'Quadra', '', 18, 'Q18', 'Prof. Fernanda'),
('Brincadeiras Tradicionais', 'Cultura popular brasileira.', 'ODS 11', 'Quadra', '', 19, 'Q19', 'Prof. Gustavo'),
('Mini Atletismo', 'Corrida, salto e arremesso.', 'ODS 3', 'Quadra', '', 20, 'Q20', 'Prof. Vanessa'),
('Parkour Educativo', 'Exploração de movimento.', 'ODS 3', 'Quadra', '', 21, 'Q21', 'Prof. Pedro'),
('Pique-Bandeira Reflexivo', 'Jogo com reflexão.', 'ODS 16', 'Quadra', '', 22, 'Q22', 'Prof. Aline'),
('Esportes Alternativos', 'Tchoukball e outros.', 'ODS 3', 'Quadra', '', 23, 'Q23', 'Prof. Clarissa'),
('Dança Circular', 'Ritmo e união.', 'ODS 11', 'Quadra', '', 24, 'Q24', 'Prof. Fábio'),
('Treinamento de Resistência', 'Desafio de tempo e esforço.', 'ODS 3', 'Quadra', '', 25, 'Q25', 'Prof. Kelly'),
('Yoga Escolar', 'Postura, respiração e foco.', 'ODS 3', 'Quadra', '', 26, 'Q26', 'Prof. Clara'),
('Festival de Jogos', 'Exposição de atividades físicas.', 'ODS 4', 'Quadra', '', 27, 'Q27', 'Prof. Mateus'),
('Desafio do Equilíbrio', 'Atividade com cones e obstáculos.', 'ODS 3', 'Quadra', '', 28, 'Q28', 'Prof. Regina'),
('Mini Gincana', 'Provas rápidas em grupo.', 'ODS 16', 'Quadra', '', 29, 'Q29', 'Prof. Felipe'),
('Circuito Funcional Lúdico', 'Para crianças.', 'ODS 3', 'Quadra', '', 30, 'Q30', 'Prof. Tamires'),
('Esporte e Reciclagem', 'Jogos com material reciclado.', 'ODS 12', 'Quadra', '', 31, 'Q31', 'Prof. Henrique'),
('Equilíbrio e Foco', 'Técnicas de concentração.', 'ODS 3', 'Quadra', '', 32, 'Q32', 'Prof. Bianca');

-- ✅ Auditório – 1 projeto principal + 5 palestras
INSERT INTO `tbl_projetos` (`titulo_projeto`, `descricao_projeto`, `ods`, `bloco`, `sala`, `posicao_projeto`, `stand`, `prof_orientador`) VALUES
('Palestra: Sustentabilidade', 'Apresentação sobre consumo consciente.', 'ODS 12', 'Auditorio', '', 1, 'AD1', 'Prof. Gustavo'),
('Palestra: Mudanças Climáticas', 'Como o aquecimento global afeta o planeta.', 'ODS 13', 'Auditorio', '', 2, 'AD2', 'Prof. Ana Paula'),
('Palestra: Mulheres na Tecnologia', 'Desafios e oportunidades para meninas em STEM.', 'ODS 5', 'Auditorio', '', 3, 'AD3', 'Prof. Camila'),
('Palestra: Empreendedorismo Jovem', 'Como transformar ideias em negócios.', 'ODS 8', 'Auditorio', '', 4, 'AD4', 'Prof. Rafael'),
('Palestra: Direitos Humanos', 'Discutindo igualdade, liberdade e respeito.', 'ODS 16', 'Auditorio', '', 5, 'AD5', 'Prof. Juliana');
