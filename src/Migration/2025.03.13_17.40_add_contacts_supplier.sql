ALTER TABLE suppliers
    DROP FOREIGN KEY suppliers_ibfk_1;
ALTER TABLE suppliers
    DROP COLUMN contact_id;

CREATE TABLE IF NOT EXISTS supplier_contacts
(
    supplier_id INT NOT NULL,
    contact_id  INT NOT NULL,
    PRIMARY KEY (supplier_id, contact_id),
    FOREIGN KEY (supplier_id)
        REFERENCES suppliers (supplier_id)
        ON DELETE CASCADE,
    FOREIGN KEY (contact_id)
        REFERENCES contacts (contact_id)
        ON DELETE CASCADE
) ENGINE = InnoDB;