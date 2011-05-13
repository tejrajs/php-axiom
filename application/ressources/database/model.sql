SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
CREATE SCHEMA IF NOT EXISTS `backoffice` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
CREATE SCHEMA IF NOT EXISTS `taxi` ;
USE `blog` ;

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
-- Table `blog`.`authors`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`authors` (
  `id` BIGINT(25) NOT NULL AUTO_INCREMENT ,
  `display_name` VARCHAR(45) NOT NULL ,
  `articles_posted` INT UNSIGNED NULL DEFAULT 0 COMMENT 'usage' ,
  `users_id` BIGINT(25) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `unique_display_name` (`display_name` ASC) ,
  INDEX `fk_authors_users` (`users_id` ASC) ,
  CONSTRAINT `fk_authors_users`
    FOREIGN KEY (`users_id` )
    REFERENCES `backoffice`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`articles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`articles` (
  `id` BIGINT(25) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(90) NOT NULL ,
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `body` TEXT NOT NULL ,
  `lang` VARCHAR(2) NOT NULL ,
  `authors_id` BIGINT(25) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `unique_title` (`title` ASC) ,
  INDEX `fk_articles_authors1` (`authors_id` ASC) ,
  CONSTRAINT `fk_articles_authors1`
    FOREIGN KEY (`authors_id` )
    REFERENCES `blog`.`authors` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`tags` (
  `id` BIGINT(25) NOT NULL AUTO_INCREMENT ,
  `tag` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `unique` (`tag` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`articles_has_tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`articles_has_tags` (
  `articles_id` BIGINT(25) NOT NULL ,
  `tags_id` BIGINT(25) NOT NULL ,
  PRIMARY KEY (`articles_id`, `tags_id`) ,
  INDEX `fk_articles_has_tags_articles1` (`articles_id` ASC) ,
  INDEX `fk_articles_has_tags_tags1` (`tags_id` ASC) ,
  CONSTRAINT `fk_articles_has_tags_articles1`
    FOREIGN KEY (`articles_id` )
    REFERENCES `blog`.`articles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_has_tags_tags1`
    FOREIGN KEY (`tags_id` )
    REFERENCES `blog`.`tags` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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


-- -----------------------------------------------------
-- Table `blog`.`attachments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`attachments` (
  `id` BIGINT(25) NOT NULL AUTO_INCREMENT ,
  `display_name` VARCHAR(90) NOT NULL ,
  `files_id` BIGINT(25) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_attachments_files1` (`files_id` ASC) ,
  CONSTRAINT `fk_attachments_files1`
    FOREIGN KEY (`files_id` )
    REFERENCES `backoffice`.`files` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`articles_has_attachments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`articles_has_attachments` (
  `articles_id` BIGINT(25) NOT NULL ,
  `attachments_id` BIGINT(25) NOT NULL ,
  PRIMARY KEY (`articles_id`, `attachments_id`) ,
  INDEX `fk_articles_has_attachments_articles1` (`articles_id` ASC) ,
  INDEX `fk_articles_has_attachments_attachments1` (`attachments_id` ASC) ,
  CONSTRAINT `fk_articles_has_attachments_articles1`
    FOREIGN KEY (`articles_id` )
    REFERENCES `blog`.`articles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_has_attachments_attachments1`
    FOREIGN KEY (`attachments_id` )
    REFERENCES `blog`.`attachments` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`comments` (
  `id` BIGINT(25) NOT NULL AUTO_INCREMENT ,
  `validated` TINYINT(1)  NOT NULL DEFAULT false ,
  `title` VARCHAR(90) NOT NULL ,
  `body` TEXT NOT NULL ,
  `commenter_name` VARCHAR(45) NOT NULL ,
  `commenter_email` VARCHAR(45) NOT NULL ,
  `commenter_ip` VARCHAR(45) NOT NULL ,
  `articles_id` BIGINT(25) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_comments_articles1` (`articles_id` ASC) ,
  CONSTRAINT `fk_comments_articles1`
    FOREIGN KEY (`articles_id` )
    REFERENCES `blog`.`articles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`attachments_has_tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`attachments_has_tags` (
  `attachments_id` BIGINT(25) NOT NULL ,
  `tags_id` BIGINT(25) NOT NULL ,
  PRIMARY KEY (`attachments_id`, `tags_id`) ,
  INDEX `fk_attachments_has_tags_attachments1` (`attachments_id` ASC) ,
  INDEX `fk_attachments_has_tags_tags1` (`tags_id` ASC) ,
  CONSTRAINT `fk_attachments_has_tags_attachments1`
    FOREIGN KEY (`attachments_id` )
    REFERENCES `blog`.`attachments` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_attachments_has_tags_tags1`
    FOREIGN KEY (`tags_id` )
    REFERENCES `blog`.`tags` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `taxi`.`regions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `taxi`.`regions` (
  `id` BIGINT(25) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `number` VARCHAR(3) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  UNIQUE INDEX `number_UNIQUE` (`number` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `taxi`.`towns`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `taxi`.`towns` (
  `id` BIGINT(25) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `regions_id` BIGINT(25) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_towns_regions1` (`regions_id` ASC) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
  CONSTRAINT `fk_towns_regions1`
    FOREIGN KEY (`regions_id` )
    REFERENCES `taxi`.`regions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `taxi`.`taxis`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `taxi`.`taxis` (
  `id` BIGINT(25) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `surname` VARCHAR(45) NOT NULL ,
  `phone` VARCHAR(25) NOT NULL ,
  `places` INT(11)  NOT NULL ,
  `handle_disabled` TINYINT(4) NOT NULL ,
  `handle_medicals` TINYINT(4) NOT NULL ,
  `accept_cc` TINYINT(4) NOT NULL ,
  `accept_check` TINYINT(4) NOT NULL ,
  `accept_money` TINYINT(4) NOT NULL ,
  `towns_id` BIGINT(25) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_taxis_towns` (`towns_id` ASC) ,
  CONSTRAINT `fk_taxis_towns`
    FOREIGN KEY (`towns_id` )
    REFERENCES `taxi`.`towns` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`attachments_has_taxis`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`attachments_has_taxis` (
  `attachments_id` BIGINT(25) NOT NULL ,
  `taxis_id` BIGINT(25) NOT NULL ,
  PRIMARY KEY (`attachments_id`, `taxis_id`) ,
  INDEX `fk_attachments_has_taxis_taxis1` (`taxis_id` ASC) ,
  INDEX `fk_attachments_has_taxis_attachments1` (`attachments_id` ASC) ,
  CONSTRAINT `fk_attachments_has_taxis_attachments1`
    FOREIGN KEY (`attachments_id` )
    REFERENCES `blog`.`attachments` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_attachments_has_taxis_taxis1`
    FOREIGN KEY (`taxis_id` )
    REFERENCES `taxi`.`taxis` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`articles_has_articles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `blog`.`articles_has_articles` (
  `articles_id` BIGINT(25) NOT NULL ,
  `articles_id1` BIGINT(25) NOT NULL ,
  PRIMARY KEY (`articles_id`, `articles_id1`) ,
  INDEX `fk_articles_has_articles_articles1` (`articles_id` ASC) ,
  INDEX `fk_articles_has_articles_articles2` (`articles_id1` ASC) ,
  CONSTRAINT `fk_articles_has_articles_articles1`
    FOREIGN KEY (`articles_id` )
    REFERENCES `blog`.`articles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_has_articles_articles2`
    FOREIGN KEY (`articles_id1` )
    REFERENCES `blog`.`articles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `backoffice` ;
USE `taxi` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
