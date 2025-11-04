# Learning Management System (LMS)

> A comprehensive Learning Management System designed for private course centers and training institutes

[![Laravel](https://img.shields.io/badge/Laravel-9.x-red.svg)](https://laravel.com)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-8.0+-purple.svg)](https://php.net)

## 📋 Table of Contents

-   [Overview](#overview)
-   [Features](#features)
-   [Technology Stack](#technology-stack)
-   [Installation](#installation)
-   [Default Credentials](#default-credentials)
-   [System Architecture](#system-architecture)
-   [Future Roadmap](#future-roadmap)
-   [Contributing](#contributing)

---

## 🎯 Overview

This Learning Management System is specifically designed for **private course centers** and training institutions. It provides a complete solution for managing courses, students, instructors, fees, examinations, and certificates.

### Key Highlights

-   🎓 **Multi-level Course Management** (Beginner → Professional)
-   👥 **Role-based Access Control** (Admin, Instructor, Student)
-   💳 **Comprehensive Fee Management**
-   📊 **Performance Tracking & Analytics**
-   📱 **Responsive Design**
-   🔒 **Secure Authentication**

---

## ✨ Current Features

### 1. User Management

-   [x] Multi-role system (Admin, Instructor, Student)
-   [x] Profile management with photo upload
-   [x] Password management
-   [x] User activity tracking
-   [x] Bulk user import (upcoming)

### 2. Course Management

-   [x] Course levels (Beginner, Intermediate, Advanced, Professional)
-   [x] Course categories (Programming, Design, Business, Languages)
-   [x] Subject assignment
-   [x] Curriculum management
-   [x] Course schedules (Morning, Afternoon, Evening shifts)

### 3. Student Management

-   [x] Student registration with complete details
-   [x] Roll number generation
-   [x] Student promotion system
-   [x] Performance tracking
-   [x] Attendance management (upcoming)
-   [x] Student portal (upcoming)

### 4. Instructor Management

-   [x] Instructor profiles
-   [x] Subject assignment
-   [x] Class schedules
-   [x] Performance analytics (upcoming)
-   [x] Salary management (upcoming)

### 5. Fee Management

-   [x] Multiple fee categories (Registration, Monthly, Materials, Certification)
-   [x] Class-wise fee structure
-   [x] Discount system
-   [x] Payment tracking
-   [x] Fee reports (upcoming)
-   [x] Online payment gateway (upcoming)

### 6. Examination System

-   [x] Exam types (Mid-term, Final, Practical, Project)
-   [x] Subject-wise marking
-   [x] Pass/Fail marks
-   [x] Grade calculation (upcoming)
-   [x] Report cards (upcoming)
-   [x] Certificate generation (upcoming)

### 7. Reporting & Analytics

-   [x] Student performance reports
-   [x] Fee collection reports
-   [x] Attendance reports (upcoming)
-   [x] Course completion rates (upcoming)
-   [x] Revenue analytics (upcoming)

---

## 🛠 Technology Stack

### Backend

-   **Framework**: Laravel 9.x
-   **PHP**: 8.0+
-   **Database**: MySQL 8.0+
-   **Authentication**: Laravel Jetstream (Livewire)
-   **PDF Generation**: DomPDF

### Frontend

-   **UI Framework**: Tailwind CSS
-   **JavaScript**: Alpine.js
-   **Admin Template**: Custom Dark Theme
-   **Icons**: Feather Icons, Font Awesome

### Additional Tools

-   **Version Control**: Git
-   **CI/CD**: GitHub Actions
-   **Package Manager**: Composer, NPM

---

## 📦 Installation

### Prerequisites

```bash
- PHP >= 8.0
- Composer
- MySQL >= 8.0
- Node.js >= 14.x
- NPM/Yarn
```

### Step-by-Step Installation

1. **Clone the repository**

```bash
git clone https://github.com/yourusername/lms-system.git
cd lms-system
```

2. **Install dependencies**

```bash
composer install
npm install && npm run dev
```

3. **Environment setup**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database** (edit `.env`)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lms_database
DB_USERNAME=root
DB_PASSWORD=your_password
```

5. **Run migrations and seed data**

```bash
php artisan migrate:fresh --seed
```

6. **Start the development server**

```bash
php artisan serve
```

7. **Access the application**

```
http://localhost:8000
```

---

## 🔐 Default Credentials

### Admin Account

-   **Email**: admin@lms.test
-   **Password**: admin123
-   **Access**: Full system control

### Instructor Accounts

-   **Email**: instructor@lms.test / ahmad@lms.test
-   **Password**: ins123
-   **Access**: Course management, student grading

### Student Accounts

-   **Email**: student@lms.test / jane@lms.test / ahmad@lms.test
-   **Password**: stud123
-   **Access**: Course access, assignments, grades

---

## 🏗 System Architecture

### Database Structure

```
users
├── Admin (usertype: Admin, role: Admin)
├── Instructors (usertype: Admin, role: Instructor)
└── Students (usertype: Student, role: User)

courses_structure
├── student_classes (Course Levels)
├── student_years (Academic Years)
├── student_groups (Categories)
├── student_shifts (Schedules)
└── school_subjects (Course Subjects)

assignments
├── assign_students (Student Enrollments)
├── assign_subjects (Course Curriculum)
└── discount_students (Fee Discounts)

financial
├── fee_categories (Fee Types)
├── fee_category_amounts (Fee Structure)
└── payment_records (upcoming)

assessment
├── exam_types (Exam Categories)
├── marks (upcoming)
└── grades (upcoming)
```

### Role Permissions

| Feature              | Admin | Instructor   | Student  |
| -------------------- | ----- | ------------ | -------- |
| User Management      | ✅    | ❌           | ❌       |
| Course Setup         | ✅    | ❌           | ❌       |
| Student Registration | ✅    | ✅           | ❌       |
| Grade Entry          | ✅    | ✅           | ❌       |
| Fee Management       | ✅    | ❌           | ❌       |
| View Reports         | ✅    | ✅ (Limited) | ✅ (Own) |
| Attendance           | ✅    | ✅           | ❌       |

---

## 🚀 Future Roadmap

### Phase 1: Core Enhancements (Q1 2025)

-   [ ] **Student Portal**

    -   Dashboard with course progress
    -   Assignment submission
    -   Grade viewing
    -   Certificate download

-   [ ] **Instructor Portal**

    -   Class schedule calendar
    -   Attendance marking
    -   Grade entry interface
    -   Student progress analytics

-   [ ] **Advanced Reporting**
    -   Revenue analytics
    -   Course performance metrics
    -   Student retention reports
    -   Export to Excel/PDF

### Phase 2: Learning Features (Q2 2025)

-   [ ] **Course Content Management**

    -   Video lessons upload
    -   Document attachments
    -   Quiz builder
    -   Assignment system

-   [ ] **Interactive Learning**

    -   Live class integration (Zoom/Meet)
    -   Discussion forums
    -   Peer-to-peer chat
    -   Q&A section

-   [ ] **Gamification**
    -   Points and badges
    -   Leaderboards
    -   Achievement system
    -   Certificates of completion

### Phase 3: Advanced Features (Q3 2025)

-   [ ] **Payment Gateway Integration**

    -   Stripe integration
    -   PayPal support
    -   Razorpay (for India)
    -   Manual payment verification

-   [ ] **Communication System**

    -   Email notifications
    -   SMS alerts
    -   Push notifications
    -   Announcement broadcasts

-   [ ] **Mobile App**
    -   React Native app
    -   iOS & Android support
    -   Offline mode
    -   Push notifications

### Phase 4: AI & Analytics (Q4 2025)

-   [ ] **AI-Powered Features**

    -   Personalized learning paths
    -   Predictive analytics
    -   Automated grading
    -   Smart recommendations

-   [ ] **Advanced Analytics**
    -   Learning behavior analysis
    -   Course effectiveness metrics
    -   Revenue forecasting
    -   Dropout prediction

### Phase 5: Scale & Optimize (2026)

-   [ ] **Multi-tenancy Support**

    -   White-label solution
    -   Multiple institutions
    -   Custom branding
    -   Separate databases

-   [ ] **API Development**
    -   RESTful API
    -   Third-party integrations
    -   Mobile app backend
    -   Webhook support

---

## 📊 Performance Optimizations

### Current Optimizations

-   Database query optimization with eager loading
-   Route caching
-   View caching
-   Config caching
-   Asset optimization (minification)

### Planned Optimizations

-   Redis caching layer
-   Queue system for heavy tasks
-   CDN integration for media files
-   Database indexing improvements
-   Lazy loading for images

---

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Coding Standards

-   Follow PSR-12 coding standards
-   Write meaningful commit messages
-   Add comments for complex logic
-   Write tests for new features
-   Update documentation

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Credits

-   **Inspired by**: Kazi Ariyan's LMS Course (Udemy)
-   **Framework**: Laravel Team
-   **UI Components**: Tailwind CSS
-   **Icons**: Feather Icons, Font Awesome

---

## 📞 Support

For support, email support@yourlms.com or join our Slack channel.

---

## 🌟 Acknowledgments

-   Thanks to all contributors
-   Laravel community for excellent documentation
-   Open source community for valuable packages

---

**Built with ❤️ for education**
