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

## 📷 Screenshots

### 🔹 Course List Page

<img src="https://i.imgur.com/your-screenshot-1.jpg" width="600" alt="Course List Screenshot" />

### 🔹 Create Course Form

<img src="https://i.imgur.com/your-screenshot-2.jpg" width="600" alt="Create Course Screenshot" />

### 🔹 Course Detail View

<img src="https://i.imgur.com/your-screenshot-3.jpg" width="600" alt="Course Details Screenshot" />

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

## 📧 Contact
For questions or feedback, reach out to: [arifulislam6460@gmail.com](arifulislam6460@gmail.com)
