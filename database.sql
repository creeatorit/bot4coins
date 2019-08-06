/*
-------------------------------------------------------------
# INFORMAÇÕES GERAIS DO USUÁRIO
-------------------------------------------------------------
*/
CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`nome` varchar(100) NOT NULL,
    `sobrenome` varchar(100) NOT NULL,
	`email` varchar(100) NOT NULL,
	`senha` varchar(100) NOT NULL,
	`telefone` varchar(100) NOT NULL,
	`foto` varchar(100) NOT NULL,
	`cep` varchar(100) NOT NULL,
	`endereco` varchar(100) NOT NULL,
	`numero` varchar(10) NOT NULL,
	`complemento` varchar(50) NOT NULL,
	`bairro` varchar(100) NOT NULL,
	`cidade` varchar(100) NOT NULL,
	`estado` varchar(100) NOT NULL,
	`banco` varchar(100) NOT NULL,
	`agencia` varchar(100) NOT NULL,
	`conta` varchar(100) NOT NULL,
	`conta_tipo` varchar(100) NOT NULL,
	`status` tinyint(1) NOT NULL,
	`observacoes` varchar(500) NOT NULL,
    `nivel` int(1) NOT NULL,
	`hr_cadastro` time NOT NULL,
	`dt_cadastro` date NOT NULL
	) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `depositos` (
`id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`usuario` int(11) NOT NULL,
	`dt_solicitacao` date NOT NULL,
    `valor` varchar(100) NOT NULL,    
	`boleto` varchar(100) NOT NULL,
	`dt_vencimento` varchar(100) NOT NULL,
	`dt_pagamento` varchar(100) NOT NULL,
	`status` tinyint(1) NOT NULL
	) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `saques` (
`id` int(11) PRIMARY KEY AUTO_INCREMENT,
	`usuario` int(11) NOT NULL,
	`dt_saque` date NOT NULL,
	`dt_referencia` varchar(100) NOT NULL,
    `valor` varchar(100) NOT NULL,    
	`comprovante` varchar(100) NOT NULL,
	`status` tinyint(1) NOT NULL
	) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
