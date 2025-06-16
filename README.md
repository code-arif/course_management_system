# 🎓 Course Management System - Laravel Project

A robust course management application built using **Laravel**. This project allows users to create, manage, and display courses consisting of multiple modules and module contents like videos, texts, quizzes, and more.

## 🔍 Project Overview

This web application enables users to:

-   Create new courses with descriptions, pricing, thumbnails, and categories.
-   Add multiple modules per course, each with its own summary, status, and duration.
-   Nest contents (like videos, PDFs, links, text, and quizzes) inside each module.
-   View all available courses in a card-based layout.
-   View detailed information about a single course, including its modules and their contents.

## 🛠️ Tech Stack

-   **Backend**: Laravel 12
-   **Frontend**: Blade templating, jQuery, CSS, HTML
-   **Database**: MySQL
-   **AJAX**: Axios used for asynchronous course creation with spinner & toasts
-   **Validation**: Server-side and client-side validation for form fields

---

## 📺 Project Demo Video

[![Watch Project Demo](https://img.shields.io/badge/WATCH_FULL_DEMO-FF0000?style=for-the-badge&logo=youtube&logoColor=white)](https://drive.google.com/file/d/1ob56uRXdZGU7Iq_ajwR7VwWUeVfdE6x4/view?usp=sharing)

Click the button above to watch the complete project walkthrough on Google Drive.

## 📷 Screenshots

### 🔹 Course List Page
[![Course List](https://img.shields.io/badge/View_Course_List_Screenshot-Click_Here-blue?style=for-the-badge&logo=google-drive)](https://drive.google.com/file/d/1XpiSzXlBU6yrMSedeOHJDsZLrlEMuijd/view)

### 🔹 Create Course Form  
[![Create Course](https://img.shields.io/badge/View_Create_Form_Screenshot-Click_Here-blue?style=for-the-badge&logo=google-drive)](https://drive.google.com/file/d/1Mhs7TKlH_Aj_84TP1L9OEHTWasB1lYZt/view)

### 🔹 Course Detail View
[![Course Details](https://img.shields.io/badge/View_Course_Details_Screenshot-Click_Here-blue?style=for-the-badge&logo=google-drive)](https://drive.google.com/file/d/1qCpA994DdaMK8iwvApnPAKKIXl8vq0UO/view)

---

## 🚀 Features

-   Fully dynamic module and content builder with add/remove functionality.
-   Course form supports file upload with optional thumbnail.
-   Toast notifications for success and error states.
-   Loading spinner during form submission.

---

## 📝 Setup Instruction

**Clone the repo**

```bash
git clone https://github.com/code-arif/course-management-system.git
cd course-management-system
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

**Project Structure**

```
├── app/
├── database/
│   ├── migrations/
├── resources/
│   ├── views/pages/...
│   └── js/
├── public/
│   └── css/
├── routes/
│   └── web.php
├── .env
├── composer.json
```

## 🌟 More Projects

Explore my other projects and portfolio:

[![Portfolio](https://img.shields.io/badge/VIEW_PORTFOLIO-6e5494?style=for-the-badge&logo=google-chrome&logoColor=white)](https://codearif.com)
[![GitHub Profile](https://img.shields.io/badge/VIEW_GITHUB-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/code-arif)

## 📧 Contact Me

For collaborations, questions, or feedback:

[![Email](https://img.shields.io/badge/EMAIL_ME-D14836?style=for-the-badge&logo=gmail&logoColor=white)](mailto:arifulislam6460@gmail.com)
[![LinkedIn](https://img.shields.io/badge/CONNECT_ON_LINKEDIN-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/ariful-islam-9926a922a)
