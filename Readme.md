# Placement Portal - Complete Project Documentation

## 📋 Project Overview
A comprehensive job placement portal system built with PHP and MySQL, designed to connect job seekers with recruiters. The system supports three user roles: Admin, Recruiter, and Candidate, each with distinct functionalities and access levels.

---

## 🏗️ Technology Stack

### Frontend Technologies
- **HTML5/CSS3**: Structure and styling
- **Bootstrap**: Responsive UI framework
- **JavaScript/jQuery**: Interactive functionality
- **Revolution Slider**: Hero banner slider
- **Font Awesome**: Icon library
- **Summernote**: Rich text editor for admin panel

### Backend Technologies
- **PHP 8.2+**: Server-side scripting
- **MySQL/MariaDB**: Database management
- **PHPMailer**: Email functionality
- **Faker**: Test data generation

### Server Requirements
- **XAMPP/WAMP/LAMP**: Local development server
- **Apache**: Web server
- **PHP 8.2+**: PHP runtime
- **MySQL 10.4+**: Database server

---

## 📁 Project Structure & File Documentation

### 🗂️ Root Directory Files

#### **index.php**
Main landing page displaying recent job listings with search functionality. Features a hero banner with job search form (keyword, city, sector filters) and displays the latest 10 verified job postings.

#### **header.php**
Common header component included across all public pages. Contains navigation menu, session-based user authentication display, logo, and responsive mobile menu toggle.

#### **footer.php**
Common footer component with site links and copyright information. Included at the bottom of all public-facing pages for consistent branding.

#### **login.php**
Authentication page handling login for both candidates and recruiters. Validates credentials against database, creates session variables, and redirects users to their respective dashboards based on user type.

#### **logout.php**
Session destruction script that logs out users and redirects to homepage. Clears all session variables and destroys the session to ensure secure logout.

#### **register.php**
Candidate registration form with email validation and PDF resume upload. Creates new user accounts with hashed passwords and stores resume files in the `/resume` directory.

#### **register-recruiter.php**
Recruiter/company registration page for organizations to create accounts. Collects company details, contact information, and credentials for recruiter accounts.

#### **register-choice.php**
Registration type selection page allowing users to choose between candidate or recruiter registration. Provides navigation to appropriate registration forms based on user selection.

#### **browse-job.php**
Job listing page with advanced search and filter options. Displays all verified jobs with pagination, search by keyword/location/type, and detailed job cards with company information.

#### **job-detail.php**
Individual job detail page showing complete job information including description, requirements, salary, deadline, and application button. Fetches job data with related recruiter and location information.

#### **apply.php**
Job application handler that processes candidate applications for specific jobs. Checks for duplicate applications and inserts application records into the `applied_jobs` table with pending status.

#### **my-jobs.php**
User dashboard showing applied jobs for candidates or posted jobs for recruiters. Displays job list with application status (Pending/Accepted/Rejected) and application dates.

#### **candidate-profile.php**
Candidate profile display page showing user information, resume download link, and personal details. Shows profile data from the `users` table for logged-in candidates.

#### **profile.php**
Job posting form for recruiters to create new job listings. Collects job details including title, description, requirements, salary, deadline, sector, city, and optional job image upload.

#### **post.php**
Job posting processing script that validates and saves job data to database. Handles file uploads for job images and sets initial job status as pending for admin verification.

#### **recruiter-dashboard.php**
Recruiter control panel displaying posted jobs, application statistics, and management options. Shows total jobs posted, pending applications count, and links to manage job postings and view applicants.

#### **applied-candidates.php**
Page displaying all candidates who applied for a specific job posting. Shows candidate list with application status, allows recruiters to view resumes and update application status.

#### **update_candidate_status.php**
AJAX endpoint for updating candidate application status (Pending/Accepted/Rejected). Uses prepared statements to securely update the `applied_jobs` table status field.

#### **submit-resume.php**
Resume submission form page (currently static template). Provides interface for candidates to submit or update their resume information and professional details.

#### **forgot-password.php**
Password recovery page that sends reset links via email using PHPMailer. Generates reset tokens, sends email notifications, and provides password reset functionality.

#### **contact.php**
Contact page displaying company information and contact details. Shows address, email, phone number, and provides a contact form for user inquiries.

#### **check-session.php**
Session validation utility file that checks if user is logged in. Redirects unauthenticated users to login page and is included in protected pages.

---

### 📂 Admin Directory Files

#### **admin/index.php**
Admin login page for administrative access to the portal. Authenticates admin users using username/password and creates admin session with role-based access.

#### **admin/dashboard.php**
Admin dashboard displaying system statistics and overview. Shows total jobs, recruiters, and applied jobs counts with visual cards and navigation to management sections.

#### **admin/header.php**
Admin panel header with navigation menu and admin-specific styling. Includes sidebar navigation, admin name display, and logout functionality using SB Admin template.

#### **admin/footer.php**
Admin panel footer component with closing HTML tags and scripts. Ensures proper page structure and includes necessary JavaScript files for admin functionality.

#### **admin/logout.php**
Admin logout script that destroys admin session and redirects to admin login. Clears all admin session variables and ensures secure logout from admin panel.

#### **admin/jobs-index.php**
Job management page listing all job postings with verification status. Allows admins to view, verify, reject, or delete job postings with status filters and search functionality.

#### **admin/view-job.php**
Detailed view of a single job posting for admin review. Displays complete job information including recruiter details, application count, and provides options to verify or reject the job.

#### **admin/postjobs-index.php**
Page showing jobs pending admin verification. Lists unverified jobs that require admin approval before being visible to candidates on the public portal.

#### **admin/recruiter-index.php**
Recruiter management page listing all registered recruiters. Displays recruiter information, company details, and provides options to view details or manage recruiter accounts.

#### **admin/view-recruiter.php**
Detailed recruiter profile view showing company information and posted jobs. Displays recruiter details, contact information, and list of all jobs posted by that recruiter.

#### **admin/users-index.php**
Candidate/user management page listing all registered candidates. Shows user information, registration dates, and provides options to view candidate profiles and resumes.

#### **admin/view-user.php**
Detailed candidate profile view displaying personal information and resume. Shows candidate details, application history, and provides resume download functionality.

#### **admin/selected-students.php**
Page displaying candidates with accepted application status. Lists all candidates who have been selected/accepted for jobs, useful for tracking successful placements.

#### **admin/city-index.php**
City management page for adding, editing, and deleting cities. Provides CRUD operations for the city table used in job postings and search filters.

#### **admin/add-city.php**
Form page for adding new cities to the system. Allows admins to create new city entries that can be used in job postings and candidate profiles.

#### **admin/edit-city.php**
City editing form for modifying existing city records. Updates city names in the database and maintains referential integrity with job postings.

#### **admin/sector-index.php**
Sector/industry management page for job categories. Lists all job sectors (IT, Finance, Healthcare, etc.) with options to add, edit, or delete sectors.

#### **admin/add-sector.php**
Form for creating new job sectors or industry categories. Allows admins to add new sector types that recruiters can select when posting jobs.

#### **admin/edit-sector.php**
Sector editing form for updating existing job categories. Modifies sector names while ensuring existing job postings maintain their sector associations.

#### **admin/main.js**
JavaScript file for admin panel interactive functionality. Handles AJAX requests, form validations, and dynamic content updates in the admin interface.

---

### 📂 Source (src) Directory Files

#### **src/Database.php**
Singleton database connection class using MySQLi. Provides a single database instance across the application, handles connection errors, and ensures efficient database resource management.

#### **src/mailer.php**
Email configuration and sending functions using PHPMailer library. Configures SMTP settings for Gmail, handles password reset emails, and includes IMAP functionality for sent mail tracking.

#### **src/faker.php**
Test data generation script using Faker library. Populates database with fake recruiters, jobs, cities, and sectors for development and testing purposes.

---

### 📂 Configuration Files

#### **composer.json**
PHP dependency management file defining project requirements. Specifies PHPMailer and Faker libraries as dependencies for email functionality and test data generation.

#### **composer.lock**
Locked dependency versions ensuring consistent installations. Prevents version conflicts by locking specific versions of all Composer dependencies.

#### **database/placement.sql**
Complete database schema and initial data dump. Contains all table structures (admin, users, recruiter, jobs, applied_jobs, city, sector, professional_details) with relationships and sample data.

---

### 📂 Asset Directories

#### **css/**
Stylesheet directory containing custom CSS and template styles. Includes main stylesheet, skin themes, plugin styles, and responsive design CSS files.

#### **js/**
JavaScript directory with custom scripts and jQuery plugins. Contains custom.js for site-specific functionality, jQuery library, and various plugin scripts for UI interactions.

#### **images/**
Image assets directory for logos, banners, backgrounds, and uploaded content. Organized into subdirectories for backgrounds, banners, logos, gallery, and user-uploaded job images.

#### **plugins/**
Third-party plugin directory for Bootstrap, Font Awesome, sliders, and UI components. Contains all external libraries and plugins used for enhanced UI/UX functionality.

#### **resume/**
PDF resume storage directory for candidate resumes. Stores uploaded resume files with MD5-hashed filenames for security and organization.

---

## 🗄️ Database Structure

### Core Tables

1. **admin** - Administrator accounts with username, password, and role
2. **users** - Candidate accounts with personal information and resume links
3. **recruiter** - Recruiter/company accounts with company details
4. **jobs** - Job postings with title, description, requirements, salary, and status
5. **applied_jobs** - Application records linking candidates to jobs with status tracking
6. **city** - City/location master data for job locations
7. **sector** - Industry sector categories for job classification
8. **professional_details** - Additional candidate professional information

---

## 🔐 Authentication & Authorization

### User Roles

1. **Admin**: Full system access, job verification, user management
2. **Recruiter**: Post jobs, view applications, manage candidates
3. **Candidate**: Browse jobs, apply, manage profile, view applications

### Session Management
- PHP sessions used for user authentication
- Session variables: `$_SESSION['user']`, `$_SESSION['type']`, `$_SESSION['role']`
- Password hashing using `password_hash()` and `password_verify()`

---

## 🚀 Installation & Setup

### Prerequisites
- XAMPP/WAMP/LAMP installed
- PHP 8.2 or higher
- MySQL 10.4 or higher
- Composer (for dependencies)

### Installation Steps

1. **Clone/Download Project**
   ```bash
   cd C:\xampp\htdocs\
   # Place project folder here
   ```

2. **Database Setup**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create database named `placement`
   - Import `database/placement.sql` file

3. **Install Dependencies**
   ```bash
   composer install
   ```

4. **Configure Database Connection**
   - Edit `src/Database.php` if needed (default: localhost, root, no password)

5. **Configure Email (Optional)**
   - Edit `src/mailer.php` with your SMTP credentials for password reset functionality

6. **Start Server**
   - Start Apache and MySQL from XAMPP Control Panel
   - Access: http://localhost/placement-portal/

---

## 🎯 Key Features

### For Candidates
- User registration with resume upload
- Job search and filtering (keyword, city, sector)
- Job application tracking
- Profile management
- Application status monitoring

### For Recruiters
- Company registration
- Job posting with rich descriptions
- View applied candidates
- Application status management (Accept/Reject)
- Dashboard with statistics

### For Admins
- Job verification system
- User and recruiter management
- City and sector management
- System statistics and analytics
- Application tracking

---

## 🔒 Security Features

- Password hashing using bcrypt
- SQL injection prevention with `real_escape_string()`
- Session-based authentication
- File upload validation (PDF only for resumes)
- Prepared statements for critical operations
- Input sanitization

---

## 📊 Application Flow

1. **Candidate Flow**: Register → Login → Browse Jobs → Apply → Track Status
2. **Recruiter Flow**: Register → Login → Post Job → View Applications → Update Status
3. **Admin Flow**: Login → Verify Jobs → Manage Users → View Statistics

---

## 🛠️ Development Notes

- Uses procedural PHP with object-oriented database class
- Template-based architecture with header/footer includes
- Responsive design with Bootstrap framework
- File uploads stored in `images/uploaded/` and `resume/` directories
- Job status workflow: Pending → Verified (by admin) → Visible to candidates

---

## 📝 Future Enhancements

- Email notifications for application status changes
- Advanced search with multiple filters
- Resume parsing and keyword matching
- Interview scheduling system
- Rating and review system
- Analytics and reporting dashboard
- RESTful API implementation
- Mobile app integration

---

## 👥 Project Information

**Project Type**: Student Project (Cotton University)  
**Technology**: PHP, MySQL, HTML, CSS, JavaScript  
**Architecture**: MVC-inspired with template-based structure  
**Database**: MySQL/MariaDB  

