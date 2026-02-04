## Student Management System 🎓
A secure, full-stack web application designed to manage university student records, course enrollments, and academic assignments. This project showcases the evolution from a static HTML academic prototype to a dynamic, production-ready PHP application.

![Static badge](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white) ![Static Badge](https://img.shields.io/badge/Security-Prepared_Statements-green)

### 🛡️ Key Technical Enhancements (Refactored)
- Secure Authentication: Implemented password hashing using Bcrypt (password_hash) to ensure industry-standard credential protection .

- SQL Injection Protection: Refactored all database queries to use Prepared Statements and Parameter Binding, eliminating common web vulnerabilities.   

- Data Interoperability: Developed an XML/XSLT reporting engine that dynamically transforms student data into formatted HTML reports.   

- Robust Architecture: Organized codebase into a clean directory structure with a dedicated /database folder and secure configuration handling via .gitignore .

### 🚀 Main Features
- Role-Based Access Control: Distinct dashboards and permissions for Students and Professors.   

- Course & Assignment Workflow: Real-time management of academic tasks and submissions.

- Work-in-Progress Handling: Integrated professional "Placeholder" views and TODO markers for future feature development (e.g., Assignment View) .

### ⚙️ Installation & Setup (XAMPP)
- Clone the repository: git clone https://github.com/Uthil/Student-Management-System.git

- Database: Import database/student_db.sql via phpMyAdmin. Note: The schema includes anonymized seed data for testing.   

- Config: Rename config.sample.php to config.php and update your local credentials.

- PHP Extension: Ensure the xsl extension is enabled in your php.ini for the reporting features to work.

### 🎓 Project Origin & Context
This project was originally developed as a graded assignment for the PLH23 (Web Technologies) module at the Hellenic Open University (HOU) during the 2024-25 academic year.

Post-submission, the codebase underwent a significant architectural refactor to implement:
 - Industry-standard security (Bcrypt, Prepared Statements).
 - Clean code directory structures.
 - Professional documentation practices.

### 🔄 Project Evolution
This repository documents the transition from a legacy static frontend (MSC) to a modern dynamic backend system. View the original prototype [here](https://github.com/Uthil/MSC) .
