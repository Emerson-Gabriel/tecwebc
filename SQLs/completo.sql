-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.20 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5284
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela sistematcc.aluno
CREATE TABLE IF NOT EXISTS `aluno` (
  `idAluno` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `matricula` varchar(100) NOT NULL,
  `telefone` varchar(100) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `rg` varchar(50) DEFAULT NULL,
  `orgaoExpeditor` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `idCurso` int(11) NOT NULL,
  PRIMARY KEY (`idAluno`),
  UNIQUE KEY `idAluno` (`idAluno`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.aluno: 2 rows
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
INSERT INTO `aluno` (`idAluno`, `nome`, `sexo`, `email`, `matricula`, `telefone`, `cpf`, `rg`, `orgaoExpeditor`, `created_at`, `updated_at`, `idCurso`) VALUES
	(1, 'Kamila Malaquias de Freitas', 'f', 'kamilanpmg@gmail.com', '11458514609-1', '(34) 9984-27543', '114.585.146-09', '00.000.000-0', 'SSP-MG', '2018-11-27 22:07:09', '2018-11-27 22:07:09', 1),
	(2, 'Bruno Weberty Silva Ribeiro', 'm', 'brunoweberty@hotmail.com', '11562476670-1', '(38) 9926-79242', NULL, NULL, NULL, '2018-11-27 22:20:28', '2018-11-27 22:20:28', 1);
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.alunoareainteresse
CREATE TABLE IF NOT EXISTS `alunoareainteresse` (
  `idAluno` int(11) NOT NULL,
  `idAreaInteresse` int(11) NOT NULL,
  PRIMARY KEY (`idAluno`,`idAreaInteresse`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.alunoareainteresse: 2 rows
/*!40000 ALTER TABLE `alunoareainteresse` DISABLE KEYS */;
INSERT INTO `alunoareainteresse` (`idAluno`, `idAreaInteresse`) VALUES
	(1, 6),
	(2, 2);
/*!40000 ALTER TABLE `alunoareainteresse` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.ano
CREATE TABLE IF NOT EXISTS `ano` (
  `ano` int(11) NOT NULL,
  PRIMARY KEY (`ano`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.ano: 1 rows
/*!40000 ALTER TABLE `ano` DISABLE KEYS */;
INSERT INTO `ano` (`ano`) VALUES
	(2018);
/*!40000 ALTER TABLE `ano` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.areainteresse
CREATE TABLE IF NOT EXISTS `areainteresse` (
  `idAreaInteresse` int(11) NOT NULL AUTO_INCREMENT,
  `nomeArea` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idAreaInteresse`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.areainteresse: 6 rows
/*!40000 ALTER TABLE `areainteresse` DISABLE KEYS */;
INSERT INTO `areainteresse` (`idAreaInteresse`, `nomeArea`, `created_at`, `updated_at`) VALUES
	(1, 'Inteligência Artificial', '2018-11-27 22:04:07', '2018-11-27 22:04:07'),
	(2, 'Engenharia de Software', '2018-11-27 22:04:16', '2018-11-27 22:04:16'),
	(3, 'Banco de Dados', '2018-11-27 22:04:25', '2018-11-27 22:04:25'),
	(4, 'Computação Gráfica', '2018-11-27 22:04:34', '2018-11-27 22:04:34'),
	(5, 'Redes de Computadores', '2018-11-27 22:04:46', '2018-11-27 22:04:46'),
	(6, 'Informática para Educação', '2018-11-27 22:05:24', '2018-11-27 22:05:24');
/*!40000 ALTER TABLE `areainteresse` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `idCargo` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCargo` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idCargo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.cargo: 4 rows
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` (`idCargo`, `nomeCargo`, `created_at`, `updated_at`) VALUES
	(1, 'Supervisor de TCC do curso de Tecnologia em Análise e Desenvolvimento de Sistemas', '2018-11-27 20:16:42', '2018-11-27 22:16:42'),
	(2, 'Coordenação de Curso', '2018-11-27 19:50:23', '2018-11-24 14:41:50'),
	(3, 'Coordenadora Geral de Ensino, Pesquisa e Extensão', '2018-11-27 19:50:24', '2018-11-24 15:59:21'),
	(4, 'Diretor Geral', '2018-11-27 19:50:24', '2018-11-24 15:59:39');
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.chefia
CREATE TABLE IF NOT EXISTS `chefia` (
  `idChefia` int(11) NOT NULL AUTO_INCREMENT,
  `portaria` varchar(100) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFinal` date DEFAULT NULL,
  `idCargo` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idChefia`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.chefia: 1 rows
/*!40000 ALTER TABLE `chefia` DISABLE KEYS */;
INSERT INTO `chefia` (`idChefia`, `portaria`, `dataInicio`, `dataFinal`, `idCargo`, `idProfessor`, `created_at`, `updated_at`) VALUES
	(1, 'Portaria nº 64 de 08/08/2017', '2017-08-08', NULL, 1, 2, '2018-11-27 22:15:08', '2018-11-27 22:15:08');
/*!40000 ALTER TABLE `chefia` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.conceito
CREATE TABLE IF NOT EXISTS `conceito` (
  `idConceito` int(11) NOT NULL AUTO_INCREMENT,
  `min` double(20,6) NOT NULL,
  `max` double(20,6) NOT NULL,
  `conceito` char(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idConceito`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.conceito: 3 rows
/*!40000 ALTER TABLE `conceito` DISABLE KEYS */;
INSERT INTO `conceito` (`idConceito`, `min`, `max`, `conceito`, `created_at`, `updated_at`) VALUES
	(1, 60.000000, 70.000000, 'C', '2018-11-27 19:51:26', '2018-07-19 18:55:13'),
	(2, 70.000000, 90.000000, 'B', '2018-11-27 19:51:28', '2018-07-19 18:52:04'),
	(3, 90.000000, 100.000000, 'A', '2018-11-27 19:51:28', '2018-10-12 19:28:39');
/*!40000 ALTER TABLE `conceito` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.curso
CREATE TABLE IF NOT EXISTS `curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `ppc` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idCurso`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.curso: 1 rows
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`idCurso`, `nome`, `ppc`, `created_at`, `updated_at`) VALUES
	(1, 'Análise e Desenvolvimento de Sistemas', 'Resolução nº 06/201, de 05/03/2013', '2018-11-27 19:52:17', '2018-10-12 14:10:30');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.finalizacao
CREATE TABLE IF NOT EXISTS `finalizacao` (
  `idMarcacao` int(11) NOT NULL,
  `idConceito` int(11) NOT NULL,
  `nota` double(20,6) NOT NULL,
  `tituloFinal` varchar(255) NOT NULL,
  `anexoI` varchar(255) DEFAULT NULL,
  `finalizado` int(11) DEFAULT NULL,
  `dataFinalizacao` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idMarcacao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.finalizacao: 0 rows
/*!40000 ALTER TABLE `finalizacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `finalizacao` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.formalizacao
CREATE TABLE IF NOT EXISTS `formalizacao` (
  `idFormalizacao` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `anexoB` varchar(255) DEFAULT NULL,
  `cancelada` int(11) DEFAULT NULL,
  `idAluno` int(11) NOT NULL,
  `idAreaInteresse` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `idProfessorOrientador` int(11) NOT NULL,
  `idProfessorCoorientador1` int(11) DEFAULT NULL,
  `idProfessorCoorientador2` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `finalizado` int(11) DEFAULT '0',
  PRIMARY KEY (`idFormalizacao`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.formalizacao: 1 rows
/*!40000 ALTER TABLE `formalizacao` DISABLE KEYS */;
INSERT INTO `formalizacao` (`idFormalizacao`, `ano`, `numero`, `titulo`, `anexoB`, `cancelada`, `idAluno`, `idAreaInteresse`, `idTipo`, `idProfessorOrientador`, `idProfessorCoorientador1`, `idProfessorCoorientador2`, `created_at`, `updated_at`, `finalizado`) VALUES
	(1, 2018, 6, 'Análise e Desenvolvimento de um Sistema Web para gerenciamento de Atividades Complementares', '222543201811275bfdc467b3068.pdf', 0, 2, 2, 1, 3, NULL, NULL, '2018-11-27 20:50:44', '2018-11-27 22:25:43', 0);
/*!40000 ALTER TABLE `formalizacao` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.localprova
CREATE TABLE IF NOT EXISTS `localprova` (
  `idLocal` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idLocal`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.localprova: 1 rows
/*!40000 ALTER TABLE `localprova` DISABLE KEYS */;
INSERT INTO `localprova` (`idLocal`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 'Unidade Patrocínio do INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO TRIÂNGULO MINEIRO', '2018-11-27 19:53:25', '2018-10-12 19:32:49');
/*!40000 ALTER TABLE `localprova` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.marcacao
CREATE TABLE IF NOT EXISTS `marcacao` (
  `idMarcacao` int(11) NOT NULL AUTO_INCREMENT,
  `idLocal` int(11) NOT NULL,
  `anexoC` varchar(255) NOT NULL,
  `anexoG` varchar(255) NOT NULL,
  `dataHora` datetime NOT NULL,
  `cancelada` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `idFormalizacao` int(11) DEFAULT NULL,
  `finalizado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMarcacao`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.marcacao: 0 rows
/*!40000 ALTER TABLE `marcacao` DISABLE KEYS */;
INSERT INTO `marcacao` (`idMarcacao`, `idLocal`, `anexoC`, `anexoG`, `dataHora`, `cancelada`, `created_at`, `updated_at`, `idFormalizacao`, `finalizado`) VALUES
	(1, 1, '224600201811275bfdc92832bfa.pdf', '224600201811275bfdc92836a7b.pdf', '2018-11-28 17:30:00', 0, '2018-11-27 22:46:00', '2018-11-27 22:46:00', 1, NULL);
/*!40000 ALTER TABLE `marcacao` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.marcacaoprofessor
CREATE TABLE IF NOT EXISTS `marcacaoprofessor` (
  `idProfessor` int(11) NOT NULL,
  `idMarcacao` int(11) NOT NULL,
  `presidente` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idMarcacaoProfessor` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProfessor`,`idMarcacao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.marcacaoprofessor: 0 rows
/*!40000 ALTER TABLE `marcacaoprofessor` DISABLE KEYS */;
INSERT INTO `marcacaoprofessor` (`idProfessor`, `idMarcacao`, `presidente`, `created_at`, `updated_at`, `idMarcacaoProfessor`) VALUES
	(3, 1, 1, '2018-11-27 20:46:00', '2018-11-27 20:46:00', NULL),
	(1, 1, 0, '2018-11-27 20:46:00', '2018-11-27 20:46:00', NULL),
	(4, 1, 0, '2018-11-27 20:46:00', '2018-11-27 20:46:00', NULL);
/*!40000 ALTER TABLE `marcacaoprofessor` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sistematcc.migrations: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.professor
CREATE TABLE IF NOT EXISTS `professor` (
  `idProfessor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `formacaoAcademica` varchar(255) NOT NULL,
  `lattes` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idProfessor`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.professor: 3 rows
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` (`idProfessor`, `nome`, `telefone`, `email`, `formacaoAcademica`, `lattes`, `created_at`, `updated_at`) VALUES
	(1, 'Matheus Araújo Aguiar', '(34) 9880-20702', 'matheusaguiar@iftm.edu.br', 'Mestre', 'http://lattes.cnpq.br/0645500458898282', '2018-11-27 20:10:10', '2018-11-27 20:10:10'),
	(2, 'Jean Lucas de Sousa', '(34) 9966-53855', 'jeansousa@iftm.edu.br', 'Mestre', 'http://lattes.cnpq.br/2845914099528408', '2018-11-27 20:13:40', '2018-11-27 20:13:40'),
	(3, 'Gilberto Viana de Oliveira', '(31) 9937-91833', 'gilbertooliveira@iftm.edu.br', 'Mestre', 'http://lattes.cnpq.br/7059390537752738', '2018-11-27 20:22:19', '2018-11-27 20:22:19'),
	(4, 'Danilo Costa das Chagas', '(34) 9887-94608', 'danilocosta@iftm.edu.br', 'Graduação', 'http://lattes.cnpq.br/8002562635021705', '2018-11-27 20:44:23', '2018-11-27 20:44:23');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.professorareainteresse
CREATE TABLE IF NOT EXISTS `professorareainteresse` (
  `idAreaInteresse` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  PRIMARY KEY (`idAreaInteresse`,`idProfessor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.professorareainteresse: 6 rows
/*!40000 ALTER TABLE `professorareainteresse` DISABLE KEYS */;
INSERT INTO `professorareainteresse` (`idAreaInteresse`, `idProfessor`) VALUES
	(1, 1),
	(1, 2),
	(2, 2),
	(2, 3),
	(2, 4),
	(3, 3),
	(6, 1);
/*!40000 ALTER TABLE `professorareainteresse` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.tipotrabalho
CREATE TABLE IF NOT EXISTS `tipotrabalho` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTipo` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idTipo`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.tipotrabalho: 2 rows
/*!40000 ALTER TABLE `tipotrabalho` DISABLE KEYS */;
INSERT INTO `tipotrabalho` (`idTipo`, `nomeTipo`, `created_at`, `updated_at`) VALUES
	(1, 'Monografia', '2018-11-27 19:53:49', '2018-09-07 16:50:52'),
	(2, 'Estágio', '2018-11-27 19:53:50', '2018-09-07 16:51:07');
/*!40000 ALTER TABLE `tipotrabalho` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sistematcc.users: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Emerson Gabriel', 'zeca@gmail.com', '$2y$10$65Azn4DRZ0wV.LQ9RMeRwekxKC2GKl3BJgl9ElshxwY82m0MQUl2u', NULL, NULL, NULL),
	(2, 'Emerson Gabriel', 'emersong730@gmail.com', '$2y$10$BxBr9gOehZH2shJtygjwG.gHEHmiKQ4.bv1k6Utvjjdz1veJsVaOq', 'yErHr49q12LKnF7N5DNof4o6YrIevEdofXCmtxYlgR9UtTHyFTqFAq30INnl', '2018-09-21 00:29:31', '2018-09-21 00:29:31'),
	(3, 'Jean Lucas de Sousa', 'jeansousa@iftm.edu.br', '$2y$10$ArPaGbcN5jcHrV5uf8gpUeJTeTZa2QnuU58XlSOjE.YstdR5YIW.m', NULL, '2018-11-27 22:03:38', '2018-11-27 22:03:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Copiando estrutura para tabela sistematcc.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.usuario: 0 rows
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
