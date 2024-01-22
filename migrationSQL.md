#####
*Arquivo para preencher com Scripts para atualizações (ALTER/CREATE/INSERT/UPDATE/DELETE/TRUNCATE) de tabelas*
#####

1. Criando tabela users e atualizando campos

CREATE TABLE `users` (
  `userId` int(10) NOT NULL AUTO_INCREMENT , PRIMARY KEY (`userId`),
  `userName` varchar(150) DEFAULT NULL,
  `userRegistry` varchar(30) DEFAULT NULL,
  `userPassword` varchar(100) DEFAULT NULL,
  `userChangePassword` tinyint(1) DEFAULT 0 COMMENT '0 - não alterado\r\n1 - alterado',
  `userPermission` int(10) DEFAULT NULL,
  `userStatus` tinyint(1) DEFAULT NULL,
  `userGender` varchar(10) DEFAULT NULL,
  `userMail` varchar(100) DEFAULT NULL,
  `userCPF` varchar(20) DEFAULT NULL,
  `userFromSystem` date DEFAULT NULL,
  `userRG` varchar(30) DEFAULT NULL,
  `userMother` varchar(50) NOT NULL,
  `userFather` varchar(50) NOT NULL,
  `userUF` varchar(10) NOT NULL,
  `userOrgan` varchar(10) NOT NULL,
  `userNaturality` varchar(30) NOT NULL,
  `userBorn` date DEFAULT NULL,
  `userDeficiency` tinyint(4) NOT NULL COMMENT '0 não\r\n1 sim',
  `userResponsibleMaritalStatus` int(5) NOT NULL,
  `userPhone` varchar(30) DEFAULT NULL,
  `userAddressCEP` varchar(50) DEFAULT NULL,
  `userAddressStreet` varchar(100) DEFAULT NULL,
  `userAddressNumber` varchar(20) DEFAULT NULL,
  `userAddressDistrict` varchar(100) DEFAULT NULL,
  `userAddressCity` varchar(100) DEFAULT NULL,
  `userAddressUF` varchar(20) DEFAULT NULL,
  `userAddressComplement` varchar(1000) DEFAULT NULL,
  `userObs` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

ALTER TABLE `users` ADD `userDeficiencyType` VARCHAR(100) NOT NULL AFTER `userDeficiency`;

ALTER TABLE `users` CHANGE `userResponsibleMaritalStatus` `userResponsibleMaritalStatus` ENUM('single','divorced','widow','maried') NOT NULL COMMENT 'single(solteiro)\r\ndivorced(divorciado)\r\nwidow(viúvo)\r\nmaried(casado)';

ALTER TABLE `users` ADD `userMotherPhone` VARCHAR(30) NOT NULL AFTER `userPhone`, ADD `userFatherPhone` VARCHAR(30) NOT NULL AFTER `userMotherPhone`;

----------------------------------

2. Criando tabela systems

--
-- Estrutura da tabela `systems`
--

CREATE TABLE `systems` (
  `systemId` int(11) NOT NULL,
  `systemName` varchar(100) NOT NULL,
  `systemDescription` text NOT NULL,
  `systemFooter` text NOT NULL,
  `systemVersion` varchar(10) NOT NULL,
  `systemHeader1` text NOT NULL,
  `systemHeader2` text NOT NULL,
  `systemLayout` varchar(30) NOT NULL,
  `systemURLDevelopment` varchar(100) NOT NULL,
  `systemURLHomologation` varchar(100) NOT NULL,
  `systemURLProduction` varchar(100) NOT NULL,
  `systemIcon` varchar(20) NOT NULL,
  `systemNivel` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

ALTER TABLE `systems` CHANGE `systemId` `systemId` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`systemId`);

--
-- Extraindo dados da tabela `systems`
--

INSERT INTO `systems` (`systemId`, `systemName`, `systemDescription`, `systemFooter`, `systemVersion`, `systemHeader1`, `systemHeader2`, `systemLayout`, `systemURLDevelopment`, `systemURLHomologation`, `systemURLProduction`, `systemIcon`, `systemNivel`) VALUES
(1, 'HealthControl', '<p>Sistema de Controle de Pacientes e Atendimentos</p>\r\n', '<p><strong>iLottWeb<a href=\"#\" target=\"_blank\">iLottWeb</a>.</strong> Todos os direitos reservados.</p>\r\n', '1.0', '', '', 'skin-blue', 'http://localhost:4445', '', '', 'life-ring', 11);

-----------------------------------

3. Adicionando nova coluna userType em users

ALTER TABLE `users` ADD `userType` ENUM('superAdmin','admin','doctor','pacient','user') NOT NULL AFTER `userFather`;

-----------------------------------

4. Criação da tabela loading_texts

CREATE TABLE `loading_texts` (
  `loadingTextId` int(11) NOT NULL,
  `loadingTextDescription` varchar(255) NOT NULL,
  `loadingTextActor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `loading_texts` (`loadingTextId`, `loadingTextDescription`, `loadingTextActor`) VALUES
(5, 'Não há saber mais ou saber menos: há saberes diferentes.', 'Paulo Freire'),
(6, 'O educador se eterniza em cada ser que educa.', 'Paulo Freire'),
(7, 'Educar é impregnar de sentido o que fazemos a cada instante.', 'Paulo Freire'),
(8, 'Ensinar não é transferir conhecimento, mas criar as possibilidades para sua própria produção ou a sua construção.', 'Paulo Freire'),
(9, 'Se a educação sozinha não transforma a sociedade, sem ela tampouco a sociedade muda.', 'Paulo Freire'),
(10, 'Importante na escola não é só estudar, não é só trabalhar, é também criar laços de amizade.', 'Paulo Freire'),
(11, 'Feliz aquele que transfere o que sabe e aprende o que ensina.', 'Cora Coralina');

ALTER TABLE `loading_texts`
  ADD PRIMARY KEY (`loadingTextId`);
ALTER TABLE `loading_texts`
  MODIFY `loadingTextId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

----------------------------------

5. Criando coluna de userNationality para Nacionalidade

ALTER TABLE `users` ADD `userNationality` VARCHAR(30) NOT NULL AFTER `userOrgan`;

----------------------------------

6. Alteração dos nomes da tabela users

ALTER TABLE `users` CHANGE `userMother` `userNameMother` VARCHAR(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL;
ALTER TABLE `users` CHANGE `userFather` `userNameFather` VARCHAR(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL;

----------------------------------

7. Criação da tabela health_care

CREATE TABLE `prototipo`.`health_care_type` (`healthCareId` INT NOT NULL , `healthCareType` ENUM('psychologist','psychiatrist','dentist','generalDoctor') NOT NULL COMMENT 'psychologist - psicólogo\r\npsychiatrist - psiquiatra\r\ndentist - dentista\r\ndoctorGeneral - médico geral' ) ENGINE = InnoDB;

----------------------------------

8. Atualização da tabela users

ALTER TABLE `users` ADD `userDateLastAccess` DATETIME NOT NULL AFTER `userObs`, ADD `userDateLogout` DATETIME NOT NULL AFTER `userDateLastAccess`;

----------------------------------

9. Criação da tabela doctors

CREATE TABLE `prototipo`.`doctors` (`doctorId` INT NOT NULL AUTO_INCREMENT , `doctorUserId` INT NOT NULL , `doctorTypeId` INT NOT NULL , PRIMARY KEY (`doctorId`)) ENGINE = InnoDB;

----------------------------------

10. Criação da tabela doctorType

CREATE TABLE `prototipo`.`doctor_types` (`doctorTypeId` INT NOT NULL AUTO_INCREMENT , `doctorTypeName` VARCHAR(30) NOT NULL , PRIMARY KEY (`doctorTypeId`)) ENGINE = InnoDB;

----------------------------------

11. Criação da tabela pacients

CREATE TABLE `prototipo`.`pacients` (`pacientId` INT NOT NULL , `pacientUserId` INT NOT NULL , `pacientDoctorId` INT NOT NULL , PRIMARY KEY (`pacientId`)) ENGINE = InnoDB;

ALTER TABLE `pacients` ADD `pacientStatus` TINYINT NOT NULL COMMENT '0 - inativo\r\n1 - ativo' AFTER `pacientDoctorId`;

---------------------------------

12. Criação da tabela administrators

CREATE TABLE `prototipo`.`administrators` (`adminId` INT NOT NULL AUTO_INCREMENT , `adminUserId` INT NOT NULL , `adminStatus` TINYINT NOT NULL , `adminDateBegin` DATE NOT NULL , `adminDateEnd` DATE NOT NULL , PRIMARY KEY (`adminId`)) ENGINE = InnoDB;

ALTER TABLE `administrators` CHANGE `adminStatus` `adminStatus` TINYINT(4) NOT NULL COMMENT '0 - inativo\r\n1 - ativo';

---------------------------------

13. Criação dos campos de status, dateBegin e End para doctors

ALTER TABLE `doctors` ADD `doctorDateBegin` DATE NOT NULL AFTER `doctorTypeId`, ADD `doctorDateEnd` DATE NOT NULL AFTER `doctorDateBegin`;

ALTER TABLE `doctors` ADD `doctorStatus` TINYINT NOT NULL COMMENT '0 - inativo\r\n1 - ativo' AFTER `doctorDateEnd`;

---------------------------------

14. Adicionando colunas na tabela de pacients

ALTER TABLE `prototipo`.`pacients` 
ADD COLUMN `pacientDateBegin` DATE NOT NULL AFTER `pacientStatus`,
ADD COLUMN `pacientDateEnd` DATE NOT NULL AFTER `pacientDateBegin`;

---------------------------------

15. Criação da tabela de links

CREATE TABLE `prototipo`.`links` (
  `linkId` INT NOT NULL AUTO_INCREMENT,
  `linkUserId` INT NOT NULL,
  `linkPermission` INT NOT NULL,
  PRIMARY KEY (`linkId`),
  INDEX `userId_idx` (`linkUserId` ASC) VISIBLE,
  CONSTRAINT `userId`
    FOREIGN KEY (`linkUserId`)
    REFERENCES `prototipo`.`users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

---------------------------------

16. 