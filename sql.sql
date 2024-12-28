-- Table to store contact messages
CREATE TABLE messages (
id INT AUTO_INCREMENT PRIMARY KEY,
student_id INT NULL,
name VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
phone VARCHAR(20),
message TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE SET NULL
);

-- Table to store student details
CREATE TABLE students (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
specialty_id INT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (specialty_id) REFERENCES specialties(id)
);

-- Table to store specialties offered by us
CREATE TABLE specialties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    specialty_type ENUM('License', 'Masters', 'PhD') NOT NULL,
    description TEXT, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table to store admin account information
CREATE TABLE admins (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
email VARCHAR(100) NOT NULL UNIQUE,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table to store modules 
CREATE TABLE modules (
id INT AUTO_INCREMENT PRIMARY KEY,
specialty_id INT NOT NULL,
name VARCHAR(255) NOT NULL,
FOREIGN KEY (specialty_id) REFERENCES specialties(id)
);

-- Table to store certificates
CREATE TABLE certificates (
id INT AUTO_INCREMENT PRIMARY KEY,
specialty_id INT NOT NULL,
name VARCHAR(255) NOT NULL,
description TEXT,
image VARCHAR(255) NOT NULL,
FOREIGN KEY (specialty_id) REFERENCES specialties(id)
);

-- Table to store references 
CREATE TABLE reference (
id INT AUTO_INCREMENT PRIMARY KEY,
specialty_id INT NOT NULL,
name VARCHAR(255) NOT NULL,
author_or_source VARCHAR(255) NOT NULL, 
description TEXT,
read_more_url VARCHAR(255), 
FOREIGN KEY (specialty_id) REFERENCES specialties(id) 
);