Student and Teacher Management System
A web-based platform designed to manage students, teachers, and supervisors in a school or educational institution. The system provides different levels of access, depending on the user's role (Supervisor, Teacher, and Student). The Supervisor has the most authority to manage the system, followed by the Teacher and then the Student.

Table of Contents
    Project Overview
    Features
    Technology Stack
    Installation
    Usage
    Folder Structure
    Contributing
    License
    Project Overview
This system is designed to handle three types of users:

Supervisor:
The highest-level user in the system. Supervisors have full control over the students and teachers. They can:

  Monitor all students and resource teachers.
  Add new students and teachers to the system.
  Assign students to teachers.
  Create announcements for all users.
  View the progress summary of all students.
  Note: Supervisors cannot score students or approve DTRs.

Teacher:
Teachers can evaluate students and approve their Daily Time Records (DTR). Teachers have additional functionalities such as:

  Evaluate and approve DTR submissions from students.
  Add tasks and maintain a to-do list.
  View progress summaries for their assigned students.

Student:
Students have limited functionality and mainly interact with the system to input their own data and view important updates. They can:

  View announcements made by Supervisors or Teachers.
  Insert daily logs of their activities.
  Mark tasks in their to-do list as "done."

Features

Supervisor Features:

  Manage Students: Add, update, and delete students in the system.
  Manage Teachers: Add, update, and delete teachers in the system.
  Assign Teachers to Students: Assign or change the teacher for a particular student.
  Create Announcements: Announcements are visible to all users (students and teachers).
  Monitor Student Progress: View the academic progress of all students.

Teacher Features:

  Evaluate Students: Teachers can evaluate students and approve their DTRs.
  To-Do List: Teachers can create and manage a to-do list for themselves.
  View Student Progress: Teachers can see the progress of the students they are assigned to.

Student Features:

  Daily Log: Students can log their activities for the day.
  View Announcements: Students can view system-wide announcements.
  To-Do List: Students can manage their to-do list and mark tasks as completed.

Technology Stack

Frontend:

  HTML5
  CSS3 (with Bootstrap for responsive design)
  JavaScript (for dynamic and interactive features)
  AJAX (for asynchronous data fetching)
  XML (for data transfer in some scenarios)

Backend:

  PHP (server-side scripting language)
  CodeIgniter 4 (PHP framework)
  
Database:

  MySQL (for storing user data, logs, progress, etc.)

Others:

  Responsive Web Design (supports various screen sizes, such as desktop, tablets, and mobile)
  Bootstrap (for styling and responsive layout)
  Installation
  Prerequisites:
  PHP >= 7.4
  MySQL Database Server
  CodeIgniter 4 Framework
  A web server (Apache or Nginx)
  Steps to Set Up Locally:
  Clone the repository:


bash
git clone https://github.com/yourusername/yourprojectname.git
cd yourprojectname
Install dependencies (if applicable): Follow any specific instructions for installing PHP packages or dependencies if you're using Composer, for example:

bash
composer install
Set up the database:

Create a new MySQL database and import the provided SQL dump to create the necessary tables.
Update the database connection settings in app/config/Database.php (or app/config/database.php in CodeIgniter 4).
Set Permissions: Ensure that the system has the correct permissions for writing logs and files.

Access the system:

Open the system in a browser by navigating to the appropriate URL (e.g., http://localhost/yourprojectname).

Usage

Log In:

Supervisor: Login as a supervisor to add users, create announcements, and monitor progress.
Teacher: Login as a teacher to evaluate students and manage their to-do list.
Student: Login as a student to view announcements, insert daily logs, and manage their tasks.
Key Functionalities:

As a Supervisor, add new teachers and students, assign them to each other, and view student progress summaries.
As a Teacher, evaluate students' performance, approve DTRs, and manage personal to-do lists.
As a Student, insert your daily logs and view the assigned tasks and announcements.
Folder Structure

Here’s a quick overview of the folder structure:

bash
Copy code
/yourprojectname
├── app/
│   ├── Controllers/       # Controllers for various user roles and pages
│   ├── Models/            # Models for interacting with the database
│   ├── Views/             # HTML and PHP views for the frontend
│   └── Config/            # Configuration files (database, app settings)
├── public/                # Public assets (CSS, JS, images)
├── system/                # Core CodeIgniter framework files
└── writable/              # Writable files (logs, cache, etc.)

Contributing
If you would like to contribute to the development of this project, please follow these guidelines:

  Fork the repository and create your feature branch.
  Write tests for any new features or bug fixes.
  Make sure to follow the code style defined in the project.
  Submit a Pull Request with a detailed description of your changes.
  License
  This project is licensed under the MIT License – see the LICENSE file for details.

End of README
This README.md provides an overview of the system, its features, and the technologies used, and it offers guidance on installation and usage. Make sure to update any project-specific details, like repository links or specific database configurations, as needed.
