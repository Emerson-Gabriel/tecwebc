-- Copiando estrutura do banco de dados para sistematcc
CREATE DATABASE IF NOT EXISTS `sistematcc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sistematcc`;

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
-- Copiando estrutura para tabela sistematcc.alunoareainteresse
CREATE TABLE IF NOT EXISTS `alunoareainteresse` (
  `idAluno` int(11) NOT NULL,
  `idAreaInteresse` int(11) NOT NULL,
  PRIMARY KEY (`idAluno`,`idAreaInteresse`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.alunoareainteresse: 2 rows

-- Copiando estrutura para tabela sistematcc.ano
CREATE TABLE IF NOT EXISTS `ano` (
  `ano` int(11) NOT NULL,
  PRIMARY KEY (`ano`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.ano: 1 rows
CREATE TABLE IF NOT EXISTS `areainteresse` (
  `idAreaInteresse` int(11) NOT NULL AUTO_INCREMENT,
  `nomeArea` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idAreaInteresse`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.areainteresse: 6 rows
-- Copiando estrutura para tabela sistematcc.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `idCargo` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCargo` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idCargo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


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

-- Copiando estrutura para tabela sistematcc.localprova
CREATE TABLE IF NOT EXISTS `localprova` (
  `idLocal` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idLocal`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.localprova: 1 rows
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


-- Copiando estrutura para tabela sistematcc.professorareainteresse
CREATE TABLE IF NOT EXISTS `professorareainteresse` (
  `idAreaInteresse` int(11) NOT NULL,
  `idProfessor` int(11) NOT NULL,
  PRIMARY KEY (`idAreaInteresse`,`idProfessor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Copiando estrutura para tabela sistematcc.tipotrabalho
CREATE TABLE IF NOT EXISTS `tipotrabalho` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTipo` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idTipo`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sistematcc.tipotrabalho: 2 rows

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
