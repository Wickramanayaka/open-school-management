## Open School Management System  
![License](https://img.shields.io/badge/license-MIT-blue.svg)  
![Status](https://img.shields.io/badge/status-active-success.svg)  
![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)  

<img src="./guide/dashboard.png"/>


Open School Management System is an **open-source version** of the **Bluesmart School Management System**, designed for **tech start-ups** and **independent developers** who want to build and customize their own school management solution.  


---

## ✨ Features  

The system includes several modules to assist with day-to-day school operations:  

- **Student Management** – Maintain student records, admissions, and profiles.  
- **Teacher Management** – Manage teacher information, schedules, and assignments.  
- **Classroom Management** – Organize classes, timetables, and room allocations.  
- **Examination Management** – Create and manage exams, results, and grading.  
- **User Management** – Add, edit, and manage user roles and permissions.  

---

## 🚀 Getting Started  

Follow these instructions to set up the project locally for development or testing.  

### ✅ Prerequisites  

- PHP >= 7.4 (Recommended: PHP 8.x)  
- MySQL or MariaDB  
- Apache or Nginx  
- Composer  

### 📥 Installation  

1. **Clone the repository:**  
   ```bash
   git clone https://github.com/your-username/open-school-management.git
   cd open-school-management
   ```

2. **Install dependencies:**

   ```bash
   composer install
   ```

3. **Configure environment:**

   * Copy `.env.example` to `.env`:

     ```bash
     cp .env.example .env
     ```
   * Update database credentials and other necessary configurations in `.env`.
   * Generate app key in `.env`.
      ```bash
      php artisan key:generate
      ```

4. **Run database migrations:**

   ```bash
   php artisan migrate --seed
   ```

5. **Serve the application:**

   ```bash
   php artisan serve
   ```

   Open your browser and navigate to: **`http://127.0.0.1:8000`**

---

## 📸 Screenshots

<img src="./guide/login.png"/>

---

## 🤝 Contributing

Contributions are welcome!

1. Fork the repository
2. Create a new branch (`git checkout -b feature/YourFeature`)
3. Commit your changes (`git commit -m "Add YourFeature"`)
4. Push to the branch (`git push origin feature/YourFeature`)
5. Open a Pull Request

---

## 📜 License

This project is licensed under the **MIT License** – see the [LICENSE](LICENSE) file for details.

---

## ⚠️ Disclaimer

This software is provided **"as-is"**, without any warranty of any kind. The maintainer or contributors **shall not be held liable** for any damages arising from the use of this application.

---

### ⭐ Show your support

If you like this project, give it a **star** on GitHub and share it with others!

