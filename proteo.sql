-- MySQL Script generated by MySQL Workbench
-- jue 18 oct 2018 14:17:13 -04
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuarios` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `login` VARCHAR(20) NOT NULL,
  `clave` VARCHAR(100) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `img` VARCHAR(45) NULL,
  `condicion` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`permisos` (
  `idpermisos` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idpermisos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`usuarios_permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuarios_permisos` (
  `idusuarios_permisos` INT NOT NULL AUTO_INCREMENT,
  `idusuarios` INT NOT NULL,
  `idpermisos` INT NOT NULL,
  PRIMARY KEY (`idusuarios_permisos`),
  INDEX `fk_usuarios_permisos_usuarios_idx` (`idusuarios` ASC),
  INDEX `fk_usuarios_permisos_permisos_idx` (`idpermisos` ASC),
  CONSTRAINT `fk_usuarios_permisos_usuarios`
    FOREIGN KEY (`idusuarios`)
    REFERENCES `mydb`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_permisos_permisos`
    FOREIGN KEY (`idpermisos`)
    REFERENCES `mydb`.`permisos` (`idpermisos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`items` (
  `iditems` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `precio_nac` DECIMAL(30,2) NOT NULL,
  `precio_usd` DECIMAL(30,2) NOT NULL,
  `unidad` VARCHAR(5) NOT NULL DEFAULT 'UND',
  `detalle` VARCHAR(45) NULL,
  `decimales` TINYINT(1) NOT NULL,
  `servicio` TINYINT(1) NOT NULL DEFAULT 1,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`iditems`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`centro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`centro` (
  `idcentro` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcentro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`cargos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cargos` (
  `idcargos` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NOT NULL,
  `idcentro` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `responsable` VARCHAR(45) NOT NULL,
  `supervisor` VARCHAR(45) NOT NULL,
  `comentario` VARCHAR(100) NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idcargos`),
  INDEX `fk_cargos_usuario_idx` (`idusuario` ASC),
  INDEX `fk_cargos_centro_idx` (`idcentro` ASC),
  CONSTRAINT `fk_cargos_usuario`
    FOREIGN KEY (`idusuario`)
    REFERENCES `mydb`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cargos_centro`
    FOREIGN KEY (`idcentro`)
    REFERENCES `mydb`.`centro` (`idcentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`cargos_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cargos_items` (
  `idcargos_items` INT NOT NULL AUTO_INCREMENT,
  `idcargos` INT NOT NULL,
  `Iditems` INT NOT NULL,
  `cantidad` DECIMAL(30,2) NOT NULL,
  PRIMARY KEY (`idcargos_items`),
  INDEX `fk_cargos_items_cargos_idx` (`idcargos` ASC),
  INDEX `fk_cargos_items_items_idx` (`Iditems` ASC),
  CONSTRAINT `fk_cargos_items_cargos`
    FOREIGN KEY (`idcargos`)
    REFERENCES `mydb`.`cargos` (`idcargos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cargos_items_items`
    FOREIGN KEY (`Iditems`)
    REFERENCES `mydb`.`items` (`iditems`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`departamento` (
  `iddepartamento` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`iddepartamento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`request_temp`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`request_temp` (
  `idrequest_temp` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NOT NULL,
  `iddepartamento` INT NOT NULL,
  `idcentro` INT NOT NULL,
  `comentario` VARCHAR(100) NULL,
  `responsable` VARCHAR(45) NOT NULL,
  `supervisor` VARCHAR(45) NOT NULL,
  `prioridad` TINYINT(1) NOT NULL,
  `calidad` TINYINT(1) NOT NULL,
  `mantenimiento` TINYINT(1) NOT NULL,
  `fecha` DATE NOT NULL,
  `servicio` TINYINT(1) NOT NULL DEFAULT 0,
  `condicion` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idrequest_temp`),
  INDEX `fk_request_temp_usuarios_idx` (`idusuario` ASC),
  INDEX `fk_request_temp_departamento_idx` (`iddepartamento` ASC),
  INDEX `fk_request_temp_centro_idx` (`idcentro` ASC),
  CONSTRAINT `fk_request_temp_usuarios`
    FOREIGN KEY (`idusuario`)
    REFERENCES `mydb`.`usuarios` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_request_temp_departamento`
    FOREIGN KEY (`iddepartamento`)
    REFERENCES `mydb`.`departamento` (`iddepartamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_request_temp_centro`
    FOREIGN KEY (`idcentro`)
    REFERENCES `mydb`.`centro` (`idcentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ods_op`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ods_op` (
  `idods` INT NOT NULL AUTO_INCREMENT,
  `idrequest_temp` INT NOT NULL,
  `codigo` VARCHAR(45) NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`idods`),
  INDEX `fk_ods_ods_temp_idx` (`idrequest_temp` ASC),
  CONSTRAINT `fk_ods_ods_temp`
    FOREIGN KEY (`idrequest_temp`)
    REFERENCES `mydb`.`request_temp` (`idrequest_temp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`request_op`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`request_op` (
  `idrequest_op` INT NOT NULL AUTO_INCREMENT,
  `idrequest_temp` INT NOT NULL,
  `codigo` VARCHAR(45) NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`idrequest_op`),
  INDEX `fk_request_op_request_temp_idx` (`idrequest_temp` ASC),
  UNIQUE INDEX `idrequest_temp_UNIQUE` (`idrequest_temp` ASC),
  CONSTRAINT `fk_request_op_request_temp`
    FOREIGN KEY (`idrequest_temp`)
    REFERENCES `mydb`.`request_temp` (`idrequest_temp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`request_items_temp`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`request_items_temp` (
  `idrequest_items_temp` INT NOT NULL AUTO_INCREMENT,
  `idrequest_temp` INT NOT NULL,
  `iditem` INT NOT NULL,
  `detalle` VARCHAR(45) NULL,
  `cantidad` DECIMAL(30,2) NOT NULL,
  PRIMARY KEY (`idrequest_items_temp`),
  INDEX `fk_request_items_items_idx` (`iditem` ASC),
  INDEX `fk_request_items_request_temp_idx` (`idrequest_temp` ASC),
  CONSTRAINT `fk_request_items_items`
    FOREIGN KEY (`iditem`)
    REFERENCES `mydb`.`items` (`iditems`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_request_items_request_temp`
    FOREIGN KEY (`idrequest_temp`)
    REFERENCES `mydb`.`request_temp` (`idrequest_temp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`request_mtto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`request_mtto` (
  `idrequest_mtto` INT NOT NULL AUTO_INCREMENT,
  `idrequest_temp` INT NOT NULL,
  `codigo` VARCHAR(45) NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`idrequest_mtto`),
  INDEX `fk_request_op_request_temp_idx` (`idrequest_temp` ASC),
  UNIQUE INDEX `idrequest_temp_UNIQUE` (`idrequest_temp` ASC),
  CONSTRAINT `fk_request_op_request_temp0`
    FOREIGN KEY (`idrequest_temp`)
    REFERENCES `mydb`.`request_temp` (`idrequest_temp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`formatos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`formatos` (
  `idcalidad` INT NOT NULL,
  `titulo` VARCHAR(45) NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `fecha` DATE NOT NULL,
  `revision` TINYINT(2) ZEROFILL NOT NULL,
  PRIMARY KEY (`idcalidad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`clientes` (
  `idcliente` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `nfiscal` BIGINT NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `telefono` BIGINT NOT NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcliente`),
  UNIQUE INDEX `nfiscal_UNIQUE` (`nfiscal` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`proveedores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`proveedores` (
  `idproveedor` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `nfiscal` BIGINT NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `telefono` BIGINT NOT NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idproveedor`),
  UNIQUE INDEX `nfiscal_UNIQUE` (`nfiscal` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`pcs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`pcs` (
  `idpcs` INT NOT NULL AUTO_INCREMENT,
  `idproveedor` INT NOT NULL,
  `idrequest_temp` INT NOT NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `fecha` DATE NOT NULL,
  `condicion` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idpcs`),
  INDEX `fk_pcs_proveedor_idx` (`idproveedor` ASC),
  INDEX `fk_pcs_request_temp_idx` (`idrequest_temp` ASC),
  CONSTRAINT `fk_pcs_proveedor`
    FOREIGN KEY (`idproveedor`)
    REFERENCES `mydb`.`proveedores` (`idproveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pcs_request_temp`
    FOREIGN KEY (`idrequest_temp`)
    REFERENCES `mydb`.`request_temp` (`idrequest_temp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ods_mtto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ods_mtto` (
  `idods_mtto` INT NOT NULL AUTO_INCREMENT,
  `idrequest_temp` INT NOT NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`idods_mtto`),
  INDEX `fk_ods_mtto_request_item_idx` (`idrequest_temp` ASC),
  CONSTRAINT `fk_ods_mtto_request_item`
    FOREIGN KEY (`idrequest_temp`)
    REFERENCES `mydb`.`request_temp` (`idrequest_temp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`odc_mtto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`odc_mtto` (
  `idodc` INT NOT NULL AUTO_INCREMENT,
  `idproveedor` INT NOT NULL,
  `idrequest_temp` INT NOT NULL,
  `codigo` VARCHAR(45) NULL,
  `cotizacion` VARCHAR(45) NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`idodc`),
  INDEX `fk_ods_mtto_request_item_idx` (`idrequest_temp` ASC),
  INDEX `fk_odc_mtto_proveedor_idx` (`idproveedor` ASC),
  UNIQUE INDEX `idrequest_temp_UNIQUE` (`idrequest_temp` ASC),
  CONSTRAINT `fk_ods_mtto_request_item0`
    FOREIGN KEY (`idrequest_temp`)
    REFERENCES `mydb`.`request_temp` (`idrequest_temp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_odc_mtto_proveedor`
    FOREIGN KEY (`idproveedor`)
    REFERENCES `mydb`.`proveedores` (`idproveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`odc_op`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`odc_op` (
  `idodc` INT NOT NULL AUTO_INCREMENT,
  `idproveedor` INT NOT NULL,
  `idrequest_temp` INT NOT NULL,
  `codigo` VARCHAR(45) NULL,
  `cotizacion` VARCHAR(45) NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`idodc`),
  INDEX `fk_ods_ods_temp_idx` (`idrequest_temp` ASC),
  INDEX `fk_odc_op_proveedor_idx` (`idproveedor` ASC),
  UNIQUE INDEX `idrequest_temp_UNIQUE` (`idrequest_temp` ASC),
  CONSTRAINT `fk_ods_ods_temp0`
    FOREIGN KEY (`idrequest_temp`)
    REFERENCES `mydb`.`request_temp` (`idrequest_temp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_odc_op_proveedor`
    FOREIGN KEY (`idproveedor`)
    REFERENCES `mydb`.`proveedores` (`idproveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
