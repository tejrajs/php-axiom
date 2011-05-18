SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `backoffice` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

-- -----------------------------------------------------
-- Table `backoffice`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `backoffice`.`users` (
  `id` BIGINT(25) NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `name` VARCHAR(90) NULL ,
  `surname` VARCHAR(90) NULL ,
  `creation` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `last_connection` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `backoffice`.`files`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `backoffice`.`files` (
  `id` BIGINT(25) NOT NULL AUTO_INCREMENT ,
  `filename` VARCHAR(90) NOT NULL ,
  `path` TEXT NOT NULL ,
  `mime_type` VARCHAR(45) NOT NULL DEFAULT 'text/plain' ,
  `upload` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `users_id` BIGINT(25) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_files_users` (`users_id` ASC) ,
  CONSTRAINT `fk_files_users`
    FOREIGN KEY (`users_id` )
    REFERENCES `backoffice`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
