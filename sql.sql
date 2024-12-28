-- Table to store contact messages from students or visitors
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

-- Table to store different specialties offered by the university
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

-- Table to store modules taught in each specialty (e.g., Symmetric Cryptography)
CREATE TABLE modules (
id INT AUTO_INCREMENT PRIMARY KEY,
specialty_id INT NOT NULL,
name VARCHAR(255) NOT NULL,
FOREIGN KEY (specialty_id) REFERENCES specialties(id)
);

-- Table to store certificates associated with modules (e.g., Certified Ethical Hacker)
CREATE TABLE certificates (
id INT AUTO_INCREMENT PRIMARY KEY,
specialty_id INT NOT NULL,
name VARCHAR(255) NOT NULL,
description TEXT,
image VARCHAR(255) NOT NULL,
FOREIGN KEY (specialty_id) REFERENCES specialties(id)
);

-- Table to store references (books, articles, certifications) related to modules
CREATE TABLE reference (
id INT AUTO_INCREMENT PRIMARY KEY,
specialty_id INT NOT NULL,
name VARCHAR(255) NOT NULL, -- Name of the reference
author_or_source VARCHAR(255) NOT NULL, -- Author or source of the reference
description TEXT, -- Description of the reference
read_more_url VARCHAR(255), -- URL for more information
FOREIGN KEY (specialty_id) REFERENCES specialties(id) -- Foreign key to modules table
);