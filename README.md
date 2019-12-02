# famlog

1. Clone 'famlog' repository and place it in 'C:\Apache24\htdocs'
    (extract 'famlog' contents into 'htdocs', instead of having the entire 'famlog' folder in 'htdocs')
    
2. Create a schema in MySQL called 'cs157a_project'

3. Open a new query tab and paste the following (Line 10 - Line 79): 

USE cs157a_project;

CREATE TABLE `account` (
  `accountID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `accName` varchar(30) NOT NULL UNIQUE,
  `passWrd` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `user` (
  `userID` INT NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `has` (
  `accountID` varchar(30) NOT NULL,
  `userID` INT NOT NULL,
  PRIMARY KEY (`accountID`,`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `item` (
  `itemID` INT NOT NULL AUTO_INCREMENT,
  `itemName` varchar(30) NOT NULL UNIQUE,
  `brand` varchar(30) DEFAULT NULL,
  `priority` TINYINT NOT NULL,
  `quantity` int(6) NOT NULL,
  `notes` tinytext,
  PRIMARY KEY (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `owns` (
  `userID` INT NOT NULL,
  `personalListID` INT NOT NULL,
  PRIMARY KEY (`userID`,`personalListID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `personal_list` (
  personalListID INT NOT NULL AUTO_INCREMENT,
  items_count INT,
  last_updated timestamp default current_timestamp on update current_timestamp,
  PRIMARY KEY (`personalListID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `purchase_history` (
  `purchaseID` int(6) NOT NULL AUTO_INCREMENT,
  `belongsTo` varchar(30) NOT NULL,
  `buyer` varchar(30) NOT NULL,
  `quantity` int(6) NOT NULL,
  `date` date NOT NULL,
  `price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`purchaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `records` (
  `itemID` int(6) NOT NULL,
  `purchaseID` int(6) NOT NULL,
  PRIMARY KEY (`itemID`,`purchaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `shows` (
  `accountID` varchar(30) NOT NULL,
  `purchaseID` int(6) NOT NULL,
  PRIMARY KEY (`accountID`,`purchaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `contains` (
  `personalListID` int(6) NOT NULL,
  `itemID` int(6) NOT NULL,
  PRIMARY KEY (`personalListID`,`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

4. Run these queries

5. Open web browser and enter 'localhost' in the address bar

6. You are all set!
