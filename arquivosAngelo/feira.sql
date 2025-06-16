-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para feira
CREATE DATABASE IF NOT EXISTS `feira` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `feira`;

-- Copiando estrutura para tabela feira.tbl_alunos
CREATE TABLE IF NOT EXISTS `tbl_alunos` (
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `rm` varchar(5) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `serie` enum('1','2','3') NOT NULL,
  `curso` varchar(50) NOT NULL,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tbl_projetos
CREATE TABLE IF NOT EXISTS `tbl_projetos` (
  `id_projetos` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_projeto` varchar(100) NOT NULL,
  `descricao_projeto` varchar(255) NOT NULL,
  `ods` varchar(100) NOT NULL,
  `bloco` enum('A','B') NOT NULL,
  `sala` varchar(20) NOT NULL,
  `posicao_projeto` int(11) NOT NULL,
  `stand` varchar(3) NOT NULL,
  `prof_orientador` varchar(100) NOT NULL,
  PRIMARY KEY (`id_projetos`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `data_nasc` date NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tb_creditos
CREATE TABLE IF NOT EXISTS `tb_creditos` (
  `id_dev` int(11) NOT NULL AUTO_INCREMENT,
  `nome_dev` varchar(128) NOT NULL,
  `cargo_dev` varchar(128) NOT NULL,
  `foto_dev` varchar(128) NOT NULL,
  `linkedin_dev` varchar(255) DEFAULT NULL,
  `github_dev` varchar(255) NOT NULL,
  PRIMARY KEY (`id_dev`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tb_feedback
CREATE TABLE IF NOT EXISTS `tb_feedback` (
  `id_feedback` int(4) NOT NULL AUTO_INCREMENT,
  `id_users` int(4) NOT NULL,
  `nota` int(1) NOT NULL,
  `comentario` varchar(400) DEFAULT NULL,
  `data_envio` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_feedback`),
  KEY `id_users` (`id_users`),
  CONSTRAINT `tb_feedback_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tbl_users` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tb_integrantes
CREATE TABLE IF NOT EXISTS `tb_integrantes` (
  `id_projetos` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  KEY `id_projetos_integrantes` (`id_projetos`),
  KEY `id_alunos_integrantes` (`id_aluno`),
  CONSTRAINT `id_alunos_integrantes` FOREIGN KEY (`id_aluno`) REFERENCES `tbl_alunos` (`id_aluno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_projetos_integrantes` FOREIGN KEY (`id_projetos`) REFERENCES `tbl_projetos` (`id_projetos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela feira.tb_votos
CREATE TABLE IF NOT EXISTS `tb_votos` (
  `id_votos` int(11) NOT NULL AUTO_INCREMENT,
  `dt_hora_voto` datetime NOT NULL,
  `valor_voto` int(11) NOT NULL,
  `coment_voto` varchar(200) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_projetos` int(11) NOT NULL,
  PRIMARY KEY (`id_votos`),
  KEY `id_projetos` (`id_projetos`),
  KEY `id_users` (`id_user`),
  CONSTRAINT `id_projetos` FOREIGN KEY (`id_projetos`) REFERENCES `tbl_projetos` (`id_projetos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_users` FOREIGN KEY (`id_user`) REFERENCES `tbl_users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportação de dados foi desmarcado.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
