-- Database creation script for Doctor Consultation System
-- Run this script in phpMyAdmin if you prefer manual database setup

-- Create database
CREATE DATABASE IF NOT EXISTS doctor_consultation;

-- Use the database
USE doctor_consultation;

-- Create consultations table
CREATE TABLE IF NOT EXISTS consultations (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    doctor VARCHAR(100) NOT NULL,
    name VARCHAR(50) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    disease VARCHAR(100) NOT NULL,
    amount VARCHAR(50) NOT NULL,
    sex VARCHAR(10) NOT NULL,
    question TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Optional: Add sample doctor data
-- CREATE TABLE IF NOT EXISTS doctors (
--     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(100) NOT NULL,
--     specialization VARCHAR(100) NOT NULL,
--     availability VARCHAR(255) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- 
-- INSERT INTO doctors (name, specialization, availability) VALUES
--     ('Dr. John Smith', 'General Medicine', 'Monday, Wednesday, Friday'),
--     ('Dr. Sarah Johnson', 'Cardiology', 'Tuesday, Thursday'),
--     ('Dr. Robert Williams', 'Pediatrics', 'Monday, Tuesday, Friday'),
--     ('Dr. Emily Davis', 'Dermatology', 'Wednesday, Thursday, Saturday');