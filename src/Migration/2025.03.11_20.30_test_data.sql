INSERT INTO contacts (full_name, phone, email)
VALUES ('Иван Иванов', '+79100000001', 'ivan@mail.com'),
       ('Петр Петров', '+79100000002', 'petr@mail.com'),
       ('Семен Сидоров', '+79100000003', 'semen@mail.com');

-- Заполнение таблицы status_types
INSERT INTO status_types (status_name, is_system)
VALUES ('Активен', TRUE),
       ('На проверке', FALSE),
       ('Отклонен', TRUE);

-- Заполнение таблицы supply_types
INSERT INTO supply_types (supply_type)
VALUES ('Электроника'),
       ('Одежда'),
       ('Продукты питания');

-- Заполнение таблицы suppliers
INSERT INTO suppliers (name, inn, status_id, contact_id, website, address, notes)
VALUES ('ООО Ромашка', '1234567890', 1, 1, 'romashka.ru', 'Москва', NULL),
       ('ООО Луч', '0987654321', 2, 2, 'luch.ru', 'СПб', NULL),
       ('ИП Сидоров', '1122334455', 1, 3, NULL, 'Казань', 'Поставщик проверен');

-- Связь поставщиков с типами поставок
INSERT INTO supplier_supply_types (supplier_id, type_id)
VALUES (1, 1),
       (1, 2),
       (2, 3),
       (3, 2);