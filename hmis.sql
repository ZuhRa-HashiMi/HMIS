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
    position  VARCHAR(32) NOT NULL,
    gross_salary VARCHAR(32) NOT NULL,
    currency CHAR(3) NOT NULL,
    phone CHAR(10) NOT NULL UNIQUE,
    address VARCHAR(64) NOT NULL,
    email VARCHAR(128) UNIQUE, 
    hire_date DATE NOT NULL,
    staff_type INT NOT NULL, 
    department_id INT ,

    CONSTRAINT department_staff_fk  FOREIGN KEY (department_id) REFERENCES department (department_id) ON DELETE SET NULL ON UPDATE CASCADE
);


CREATE TABLE patient (
    patient_id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(32) NOT NULL,
    lastname  VARCHAR(32) NOT NULL,
    province VARCHAR(128) NOT NULL,
    current_location VARCHAR(128) NOT NULL,
    phone CHAR(10) NOT NULL UNIQUE,
    gender BOOLEAN NOT NULL,
    birth_year INT NOT NULL,
    history  TEXT


);

CREATE TABLE patient_record (
    patient_record_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT,
    record_date DATE NOT NULL,
    sickness  VARCHAR(255) NOT NULL,
    doctor VARCHAR(32) NOT NULL ,
    
    CONSTRAINT patient_record_fk FOREIGN KEY (patient_id) REFERENCES patient (patient_id) ON DELETE NO ACTION ON UPDATE CASCADE

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


CREATE TABLE medicine (
    medicine_id INT PRIMARY KEY AUTO_INCREMENT,
    medicine_name VARCHAR(64) NOT NULL,
    description VARCHAR(255),
    form VARCHAR(32) NOT NULL,
    quantity VARCHAR(68) NOT NULL,
    unitprice VARCHAR(32) NOT NULL,
    expire_date DATE NOT NULL
kk
);

CREATE TABLE patient_medicine (
    patient_medicine_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL ,
    medicine  VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    unitprice  INT NOT NULL,
    totalprice INT NOT NULL,
    apply_date DATE NOT NULL,

    CONSTRAINT medicine_id_fk FOREIGN KEY (patient_id) REFERENCES patient (patient_id)

);

CREATE TABLE service (
    service_id INT PRIMARY KEY AUTO_INCREMENT,
    service_name  VARCHAR(128) NOT NULL,
    description TEXT,
    amount INT NOT NULL,
    photo VARCHAR(64),
    timing VARCHAR(32) 


);
