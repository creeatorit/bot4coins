-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 07-Ago-2019 às 21:32
-- Versão do servidor: 5.7.24
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bot4coins`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `depositos`
--

DROP TABLE IF EXISTS `depositos`;
CREATE TABLE IF NOT EXISTS `depositos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `dt_solicitacao` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `boleto` varchar(255) DEFAULT NULL,
  `dt_vencimento` varchar(100) NOT NULL,
  `dt_pagamento` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `depositos`
--

INSERT INTO `depositos` (`id`, `usuario`, `dt_solicitacao`, `valor`, `boleto`, `dt_vencimento`, `dt_pagamento`, `status`) VALUES
(3, 2, '2019-08-07', '1450.20', '00f671a60dc39ae95dd7d68ea675e6b3.pdf', '2019-12-10', '-', 4),
(4, 2, '2019-08-07', '650.80', '9c9615540699791744cd285e73df5faf.pdf', '2019-10-10', '-', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `saques`
--

DROP TABLE IF EXISTS `saques`;
CREATE TABLE IF NOT EXISTS `saques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `dt_saque` date NOT NULL,
  `dt_referencia` varchar(100) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `comprovante` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `saques`
--

INSERT INTO `saques` (`id`, `usuario`, `dt_saque`, `dt_referencia`, `valor`, `comprovante`, `status`) VALUES
(1, 2, '2019-08-07', '2019-08-05', '1000.00', 'imagem.jpg', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `nascimento` date DEFAULT NULL,
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
  `dt_cadastro` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `email`, `senha`, `telefone`, `nascimento`, `foto`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `banco`, `agencia`, `conta`, `conta_tipo`, `status`, `observacoes`, `nivel`, `hr_cadastro`, `dt_cadastro`) VALUES
(1, 'Rafael', 'J', 'rafa.jefer@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '110000000000000', NULL, 'photo_user_1.jpg', '000-00011', 'Rua a', '00', 'casa 1', 'teste', 'teste', 'teste', '0001 - Banco do Brasil SA', '1234', '12345678-9', '013', 1, 'teste', 100, '08:38:56', '2019-08-07'),
(2, 'José', 'paulo da silva', 'teste@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '110000000000000', NULL, 'photo_user_2.jpg', '000-00011', 'Rua a', '00', 'casa 1', 'teste', 'teste', 'teste', '0001 - Banco do Brasil SA', '1234', '12345678-9', '013', 1, 'teste', 1, '08:38:56', '2019-08-07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
