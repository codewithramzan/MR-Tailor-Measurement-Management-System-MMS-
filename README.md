# 🧵 MR Tailor — Tailor Management System

> A full-stack web-based management system designed to digitize and simplify the daily operations of a tailoring business.

## 📌 Overview

MR Tailor is a tailor management system developed to manage customers, bookings, measurements, garments, stitching options, and orders from a centralized platform.

The project was designed around a real-world tailoring workflow rather than a simple demonstration CRUD application.

## ✨ Features

### 👤 Customer Management
- Add customers
- Update customer information
- Search customers
- Manage customer details

### 📋 Booking & Order Management
- Create bookings
- Track order status
- Manage pending, ready, and delivered orders
- View customer order history

### 📏 Measurement Management
- Store customer measurements
- Support different garment types
- Manage measurement types dynamically
- Organize measurements for individual orders

### 👕 Garment Type Management
- Store garment types in the database
- Support English and Urdu garment names
- Activate/deactivate garment types

### 🧵 Stitching Options
- Manage stitching options
- Categorize stitching options
- Store printable ordering information

### 📊 Dashboard
- Total customers
- Total bookings
- Pending orders
- Ready orders
- Delivered orders
- Income overview

### 🧾 Measurement Receipt
- Search customer/order
- Display measurement information
- Generate a printable measurement receipt

---

## 🛠️ Technologies

| Technology | Purpose |
|---|---|
| PHP | Backend development |
| MySQL | Database |
| JavaScript | Client-side functionality |
| HTML5 | Structure |
| CSS3 | Styling |
| Bootstrap | Responsive UI |
| MVC Architecture | Application architecture |
| Git & GitHub | Version control |

---

## 🏗️ Architecture

The application follows the **MVC (Model-View-Controller)** architecture.

```text
MR Tailor
│
├── Models
│   └── Database & Business Logic
│
├── Views
│   └── User Interface
│
├── Controllers
│   └── Request & Application Flow
│
├── Public
│   ├── CSS
│   ├── JavaScript
│   └── Assets
│
└── Database
    ├── Customers
    ├── Orders
    ├── Measurements
    ├── Garment Types
    └── Stitching Options
