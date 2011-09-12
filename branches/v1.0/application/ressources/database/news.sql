SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

-- -----------------------------------------------------
-- Table `axiom`.`ax_news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `axiom`.`ax_news` ;

CREATE  TABLE IF NOT EXISTS `axiom`.`ax_news` (
  `id` BIGINT(25) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `author` VARCHAR(90) NOT NULL ,
  `date` DATE NOT NULL ,
  `body` TEXT NOT NULL ,
  `published` TINYINT(1)  NOT NULL DEFAULT FALSE ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `axiom`.`ax_news_comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `axiom`.`ax_news_comments` ;

CREATE  TABLE IF NOT EXISTS `axiom`.`ax_news_comments` (
  `id` BIGINT(25) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `author` VARCHAR(90) NOT NULL ,
  `date` DATE NOT NULL ,
  `mail` VARCHAR(65) NOT NULL ,
  `website` VARCHAR(90) NULL ,
  `ip` VARCHAR(15) NOT NULL ,
  `body` TEXT NOT NULL ,
  `published` TINYINT(1)  NOT NULL DEFAULT FALSE ,
  `ax_news_id` BIGINT(25) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ax_news_comments_ax_news` (`ax_news_id` ASC) ,
  CONSTRAINT `fk_ax_news_comments_ax_news`
    FOREIGN KEY (`ax_news_id` )
    REFERENCES `axiom`.`ax_news` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
