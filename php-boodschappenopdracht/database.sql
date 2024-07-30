/* for this exercise we don't care about previous data,
 * so we use CREATE OR REPLACE instead of CREATE ... IF NOT EXISTS
 */
CREATE OR REPlACE DATABASE test;

USE test;

CREATE OR REPLACE TABLE groceries (
    productID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    number INT NOT NULL,
    price FLOAT NOT NULL
);

INSERT INTO groceries (name, number, price)
VALUES('Brood', 1, 1.00),
      ('Broccoli', 2, 0.99),
      ('Krentebollen', 4, 1.20),
      ('Noten', 0, 2.99);