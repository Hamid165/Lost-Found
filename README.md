```markdown
# Lost & Found - Documentation

## Overview

**Lost & Found** is a web application designed to help users report and find lost or found items. Built with Laravel (PHP) for the backend and Blade for the frontend, it leverages JavaScript and CSS for interactivity and styling. This repository also includes comprehensive visual documentation such as wireframes, ERD, normalization, class diagrams, use case diagrams, activity diagrams, and sequence diagrams to support development and understanding.

---

## Features

- **User Authentication:** Register and log in securely.
- **Dashboard (Beranda):** Quick access to main features.
- **Item Management (Barang):** Add, edit, and view items.
- **Reporting:** Submit and browse lost or found item reports.
- **Visual Documentation:** Includes wireframes, ERD, and various UML diagrams.

---

## Project Structure

```
app/         # Application core (controllers, models, etc.)
bootstrap/   # Laravel bootstrap files
config/      # Configuration files
database/    # Migrations, seeders, and database setup
public/      # Public assets (images, CSS, JS)
resources/   # Blade templates and resources
routes/      # Web and API route definitions
storage/     # File storage
tests/       # Automated tests
```

---

## Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- Node.js & npm
- MySQL or compatible database

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Hamid165/Lost-Found.git
   cd Lost-Found
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install Node dependencies:**
   ```bash
   npm install
   ```

4. **Copy and configure environment file:**
   ```bash
   cp .env.example .env
   # Edit .env to match your database and environment settings
   ```

5. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

6. **Run migrations:**
   ```bash
   php artisan migrate
   ```

7. **Build frontend assets:**
   ```bash
   npm run dev
   ```

8. **Start the development server:**
   ```bash
   php artisan serve
   ```

---

## Usage

- Visit [http://localhost:8000](http://localhost:8000) after starting the server.
- Register a new account or log in.
- Use the dashboard to report lost/found items or browse existing reports.

---

## Documentation & Diagrams

Visual documentation is available in the `public/images/` directory:

- **Wireframes:** Login, Register, Beranda, Barang, Report
- **ERD:** Entity Relationship Diagram
- **Normalization:** Database normalization steps
- **Class Diagram:** System class structure
- **Use Case Diagram:** User interactions
- **Activity Diagrams:** Login/Register, Laporan Penemuan, Kehilangan
- **Sequence Diagrams:** Laporan Penemuan, Login/Register

---

## Contributing

1. Fork the repository.
2. Create a new branch:  
   `git checkout -b feature/your-feature`
3. Commit your changes:  
   `git commit -am 'Add new feature'`
4. Push to the branch:  
   `git push origin feature/your-feature`
5. Create a Pull Request.

---

## License

This project is open source. See the repository for license details.

---

## Contact

For questions or support, open an issue on the [GitHub repository](https://github.com/Hamid165/Lost-Found/issues).

---

*Generated documentation for the Lost & Found project. For more details, see the repository and included diagrams.*
```

<!-- # Wireframe

Dokumentasi wireframe untuk web Lost&Found.  
Berikut adalah tampilan dari beberapa halaman utama:

---

## Login
![Wireframe Login](./public/images/login.jpg)

---

## Register
![Wireframe Register](./public/images/register.jpg)

---

## Beranda
![Wireframe Beranda](./public/images/beranda.jpg)

---

## Barang
![Wireframe Barang](./public/images/barang.jpg)

---

## Report
![Wireframe Report](./public/images/report.jpg)

---

## ERD
![Wireframe Report](./public/images/erd.jpg)

---

## Normalisasi
![Wireframe Report](./public/images/normalisasi.jpg)

---

## Class Diagram
![Wireframe Report](./public/images/classdiagram.jpg)

---

## Usecase Diagram
![Wireframe Report](./public/images/usecase-diagram.png)

---

## Activity Diagram Login Register
![Wireframe Report](./public/images/login-register-activity.jpg)

---

## Activity Diagram Laporan Penemuan
![Wireframe Report](./public/images/laporan-penemuan-activity.jpg)

---

## Activity Diagram Kehilangan
![Wireframe Report](./public/images/laporan-kehilangan-activity.jpg)

---
## Sequence Diagram Laporan Penemuan
![Wireframe Report](./public/images/laporan-penemuan-squence.jpg)

---

## Sequence Diagram Login Register
![Wireframe Report](./public/images/login-register-sequence.jpg)

--- -->
