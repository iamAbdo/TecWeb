-- Insert the specialty and retrieve its ID
INSERT INTO specialties (name, specialty_type, description) 
VALUES 
('Software Engineering', 'License', 'Software engineering is a discipline that combines principles of computer science, engineering, and project management to design, develop, test, and maintain software systems. It is a systematic approach to creating software that meets specific requirements, is reliable, and can be maintained over time.');

-- Use LAST_INSERT_ID() to reference the inserted specialty
SET @specialty_id = LAST_INSERT_ID();

-- Insert modules
INSERT INTO modules (specialty_id, name) 
VALUES
(@specialty_id, 'Basics of programming languages'),
(@specialty_id, 'Algorithm optimization and complexity analysis'),
(@specialty_id, 'Project management and collaborative tools'),
(@specialty_id, 'Database design and normalization'),
(@specialty_id, 'Software vulnerabilities and defenses'),
(@specialty_id, 'User interface and experience design');

-- Insert references
INSERT INTO reference (specialty_id, name, author_or_source, description, read_more_url) 
VALUES
(@specialty_id, 'Algorithm optimization and complexity analysis', 'Ioannis C. Demetriou , Panos M. Pardalos', 'This book focuses on the development of approximation-related algorithms and their relevant applications.', 'https://link.springer.com/book/10.1007/978-3-030-12767-1'),
(@specialty_id, 'Database design and normalization', 'BCcampus', 'The book is relatively short compared to most database texts, even those of an introductory nature, but it\'s still fairly comprehensive.', 'https://open.umn.edu/opentextbooks/textbooks/354'),
(@specialty_id, 'Software vulnerabilities and defenses', 'Herbert Hugh Thompson , Scott G Chase', 'The Software Vulnerability Guide focuses on the origin of most software vulnerabilities, including the bugs in the underlying software used to develop IT infrastructures and the Internet.', 'https://www.eccouncil.org/programs/certified-ethical-hacker-ceh/'),
(@specialty_id, 'User interface and experience design', 'Don Norman', 'Don Norman’s seminal work will fundamentally change your perspective on the world around you. Through examining everything from doors to software, Norman reveals the power of good design and the frustration of poor design.', 'https://www.interaction-design.org/literature/article/ux-design-books-guide');

-- Insert certificates
INSERT INTO certificates (specialty_id, name, description, image) 
VALUES
(@specialty_id, 'Certified Software Development Professional (CSDP)', 'This certification offered by the IEEE Computer Society, focuses on software engineering principles, lifecycle processes, and best practices.', 'uploads/certificates/SE_cert1.png'),
(@specialty_id, 'Certified Software Quality Analyst (CSQA)', 'Focuses on quality assurance principles and methods in software engineering.', 'uploads/certificates/SE_cert2.png'),
(@specialty_id, 'Microsoft Certified: Azure Developer Associate', 'This certification demonstrates skills in developing cloud applications on Microsoft Azure.', 'uploads/certificates/SE_cert3.png'),
(@specialty_id, 'Google Professional Machine Learning Engineer', 'This certificate Validates expertise in designing and building machine learning models on Google Cloud.', 'uploads/certificates/SE_cert4.png'),
(@specialty_id, 'Project Management Professional (PMP)', 'This certificat validates project management skills, including software projects.', 'uploads/certificates/SE_cert5.webp'),
(@specialty_id, 'Certified Kubernetes Application Developer (CKAD)', 'This certificat focuses on designing and deploying containerized applications using Kubernetes.', 'uploads/certificates/SE_cert6.webp');


START TRANSACTION;

-- Insert the Computer Science specialty
INSERT INTO specialties (name, description) 
VALUES 
('Computer Science', 'Computer Science is a discipline that combines principles of mathematics, algorithms, and programming to design, develop, test, and maintain software systems. It focuses on the theoretical foundations of computation and its practical applications.');

SET @specialty_id_cs = LAST_INSERT_ID();

-- Insert modules for Computer Science
INSERT INTO modules (specialty_id, name) 
VALUES 
(@specialty_id_cs, 'Introduction to Algorithms'),
(@specialty_id_cs, 'Data Structures'),
(@specialty_id_cs, 'Operating Systems'),
(@specialty_id_cs, 'Computer Networks'),
(@specialty_id_cs, 'Artificial Intelligence'),
(@specialty_id_cs, 'Cryptography and Cybersecurity');

-- Insert references for Computer Science
INSERT INTO reference (specialty_id, name, author_or_source, description, read_more_url) 
VALUES
(@specialty_id_cs, 'Introduction to Algorithms', 'Thomas H. Cormen', 'This book focuses on algorithm design and analysis.', 'https://link.springer.com/book/10.1007/978-3-030-12767-1'),
(@specialty_id_cs, 'Data Structures', 'Mark Allen Weiss', 'A comprehensive guide to data structures in computer science.', 'https://open.umn.edu/opentextbooks/textbooks/354'),
(@specialty_id_cs, 'Artificial Intelligence', 'Stuart Russell', 'An in-depth look into AI principles and methods.', 'https://www.eccouncil.org/programs/certified-ethical-hacker-ceh/'),
(@specialty_id_cs, 'Cryptography and Cybersecurity', 'William Stallings', 'A practical guide to cryptography and securing computer systems.', 'https://www.interaction-design.org/literature/article/ux-design-books-guide');

-- Insert certificates for Computer Science
INSERT INTO certificates (specialty_id, name, description, image) 
VALUES
(@specialty_id_cs, 'Certified Software Developer (CSD)', 'This certification focuses on advanced software development techniques and methodologies.', 'src/img/cs/cs.png'),
(@specialty_id_cs, 'Certified Data Scientist (CDS)', 'Focuses on data science principles and applications in computer science.', 'src/img/cs/CDS.jpg'),
(@specialty_id_cs, 'Microsoft Certified: AI Specialist', 'This certification demonstrates skills in AI systems development on Microsoft Azure.', 'src/img/cs/azure.png'),
(@specialty_id_cs, 'Google Professional Data Engineer', 'This certificate validates expertise in data engineering on Google Cloud.', 'src/img/cs/data.png'),
(@specialty_id_cs, 'Project Management Professional (PMP)', 'This certificate validates project management skills, including software projects.', 'src/img/cs/PMP-formation-PTC-IT-1000x562.png'),
(@specialty_id_cs, 'Certified Machine Learning Engineer (CMLE)', 'This certification focuses on designing and deploying machine learning models.', 'src/img/cs/cmle.jpg');

-- Insert the Cryptography and Cyber Security specialty
INSERT INTO specialties (name, description) 
VALUES 
('Cryptography and Cyber Security', 
'Cryptography and Cyber Security are essential fields in the protection of data and computer systems. This program focuses on the study of encryption techniques, secure protocols, and defense strategies against cyberattacks. The goal is to train experts capable of designing, analyzing, and maintaining robust security systems in an increasingly complex digital world.');

SET @specialty_id_crypto = LAST_INSERT_ID();

-- Insert modules for Cryptography and Cyber Security
INSERT INTO modules (specialty_id, name) 
VALUES 
(@specialty_id_crypto, 'Symmetric Cryptography'),
(@specialty_id_crypto, 'Asymmetric Cryptography'),
(@specialty_id_crypto, 'Security Protocols'),
(@specialty_id_crypto, 'Threat and Vulnerability Analysis'),
(@specialty_id_crypto, 'Post-Quantum Cryptography'),
(@specialty_id_crypto, 'Network Security');

-- Insert certificates for Cryptography and Cyber Security
INSERT INTO certificates (specialty_id, name, description, image) 
VALUES
(@specialty_id_crypto, 'Certified Ethical Hacker (CEH)', 'This certification demonstrates your skills in penetration testing and ethical hacking techniques.', 'src/img/certificat/certificat1.jpg'),
(@specialty_id_crypto, 'Certified Information Systems Security Professional (CISSP)', 'Recognized globally, this certification is for professionals specializing in information security.', 'src/img/certificat/certificat2.jpg'),
(@specialty_id_crypto, 'CompTIA Security+', 'This certification covers foundational knowledge in cybersecurity, including risk management and encryption.', 'src/img/certificat/certificat3.jpg'),
(@specialty_id_crypto, 'Certified Cloud Security Professional (CCSP)', 'This certificate focuses on securing cloud services, architecture, and compliance.', 'src/img/certificat/certificat4.jpg');

-- Insert references for Cryptography and Cyber Security
INSERT INTO reference (specialty_id, name, author_or_source, description, read_more_url) 
VALUES
(@specialty_id_crypto, 'Introduction to Modern Cryptography', 'Jonathan Katz, Yehuda Lindell', 'This book provides a comprehensive introduction to modern cryptography, with a focus on both theoretical and practical aspects.', 'https://www.springer.com/gp/book/9783030612606'),
(@specialty_id_crypto, 'Security Engineering: A Guide to Building Dependable Distributed Systems', 'Ross Anderson', 'A seminal work in the field of security engineering, covering a wide range of security issues from cryptography to system design.', 'https://www.wiley.com/en-us/Security+Engineering%3A+A+Guide+to+Building+Dependable+Distributed+Systems%2C+3rd+Edition-p-9781119642788'),
(@specialty_id_crypto, 'Certified Ethical Hacker (CEH)', 'EC-Council', 'A globally recognized certification in ethical hacking, covering various techniques in penetration testing and vulnerability assessment.', 'https://www.eccouncil.org/programs/certified-ethical-hacker-ceh/'),
(@specialty_id_crypto, 'CompTIA Security+ Certification', 'CompTIA', 'This certification focuses on foundational skills in cybersecurity, covering areas like risk management, encryption, and network security.', 'https://www.comptia.org/certifications/security');



-- Insert Specialty
INSERT INTO specialties (name, description)
VALUES 
('Database Engineering', 
 'Database Engineering involves the design, implementation, and management of databases. It focuses on creating efficient, reliable, and scalable databases to support a wide range of applications. Database engineers work with relational and non-relational databases, ensuring optimal performance, security, and data integrity.',);

-- Insert Modules
INSERT INTO modules (specialty_id, name)
VALUES
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Introduction to Database Systems'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Database Design and Normalization'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'SQL and Query Optimization'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Database Security and Backup'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Big Data and NoSQL Databases'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Database Performance Tuning');

-- Insert Certificates
INSERT INTO certificates (specialty_id, name, description, image)
VALUES
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Oracle Certified Professional (OCP)', 'This certification validates expertise in Oracle database management, including installation, configuration, and optimization.', 'src/img/dbe/oracle.png'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Microsoft Certified: Azure Database Administrator Associate', 'Focuses on skills related to managing and maintaining databases on Microsoft Azure cloud platforms.', 'src/img/dbe/azure.png'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Google Professional Data Engineer', 'This certification demonstrates proficiency in designing and building scalable data processing systems on Google Cloud.', 'src/img/dbe/data.png'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'MongoDB Certified Developer Associate', 'This certification is for developers who work with MongoDB, a leading NoSQL database.', 'src/img/dbe/mongo.png'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Project Management Professional (PMP)', 'This certificate validates project management skills, including database-related projects.', 'src/img/dbe/PMP-formation-PTC-IT-1000x562.png'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Certified Database Administrator (CDBA)', 'This certification validates expertise in the administration of databases across various platforms.', 'src/img/dbe/cdba.jpg');

INSERT INTO reference (specialty_id, name, author_or_source, description, read_more_url)
VALUES
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Database Design and Normalization', 'Thomas Connolly, Carolyn Begg', 'This book provides a comprehensive introduction to database design and normalization techniques.', 'https://link.springer.com/book/10.1007/978-3-030-12767-1'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'SQL and Query Optimization', 'Grant Fritchey', 'This book focuses on writing optimized SQL queries and improving query performance.', 'https://open.umn.edu/opentextbooks/textbooks/354'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Big Data and NoSQL Databases', 'Pradeep Gohil', 'This reference book dives into the world of NoSQL databases and handling big data.', 'https://www.eccouncil.org/programs/certified-ethical-hacker-ceh/'),
((SELECT id FROM specialties WHERE name = 'Database Engineering'), 'Database Security', 'Bertino, E., Sandhu, R.', 'This work covers advanced topics in database security, including access control and encryption techniques.', 'https://www.interaction-design.org/literature/article/ux-design-books-guide');