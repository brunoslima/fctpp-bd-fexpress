-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 10-Jul-2016 às 22:36
-- Versão do servidor: 5.6.12-log
-- versão do PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `foodexpress`
--
CREATE DATABASE IF NOT EXISTS `foodexpress` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `foodexpress`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `agricultor`
--

CREATE TABLE IF NOT EXISTS `agricultor` (
  `idAgricultor` decimal(14) NOT NULL,
  PRIMARY KEY (`idAgricultor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auxiliarlimpeza`
--

CREATE TABLE IF NOT EXISTS `auxiliarlimpeza` (
  `setor` varchar(45) DEFAULT NULL,
  `idAuxiliarLimpeza` int(11) NOT NULL,
  PRIMARY KEY (`idAuxiliarLimpeza`),
  KEY `fk_AuxiliarLimpeza_funcionario1_idx` (`idAuxiliarLimpeza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE IF NOT EXISTS `cidade` (
  `idCidade` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `pais` varchar(45) NOT NULL,
  PRIMARY KEY (`idCidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `deposito`
--

CREATE TABLE IF NOT EXISTS `deposito` (
  `numero` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `capacidade` float DEFAULT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `cnpj` int(11) NOT NULL,
  `proprietario` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `chaveAcesso` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `fkEndereco` int(11) NOT NULL,
  PRIMARY KEY (`cnpj`),
  KEY `fk_Empresa_Endereco1_idx` (`fkEndereco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomenda`
--

CREATE TABLE IF NOT EXISTS `encomenda` (
  `idEncomenda` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `fkPagamento` int(11) NOT NULL,
  `fkViagem` int(11) NOT NULL,
  `fkEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`idEncomenda`),
  KEY `fk_Encomenda_Pagamento1_idx` (`fkPagamento`),
  KEY `fk_Encomenda_Viagem1_idx` (`fkViagem`),
  KEY `fk_Encomenda_Empresa1_idx` (`fkEmpresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomespec`
--

CREATE TABLE IF NOT EXISTS `encomespec` (
  `idEncomenda` int(11) NOT NULL,
  `idEspecProduto` int(11) NOT NULL,
  PRIMARY KEY (`idEncomenda`,`idEspecProduto`),
  KEY `fk_Encomenda_has_EspecProduto_EspecProduto1_idx` (`idEspecProduto`),
  KEY `fk_Encomenda_has_EspecProduto_Encomenda1_idx` (`idEncomenda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE IF NOT EXISTS `endereco` (
  `idEndereco` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(45) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `fkCidade` int(11) NOT NULL,
  PRIMARY KEY (`idEndereco`),
  KEY `fk_Endereco_Cidade_idx` (`fkCidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `especproduto`
--

CREATE TABLE IF NOT EXISTS `especproduto` (
  `idEspecProduto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  PRIMARY KEY (`idEspecProduto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fabrica`
--

CREATE TABLE IF NOT EXISTS `fabrica` (
  `idFabrica` decimal(14) NOT NULL,
  PRIMARY KEY (`idFabrica`),
  KEY `fk_Fabrica_Fornecedor1_idx` (`idFabrica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE IF NOT EXISTS `fornecedor` (
  `cnpj` decimal(14) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `codigo` decimal(3,0) NOT NULL,
  `area` decimal(2,0) NOT NULL,
  `numero` decimal(9,0) NOT NULL,
  `fkEndereco` int(11) NOT NULL,
  PRIMARY KEY (`cnpj`),
  KEY `fk_Fornecedor_Endereco1_idx` (`fkEndereco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `idfuncionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `salario` float NOT NULL,
  `dataContratacao` date DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  PRIMARY KEY (`idfuncionario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idfuncionario`, `nome`, `salario`, `dataContratacao`, `dataNascimento`) VALUES
(1, 'Administrador', 0, '2016-07-07', '2016-07-01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gerente`
--

CREATE TABLE IF NOT EXISTS `gerente` (
  `email` varchar(45) NOT NULL,
  `login` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `idGerente` int(11) NOT NULL,
  PRIMARY KEY (`idGerente`),
  KEY `fk_Gerente_funcionario1_idx` (`idGerente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `gerente`
--

INSERT INTO `gerente` (`email`, `login`, `senha`, `idGerente`) VALUES
('admin@admin.com', 'admin@foodexpress.com', 'admin', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `codProduto` int(11) NOT NULL,
  `cnpjFornecedor` decimal(14) NOT NULL,
  `quantidade` float NOT NULL,
  `precoTotal` float NOT NULL,
  PRIMARY KEY (`codProduto`,`cnpjFornecedor`),
  KEY `fk_Produto_has_Fornecedor_Fornecedor1_idx` (`cnpjFornecedor`),
  KEY `fk_Produto_has_Fornecedor_Produto1_idx` (`codProduto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `motorista`
--

CREATE TABLE IF NOT EXISTS `motorista` (
  `categoriaHabilitacao` varchar(2) NOT NULL,
  `codigo` decimal(3,0) DEFAULT NULL,
  `area` decimal(2,0) DEFAULT NULL,
  `numero` decimal(9,0) DEFAULT NULL,
  `disponivel` tinyint(1) NOT NULL,
  `idMotorista` int(11) NOT NULL,
  PRIMARY KEY (`idMotorista`),
  KEY `fk_Motorista_funcionario1_idx` (`idMotorista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `outro`
--

CREATE TABLE IF NOT EXISTS `outro` (
  `idOutro` decimal(14) NOT NULL,
  PRIMARY KEY (`idOutro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE IF NOT EXISTS `pagamento` (
  `idPagamento` int(11) NOT NULL AUTO_INCREMENT,
  `numeroBoleto` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `valor` varchar(45) NOT NULL,
  `dataVencimento` date NOT NULL,
  `dataEmissao` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `fkGerente` int(11) NOT NULL,
  PRIMARY KEY (`idPagamento`),
  KEY `fk_Pagamento_Gerente1_idx` (`fkGerente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `dataPedido` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `fkPagamento` int(11) NOT NULL,
  `fkGerente` int(11) NOT NULL,
  PRIMARY KEY (`idPedido`),
  KEY `fk_Pedido_Pagamento1_idx` (`fkPagamento`),
  KEY `fk_Pedido_Gerente1_idx` (`fkGerente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `codProduto` int(11) NOT NULL AUTO_INCREMENT,
  `preco` float DEFAULT NULL,
  `dataFabricacao` date DEFAULT NULL,
  `dataVencimento` date DEFAULT NULL,
  `fkEspecProduto` int(11) NOT NULL,
  `fkDeposito` int(11) NOT NULL,
  PRIMARY KEY (`codProduto`),
  KEY `fk_Produto_EspecProduto1_idx` (`fkEspecProduto`),
  KEY `fk_Produto_Deposito1_idx` (`fkDeposito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguranca`
--

CREATE TABLE IF NOT EXISTS `seguranca` (
  `porteArma` tinyint(1) NOT NULL,
  `idSeguranca` int(11) NOT NULL,
  PRIMARY KEY (`idSeguranca`),
  KEY `fk_Segurança_funcionario1_idx` (`idSeguranca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE IF NOT EXISTS `veiculo` (
  `idVeiculo` int(11) NOT NULL AUTO_INCREMENT,
  `placa` varchar(45) NOT NULL,
  `ano` decimal(4,0) NOT NULL,
  `modelo` decimal(4,0) NOT NULL,
  `capacidade` int(11) NOT NULL,
  `disponivel` tinyint(1) NOT NULL,
  PRIMARY KEY (`idVeiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `viagem`
--

CREATE TABLE IF NOT EXISTS `viagem` (
  `idViagem` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` text NOT NULL,
  `fkVeiculo` int(11) NOT NULL,
  `fkMotorista` int(11) NOT NULL,
  `fkGerente` int(11) NOT NULL,
  PRIMARY KEY (`idViagem`),
  KEY `fk_Viagem_Veiculo1_idx` (`fkVeiculo`),
  KEY `fk_Viagem_Motorista1_idx` (`fkMotorista`),
  KEY `fk_Viagem_Gerente1_idx` (`fkGerente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `agricultor`
--
ALTER TABLE `agricultor`
  ADD CONSTRAINT `fk_Agricultor_Fornecedor1` FOREIGN KEY (`idAgricultor`) REFERENCES `fornecedor` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `auxiliarlimpeza`
--
ALTER TABLE `auxiliarlimpeza`
  ADD CONSTRAINT `fk_AuxiliarLimpeza_funcionario1` FOREIGN KEY (`idAuxiliarLimpeza`) REFERENCES `funcionario` (`idfuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_Empresa_Endereco1` FOREIGN KEY (`fkEndereco`) REFERENCES `endereco` (`idEndereco`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `encomenda`
--
ALTER TABLE `encomenda`
  ADD CONSTRAINT `fk_Encomenda_Pagamento1` FOREIGN KEY (`fkPagamento`) REFERENCES `pagamento` (`idPagamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Encomenda_Viagem1` FOREIGN KEY (`fkViagem`) REFERENCES `viagem` (`idViagem`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Encomenda_Empresa1` FOREIGN KEY (`fkEmpresa`) REFERENCES `empresa` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `encomespec`
--
ALTER TABLE `encomespec`
  ADD CONSTRAINT `fk_Encomenda_has_EspecProduto_Encomenda1` FOREIGN KEY (`idEncomenda`) REFERENCES `encomenda` (`idEncomenda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Encomenda_has_EspecProduto_EspecProduto1` FOREIGN KEY (`idEspecProduto`) REFERENCES `especproduto` (`idEspecProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_Endereco_Cidade` FOREIGN KEY (`fkCidade`) REFERENCES `cidade` (`idCidade`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fabrica`
--
ALTER TABLE `fabrica`
  ADD CONSTRAINT `fk_Fabrica_Fornecedor1` FOREIGN KEY (`idFabrica`) REFERENCES `fornecedor` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD CONSTRAINT `fk_Fornecedor_Endereco1` FOREIGN KEY (`fkEndereco`) REFERENCES `endereco` (`idEndereco`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `gerente`
--
ALTER TABLE `gerente`
  ADD CONSTRAINT `fk_Gerente_funcionario1` FOREIGN KEY (`idGerente`) REFERENCES `funcionario` (`idfuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_Produto_has_Fornecedor_Produto1` FOREIGN KEY (`codProduto`) REFERENCES `produto` (`codProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Produto_has_Fornecedor_Fornecedor1` FOREIGN KEY (`cnpjFornecedor`) REFERENCES `fornecedor` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `motorista`
--
ALTER TABLE `motorista`
  ADD CONSTRAINT `fk_Motorista_funcionario1` FOREIGN KEY (`idMotorista`) REFERENCES `funcionario` (`idfuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `outro`
--
ALTER TABLE `outro`
  ADD CONSTRAINT `fk_Outro_Fornecedor1` FOREIGN KEY (`idOutro`) REFERENCES `fornecedor` (`cnpj`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `fk_Pagamento_Gerente1` FOREIGN KEY (`fkGerente`) REFERENCES `gerente` (`idGerente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_Pedido_Pagamento1` FOREIGN KEY (`fkPagamento`) REFERENCES `pagamento` (`idPagamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_Gerente1` FOREIGN KEY (`fkGerente`) REFERENCES `gerente` (`idGerente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_Produto_EspecProduto1` FOREIGN KEY (`fkEspecProduto`) REFERENCES `especproduto` (`idEspecProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Produto_Deposito1` FOREIGN KEY (`fkDeposito`) REFERENCES `deposito` (`numero`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `seguranca`
--
ALTER TABLE `seguranca`
  ADD CONSTRAINT `fk_Segurança_funcionario1` FOREIGN KEY (`idSeguranca`) REFERENCES `funcionario` (`idfuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `viagem`
--
ALTER TABLE `viagem`
  ADD CONSTRAINT `fk_Viagem_Veiculo1` FOREIGN KEY (`fkVeiculo`) REFERENCES `veiculo` (`idVeiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Viagem_Motorista1` FOREIGN KEY (`fkMotorista`) REFERENCES `motorista` (`idMotorista`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Viagem_Gerente1` FOREIGN KEY (`fkGerente`) REFERENCES `gerente` (`idGerente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
