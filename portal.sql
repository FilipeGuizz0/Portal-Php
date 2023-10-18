-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 05/04/2023 às 22h14min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `portal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`codigo`, `nome`) VALUES
(1, 'Esporte'),
(2, 'Politica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `colunistas`
--

CREATE TABLE IF NOT EXISTS `colunistas` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `login` varchar(20) CHARACTER SET latin1 NOT NULL,
  `senha` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `colunistas`
--

INSERT INTO `colunistas` (`codigo`, `nome`, `email`, `login`, `senha`) VALUES
(1, 'Diogo Kulckamp', 'diogokulckamp@gmail.com', 'Diogo.ka', 'diogo1234'),
(2, 'Filipe Guizzo', 'filipeguizzo@gmail.com', 'filipe.gs', 'filipe1234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materias`
--

CREATE TABLE IF NOT EXISTS `materias` (
  `codigo` int(5) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `codregiao` int(5) NOT NULL,
  `codcategoria` int(5) NOT NULL,
  `codcolunista` int(5) NOT NULL,
  `chamada` varchar(100) CHARACTER SET latin1 NOT NULL,
  `resumo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `materia` longtext CHARACTER SET latin1 NOT NULL,
  `fotochamada` varchar(100) CHARACTER SET latin1 NOT NULL,
  `foto1` varchar(100) CHARACTER SET latin1 NOT NULL,
  `foto2` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codregiao` (`codregiao`),
  KEY `codcategoria` (`codcategoria`),
  KEY `codcolunista` (`codcolunista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `materias`
--

INSERT INTO `materias` (`codigo`, `data`, `hora`, `codregiao`, `codcategoria`, `codcolunista`, `chamada`, `resumo`, `materia`, `fotochamada`, `foto1`, `foto2`) VALUES
(1, '2023-04-10', '16:57:00', 1, 1, 1, 'hgkl', 'jgklkl', 'gsfdgfd', 'fotos/hgj.jfif', 'fotos/hgj.jfif', 'fotos/hgj.jfif');

-- --------------------------------------------------------

--
-- Estrutura da tabela `regiao`
--

CREATE TABLE IF NOT EXISTS `regiao` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `regiao`
--

INSERT INTO `regiao` (`codigo`, `nome`) VALUES
(1, 'Criciúma'),
(2, 'Forquilhinha');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`codregiao`) REFERENCES `regiao` (`codigo`),
  ADD CONSTRAINT `materias_ibfk_2` FOREIGN KEY (`codcategoria`) REFERENCES `categorias` (`codigo`),
  ADD CONSTRAINT `materias_ibfk_3` FOREIGN KEY (`codcolunista`) REFERENCES `colunistas` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
