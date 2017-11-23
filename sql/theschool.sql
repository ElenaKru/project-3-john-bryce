-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema theschool
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema theschool
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `theschool` DEFAULT CHARACTER SET utf8 ;
USE `theschool` ;

-- -----------------------------------------------------
-- Table `theschool`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `theschool`.`role` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `theschool`.`administrator`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `theschool`.`administrator` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `role` INT(11) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_administrator_to_role_idx` (`role` ASC),
  CONSTRAINT `fk_administrator_to_role`
    FOREIGN KEY (`role`)
    REFERENCES `theschool`.`role` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `theschool`.`course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `theschool`.`course` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  `image` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 24
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `theschool`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `theschool`.`student` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `image` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `theschool`.`courses_students`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `theschool`.`courses_students` (
  `course` INT(11) NOT NULL,
  `student` INT(11) NOT NULL,
  PRIMARY KEY (`course`, `student`),
  INDEX `fk_to_students_idx` (`student` ASC),
  CONSTRAINT `fk_to_courses`
    FOREIGN KEY (`course`)
    REFERENCES `theschool`.`course` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_to_students`
    FOREIGN KEY (`student`)
    REFERENCES `theschool`.`student` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
