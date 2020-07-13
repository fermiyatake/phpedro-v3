-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 13-Jul-2020 às 13:01
-- Versão do servidor: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bancophp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

CREATE TABLE `perfis` (
  `id` int(11) NOT NULL COMMENT 'Chave primária de perfil',
  `nome` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`id`, `nome`) VALUES
(1, 'Padrão'),
(2, 'Administrador'),
(3, 'Recursos Humanos'),
(4, 'Logística');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL COMMENT 'Chave primária da relação usuários',
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nome do usuário',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email do usuário',
  `senha` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Senha do usuário',
  `id_perfil` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `id_perfil`) VALUES
(36, 'Chris Skibbe', 'sordadinho12@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 4),
(37, 'Andre Henrique', 'andrezz@gmail.com', '01cfcd4f6b8770febfb40cb906715822', 4),
(40, 'Fernando Miyatake', 'nando@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 4),
(41, 'Enzo Ribeiro', 'enzo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2),
(43, 'Jose Augusto', 'jose@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2),
(44, 'Fernando Souza', 'fernandinhobb@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(48, 'John Wick', 'john@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3),
(47, 'Wendel Bezerra', 'wendel@gmail.com', '07dbd9a180c7cc69cada7b982c5ae82c', 3),
(51, 'Jonas Melo', 'jonas@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2),
(52, 'Douglas Prado', 'douglas@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 2),
(53, 'Mariangela Molina', 'mariangela@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 4),
(54, 'Mariana Lima', 'mariana@gmail.com', '25d55ad283aa400af464c76d713c07ad', 2),
(57, 'Frare Junior', 'frare@fatec.com', '25d55ad283aa400af464c76d713c07ad', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `perfis`
--
ALTER TABLE `perfis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usu_perfil_fk` (`id_perfil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perfis`
--
ALTER TABLE `perfis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave primária de perfil', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave primária da relação usuários', AUTO_INCREMENT=61;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
