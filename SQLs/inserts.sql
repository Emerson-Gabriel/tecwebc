-- Copiando dados para a tabela sistematcc.aluno: 2 rows
/*!40000 ALTER TABLE `aluno` DISABLE KEYS */;
INSERT INTO `aluno` (`idAluno`, `nome`, `sexo`, `email`, `matricula`, `telefone`, `cpf`, `rg`, `orgaoExpeditor`, `created_at`, `updated_at`, `idCurso`) VALUES
	(1, 'Kamila Malaquias de Freitas', 'f', 'kamilanpmg@gmail.com', '11458514609-1', '(34) 9984-27543', '114.585.146-09', '00.000.000-0', 'SSP-MG', '2018-11-27 22:07:09', '2018-11-27 22:07:09', 1),
	(2, 'Bruno Weberty Silva Ribeiro', 'm', 'brunoweberty@hotmail.com', '11562476670-1', '(38) 9926-79242', NULL, NULL, NULL, '2018-11-27 22:20:28', '2018-11-27 22:20:28', 1);
/*!40000 ALTER TABLE `aluno` ENABLE KEYS */;

-- Copiando dados para a tabela sistematcc.alunoareainteresse: 2 rows
/*!40000 ALTER TABLE `alunoareainteresse` DISABLE KEYS */;
INSERT INTO `alunoareainteresse` (`idAluno`, `idAreaInteresse`) VALUES
	(1, 6),
	(2, 2);
/*!40000 ALTER TABLE `alunoareainteresse` ENABLE KEYS */;
-- Copiando dados para a tabela sistematcc.ano: 1 rows
/*!40000 ALTER TABLE `ano` DISABLE KEYS */;
INSERT INTO `ano` (`ano`) VALUES
	(2018);
/*!40000 ALTER TABLE `ano` ENABLE KEYS */;
/*!40000 ALTER TABLE `areainteresse` DISABLE KEYS */;
INSERT INTO `areainteresse` (`idAreaInteresse`, `nomeArea`, `created_at`, `updated_at`) VALUES
	(1, 'Inteligência Artificial', '2018-11-27 22:04:07', '2018-11-27 22:04:07'),
	(2, 'Engenharia de Software', '2018-11-27 22:04:16', '2018-11-27 22:04:16'),
	(3, 'Banco de Dados', '2018-11-27 22:04:25', '2018-11-27 22:04:25'),
	(4, 'Computação Gráfica', '2018-11-27 22:04:34', '2018-11-27 22:04:34'),
	(5, 'Redes de Computadores', '2018-11-27 22:04:46', '2018-11-27 22:04:46'),
	(6, 'Informática para Educação', '2018-11-27 22:05:24', '2018-11-27 22:05:24');
/*!40000 ALTER TABLE `areainteresse` ENABLE KEYS */;

/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` (`idCargo`, `nomeCargo`, `created_at`, `updated_at`) VALUES
	(1, 'Supervisor de TCC do curso de Tecnologia em Análise e Desenvolvimento de Sistemas', '2018-11-27 20:16:42', '2018-11-27 22:16:42'),
	(2, 'Coordenação de Curso', '2018-11-27 19:50:23', '2018-11-24 14:41:50'),
	(3, 'Coordenadora Geral de Ensino, Pesquisa e Extensão', '2018-11-27 19:50:24', '2018-11-24 15:59:21'),
	(4, 'Diretor Geral', '2018-11-27 19:50:24', '2018-11-24 15:59:39');
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;

INSERT INTO `chefia` (`idChefia`, `portaria`, `dataInicio`, `dataFinal`, `idCargo`, `idProfessor`, `created_at`, `updated_at`) VALUES
	(1, 'Portaria nº 64 de 08/08/2017', '2017-08-08', NULL, 1, 2, '2018-11-27 22:15:08', '2018-11-27 22:15:08');
/*!40000 ALTER TABLE `chefia` ENABLE KEYS */;

/*!40000 ALTER TABLE `conceito` DISABLE KEYS */;
INSERT INTO `conceito` (`idConceito`, `min`, `max`, `conceito`, `created_at`, `updated_at`) VALUES
	(1, 60.000000, 70.000000, 'C', '2018-11-27 19:51:26', '2018-07-19 18:55:13'),
	(2, 70.000000, 90.000000, 'B', '2018-11-27 19:51:28', '2018-07-19 18:52:04'),
	(3, 90.000000, 100.000000, 'A', '2018-11-27 19:51:28', '2018-10-12 19:28:39');
/*!40000 ALTER TABLE `conceito` ENABLE KEYS */;

/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`idCurso`, `nome`, `ppc`, `created_at`, `updated_at`) VALUES
	(1, 'Análise e Desenvolvimento de Sistemas', 'Resolução nº 06/201, de 05/03/2013', '2018-11-27 19:52:17', '2018-10-12 14:10:30');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
/*!40000 ALTER TABLE `formalizacao` DISABLE KEYS */;
INSERT INTO `formalizacao` (`idFormalizacao`, `ano`, `numero`, `titulo`, `anexoB`, `cancelada`, `idAluno`, `idAreaInteresse`, `idTipo`, `idProfessorOrientador`, `idProfessorCoorientador1`, `idProfessorCoorientador2`, `created_at`, `updated_at`, `finalizado`) VALUES
	(1, 2018, 6, 'Análise e Desenvolvimento de um Sistema Web para gerenciamento de Atividades Complementares', '222543201811275bfdc467b3068.pdf', 0, 2, 2, 1, 3, NULL, NULL, '2018-11-27 20:50:44', '2018-11-27 22:25:43', 0);
/*!40000 ALTER TABLE `formalizacao` ENABLE KEYS */;
/*!40000 ALTER TABLE `localprova` DISABLE KEYS */;
INSERT INTO `localprova` (`idLocal`, `descricao`, `created_at`, `updated_at`) VALUES
	(1, 'Unidade Patrocínio do INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO TRIÂNGULO MINEIRO', '2018-11-27 19:53:25', '2018-10-12 19:32:49');
/*!40000 ALTER TABLE `localprova` ENABLE KEYS */;

/*!40000 ALTER TABLE `marcacao` DISABLE KEYS */;
INSERT INTO `marcacao` (`idMarcacao`, `idLocal`, `anexoC`, `anexoG`, `dataHora`, `cancelada`, `created_at`, `updated_at`, `idFormalizacao`, `finalizado`) VALUES
	(1, 1, '224600201811275bfdc92832bfa.pdf', '224600201811275bfdc92836a7b.pdf', '2018-11-28 17:30:00', 0, '2018-11-27 22:46:00', '2018-11-27 22:46:00', 1, NULL);
/*!40000 ALTER TABLE `marcacao` ENABLE KEYS */;

/*!40000 ALTER TABLE `marcacaoprofessor` DISABLE KEYS */;
INSERT INTO `marcacaoprofessor` (`idProfessor`, `idMarcacao`, `presidente`, `created_at`, `updated_at`, `idMarcacaoProfessor`) VALUES
	(3, 1, 1, '2018-11-27 20:46:00', '2018-11-27 20:46:00', NULL),
	(1, 1, 0, '2018-11-27 20:46:00', '2018-11-27 20:46:00', NULL),
	(4, 1, 0, '2018-11-27 20:46:00', '2018-11-27 20:46:00', NULL);
/*!40000 ALTER TABLE `marcacaoprofessor` ENABLE KEYS */;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` (`idProfessor`, `nome`, `telefone`, `email`, `formacaoAcademica`, `lattes`, `created_at`, `updated_at`) VALUES
	(1, 'Matheus Araújo Aguiar', '(34) 9880-20702', 'matheusaguiar@iftm.edu.br', 'Mestre', 'http://lattes.cnpq.br/0645500458898282', '2018-11-27 20:10:10', '2018-11-27 20:10:10'),
	(2, 'Jean Lucas de Sousa', '(34) 9966-53855', 'jeansousa@iftm.edu.br', 'Mestre', 'http://lattes.cnpq.br/2845914099528408', '2018-11-27 20:13:40', '2018-11-27 20:13:40'),
	(3, 'Gilberto Viana de Oliveira', '(31) 9937-91833', 'gilbertooliveira@iftm.edu.br', 'Mestre', 'http://lattes.cnpq.br/7059390537752738', '2018-11-27 20:22:19', '2018-11-27 20:22:19'),
	(4, 'Danilo Costa das Chagas', '(34) 9887-94608', 'danilocosta@iftm.edu.br', 'Graduação', 'http://lattes.cnpq.br/8002562635021705', '2018-11-27 20:44:23', '2018-11-27 20:44:23');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;

/*!40000 ALTER TABLE `professorareainteresse` DISABLE KEYS */;
INSERT INTO `professorareainteresse` (`idAreaInteresse`, `idProfessor`) VALUES
	(1, 1),
	(1, 2),
	(2, 2),
	(2, 3),
	(2, 4),
	(3, 3),
	(6, 1);
-- Copiando estrutura para tabela sistematcc.tipotrabalho
/*!40000 ALTER TABLE `tipotrabalho` DISABLE KEYS */;
INSERT INTO `tipotrabalho` (`idTipo`, `nomeTipo`, `created_at`, `updated_at`) VALUES
	(1, 'Monografia', '2018-11-27 19:53:49', '2018-09-07 16:50:52'),
	(2, 'Estágio', '2018-11-27 19:53:50', '2018-09-07 16:51:07');
/*!40000 ALTER TABLE `tipotrabalho` ENABLE KEYS */;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Emerson Gabriel', 'zeca@gmail.com', '$2y$10$65Azn4DRZ0wV.LQ9RMeRwekxKC2GKl3BJgl9ElshxwY82m0MQUl2u', NULL, NULL, NULL),
	(2, 'Emerson Gabriel', 'emersong730@gmail.com', '$2y$10$BxBr9gOehZH2shJtygjwG.gHEHmiKQ4.bv1k6Utvjjdz1veJsVaOq', 'yErHr49q12LKnF7N5DNof4o6YrIevEdofXCmtxYlgR9UtTHyFTqFAq30INnl', '2018-09-21 00:29:31', '2018-09-21 00:29:31'),
	(3, 'Jean Lucas de Sousa', 'jeansousa@iftm.edu.br', '$2y$10$ArPaGbcN5jcHrV5uf8gpUeJTeTZa2QnuU58XlSOjE.YstdR5YIW.m', NULL, '2018-11-27 22:03:38', '2018-11-27 22:03:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;