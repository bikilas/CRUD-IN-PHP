# CRUD-IN-PHP# Student Registration CRUD Application

This is a simple Student Registration CRUD (Create, Read, Update, Delete) application built with PHP and MySQL. The project allows users to manage student records, including adding, updating, deleting, and uploading files.

## Features
- Add new student records with image and file uploads
- View a list of all registered students
- Update student information
- Delete student records
- Upload additional files for student records



## Technologies Used
- PHP
- MySQL
- Bootstrap (for UI)
- HTML/CSS

## Setup and Installation
1. Clone the repository:
```bash
$ git clone https://github.com/bikilas/CRUD-IN-PHP.git
```
2. Start XAMPP and ensure Apache and MySQL are running.
3. Create a MySQL database named `student_db` and run the following SQL to create the students table:
```sql
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    age INT NOT NULL,
    image VARCHAR(255) NOT NULL,
    file VARCHAR(255) NOT NULL
);
```
4. Update `dbcon.php` with your database credentials:
```php
<?php
$connection = mysqli_connect('localhost', 'root', '', 'student_db');
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
```
5. Ensure the `uploads/` directory exists and has write permissions:
```bash
$ mkdir uploads
$ chmod 777 uploads
```
6. Access the application in your browser:
```
http://localhost/crud_operation/index.php
```

## Usage
- **Add Student:** Click the 'ADD STUDENTS' button, fill in the form, and submit.
- **Update Student:** Click the 'Update' button next to a student record.
- **Delete Student:** Click the 'Delete' button next to a student record.
- **Upload File:** Click the 'Upload' button next to a student record.

## Error Handling
- Displays user-friendly error messages for database errors and file upload issues.
- Ensures required fields are filled before submission.

## Contribution
Feel free to fork the repository and submit pull requests.

## License
This project is licensed under the MIT License.

