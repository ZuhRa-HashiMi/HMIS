CREATE DATABASE hmis CHARACTER SET utf8 COLLATE utf8_general_ci;

USE hmis;

CREATE TABLE users(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username  VARCHAR(32) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type BOOLEAN NOT NULL ,
    admin_level TINYINT NOT NULL DEFAULT 0,
    stock_level  TINYINT NOT NULL DEFAULT 0,
    hr_leval  TINYINT NOT NULL DEFAULT 0,
    finance_level  TINYINT NOT NULL DEFAULT 0,
    pharmacy_level  TINYINT NOT NULL DEFAULT 0,
    laboratoar_level  TINYINT NOT NULL DEFAULT 0,
    patient_level  TINYINT NOT NULL DEFAULT 0


);

CREATE TABLE department (
    department_id INT PRIMARY KEY AUTO_INCREMENT,
    department_name VARCHAR(32) NOT NULL UNIQUE
);

CREATE TABLE staff(
    staff_id INT PRIMARY KEY AUTO_INCREMENT,
    firstname  VARCHAR(32) NOT NULL,
    lastname  VARCHAR(32) NOT NULL,
    gender BOOLEAN  NOT NULL,
    dob INT NOT NULL,
    nic  VARCHAR(32) NOT NULL UNIQUE,
    photo  VARCHAR(32) UNIQUE,
    position  VARCHAR(32) VARCHAR(128) NOT NULL,
    gross_salary INT VARCHAR(32) NOT NULL,
    currency CHAR(3) NOT NULL,
    phone CHAR(10) INT NOT NULL UNIQUE,
    address VARCHAR(64) NOT NULL,
    email VARCHAR(128) UNIQUE, 
    hire_date DATE NOT NULL,
    staff_type INT NOT NULL, 
    department_id INT ,

    CONSTRAINT department_staff_fk  FOREIGN KEY (department_id) REFERENCES department (department_id) ON DELETE SET NULL ON UPDATE CASCADE,
);

CREATE TABLE attendance (
    staff_id INT ,
    absent_year INT ,
    absent_month INT,
    absent_day INT,
    hours INT NOT NULL,

    CONSTRAINT attendance_pk PRIMARY KEY (staff_id, absent_year, absent_month, absent_day),
    CONSTRAINT staff_attenance_fk FOREIGN KEY (staff_id) REFERENCES staff (staff_id) ON DELETE CASCADE ON UPDATE CASCADE

);

CREATE TABLE salary (
    staff_id INT,
    salary_month INT,
    salary_year INT,
    absent_amount FLOAT NOT NULL,
    overtime_amount FLOAT NOT NULL,
    insurance FLOAT NOT NULL,
    tax FLOAT NOT NULL,
    bonus FLOAT NOT NULL,
    net_salary FLOAT NOT NULL,
    pay_date DATE,

    CONSTRAINT staff_salary_fk FOREIGN KEY (staff_id) REFERENCES staff (staff_id) ON DELETE NO ACTION ON UPDATE CASCADE,
    CONSTRAINT salary_pk PRIMARY KEY (staff_id, salary_id, salary_year)
);


CREATE TABLE patient (
    patient_id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(32) NOT NULL,
    lastname  VARCHAR(32) NOT NULL,
    address  VARCHAR(128) NOT NULL,
    phone CHAR(10) NOT NULL UNIQUE,
    gender BOOLEAN NOT NULL,
    birth_year INT NOT NULL,
    history  TEXT


);

CREATE TABLE patient_record (
    patient_record_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    record_date DATE NOT NULL
    sickness  VARCHAR(255) NOT NULL
    staff_id INT NOT NULL ,
    record_result  VARCHAR(32),
    time_in  VARCHAR(32) NOT NULL,
    time_out  VARCHAR(32),
    
    CONSTRAINT patient_record_fk FOREIGN KEY (patient_id) REFERENCES patient (patient_id) ON DELETE NO ACTION ON UPDATE CASCADE,
    CONSTRAINT staff_record_fk FOREIGN KEY (staff_id) REFERENCES staff (staff_id) ON DELETE NO ACTION ON UPDATE CASCADE

);

CREATE TABLE room (
    room_id INT PRIMARY KEY AUTO_INCREMENT,
    room_no INT NOT NULL,
    room_type  VARCHAR(32) NOT NULL,
    department_id INT NOT NULL,
    capacity INT NOT NULL,

    CONSTRAINT room_department_fk FOREIGN KEY (department_id) REFERENCES department (department_id) ON DELETE CASCADE ON UPDATE CASCADE

);


CREATE TABLE test (
    test_id INT PRIMARY KEY AUTO_INCREMENT,
    test_name  VARCHAR(32) NOT NULL,
    test_type  VARCHAR(32) NOT NULL,
    price INT  NOT NULL,
    normal_result VARCHAR(32) NOT NULL
);

CREATE TABLE patient_test (
    patient_test_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL ,
    test_id INT  NOT NULL ,
    test_date DATE NOT NULL,
    test_result VARCHAR(255) NOT NULL,

    CONSTRAINT patient_id_fk FOREIGN KEY (patient_id) REFERENCES patient (patient_id),
    CONSTRAINT patient_test_fk FOREIGN KEY (test_id) REFERENCES test (test_id)
);


CREATE TABLE appointment (
    appointment_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    staff_id INT NOT NULL,
    appointment_date  DATE NOT NULL,
    appointment_number INT NOT NULL,

    CONSTRAINT patient_appointments_fk FOREIGN KEY (patient_id) REFERENCES patient (patient_id),
    CONSTRAINT staff_appointnm_fk  FOREIGN KEY (staff_id) REFERENCES staff (staff_id)

);

CREATE TABLE supplier (
    supplier_id INT PRIMARY KEY AUTO_INCREMENT,
    supplier_name VARCHAR(128) NOT NULL,
    supplier_type VARCHAR(128) NOT NULL,
    country VARCHAR(32) NOT NULL,
    contract BOOLEAN NOT NULL,
    phone VARCHAR(64) NOT NULL UNIQUE,
    email VARCHAR(128) UNIQUE,
    address VARCHAR(32) NOT NULL
);

CREATE TABLE purchase ( 
    purchase_id INT PRIMARY KEY AUTO_INCREMENT,
    supplier_id  INT NOT NULL ,
    item_name VARCHAR(32) NOT NULL,
    purchase_date DATE NOT NULL,
    guarantee VARCHAR(64),
    expire_date DATE NOT NULL,
    quantity FLOAT NOT NULL,
    unitprice FLOAT NOT NULL,
    totalprice FLOAT NOT NULL,
    currency FLOAT NOT NULL,
    CONSTRAINT supplier_purchase FOREIGN KEY (supplier_id) REFERENCES supplier (supplier_id)
);

CREATE TABLE medicine (
    medicine_id INT PRIMARY KEY AUTO_INCREMENT,
    medicine_name VARCHAR(64) NOT NULL,
    description VARCHAR(255),
    form VARCHAR(32) NOT NULL,
    quantity INT NOT NULL,
    unitprice INT NOT NULL,
    expire_date DATE NOT NULL

);

CREATE TABLE patient_medicine (
    patient_medicine_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL ,
    medicine_id INT NOT NULL,
    quantity INT NOT NULL,
    unitprice  INT NOT NULL,
    totalprice INT NOT NULL,
    apply_date DATE NOT NULL,

    CONSTRAINT medicine_id_fk FOREIGN KEY (patient_id) REFERENCES patient (patient_id),
    CONSTRAINT patient_medicine_fk FOREIGN KEY (medicine_id) REFERENCES medicine (medicine_id)

);


CREATE TABLE income (
    income_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL ,
    amount INT NOT NULL, 
    income_type VARCHAR(32) NOT NULL,
    income_date DATE NOT NULL,
);  CONSTRAINT patient_income_fk FOREIGN KEY (patient_id) REFERENCES patient (patient_id)

CREATE TABLE expense (
    expense_id INT PRIMARY KEY AUTO_INCREMENT,
    expense_to VARCHAR(128) NOT NULL,
    amount FLOAT NOT NULL,
    currency CHAR(3) NOT NULL,
    expense_date DATE NOT NULL
    );

CREATE TABLE service (
    service_id INT PRIMARY KEY AUTO_INCREMENT,
    service_name  VARCHAR(128) NOT NULL,
    description TEXT,
    amount INT NOT NULL,
    photo VARCHAR(64),
    timing VARCHAR(32) 


);
