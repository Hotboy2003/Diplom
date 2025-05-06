CREATE TABLE IF NOT EXISTS contacts
(
    contact_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name  VARCHAR(255) NOT NULL,
    phone      VARCHAR(20)  NOT NULL,
    email      VARCHAR(50)  NOT NULL
);

CREATE TABLE IF NOT EXISTS supply_types
(
    type_id     INT AUTO_INCREMENT PRIMARY KEY,
    supply_type VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS status_types
(
    status_id   INT AUTO_INCREMENT PRIMARY KEY,
    status_name VARCHAR(50) UNIQUE NOT NULL,
    is_system   BOOLEAN DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS suppliers
(
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) NOT NULL,
    inn         VARCHAR(20) UNIQUE,
    status_id   INT          NOT NULL,
    contact_id  INT,
    website     VARCHAR(255),
    address     VARCHAR(255),
    notes       TEXT,
    FOREIGN KEY (contact_id) REFERENCES contacts (contact_id),
    FOREIGN KEY (status_id) REFERENCES status_types (status_id)
);

CREATE TABLE IF NOT EXISTS supplier_supply_types
(
    supplier_id INT NOT NULL,
    type_id     INT NOT NULL,
    PRIMARY KEY (supplier_id, type_id),
    FOREIGN KEY (supplier_id) REFERENCES suppliers (supplier_id) ON DELETE CASCADE,
    FOREIGN KEY (type_id) REFERENCES supply_types (type_id) ON DELETE CASCADE
);