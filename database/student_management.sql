-- Student Management System Database Script
-- Use this script to initialize the database schema and load sample data

CREATE DATABASE IF NOT EXISTS student_management;
USE student_management;

-- Create students table
CREATE TABLE IF NOT EXISTS students (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    student_code VARCHAR(20) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    date_of_birth DATE,
    major VARCHAR(100)
);

-- Create subjects table
CREATE TABLE IF NOT EXISTS subjects (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    subject_code VARCHAR(20) NOT NULL UNIQUE,
    subject_name VARCHAR(100) NOT NULL,
    credits INT NOT NULL
);

-- Create grades table
CREATE TABLE IF NOT EXISTS grades (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    student_id BIGINT NOT NULL,
    subject_id BIGINT NOT NULL,
    score DOUBLE NOT NULL,
    CONSTRAINT fk_grade_student FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    CONSTRAINT fk_grade_subject FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE,
    CONSTRAINT uq_student_subject UNIQUE (student_id, subject_id)
);

-- Insert sample students
INSERT INTO students (student_code, full_name, email, phone, date_of_birth, major) VALUES
('SV001', 'Nguyen Van A', 'nguyenvana@gmail.com', '0912345678', '2003-05-15', 'Information Technology'),
('SV002', 'Tran Thi B', 'tranthib@gmail.com', '0987654321', '2003-10-20', 'Software Engineering'),
('SV003', 'Le Van C', 'levanc@gmail.com', '0901234567', '2004-01-12', 'Data Science'),
('SV004', 'Pham Minh D', 'phamminhd@gmail.com', '0934567890', '2003-08-25', 'Information Assurance'),
('SV005', 'Hoang Thi E', 'hoangthie@gmail.com', '0976543210', '2004-12-05', 'Computer Science');

-- Insert sample subjects
INSERT INTO subjects (subject_code, subject_name, credits) VALUES
('SUB001', 'Java Core', 4),
('SUB002', 'Database Management Systems', 3),
('SUB003', 'Data Structures and Algorithms', 4),
('SUB004', 'Web Development', 3),
('SUB005', 'Software Architecture', 3);

-- Insert sample grades
INSERT INTO grades (student_id, subject_id, score) VALUES
(1, 1, 8.5), -- Nguyen Van A: Java Core - 8.5
(1, 2, 7.0), -- Nguyen Van A: DBMS - 7.0
(1, 3, 9.0), -- Nguyen Van A: DSA - 9.0
(2, 1, 9.0), -- Tran Thi B: Java Core - 9.0
(2, 2, 8.0), -- Tran Thi B: DBMS - 8.0
(2, 4, 8.5), -- Tran Thi B: Web Dev - 8.5
(3, 1, 6.0), -- Le Van C: Java Core - 6.0
(3, 3, 5.5), -- Le Van C: DSA - 5.5
(3, 5, 7.0), -- Le Van C: Software Arch - 7.0
(4, 2, 4.0), -- Pham Minh D: DBMS - 4.0
(4, 4, 5.0), -- Pham Minh D: Web Dev - 5.0
(5, 1, 4.5), -- Hoang Thi E: Java Core - 4.5
(5, 5, 3.5); -- Hoang Thi E: Software Arch - 3.5
