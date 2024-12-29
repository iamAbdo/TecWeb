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
