# MR Tailor - Tailoring Management System

> A professional PHP & MySQL-based Tailoring Management System for managing customers, orders, measurements, stitching options, payments, reports, and printable measurement slips.

MR Tailor is a web-based **Tailor Shop Management System** designed to simplify daily tailoring operations. It provides a structured dashboard for managing customers, orders, garment types, dynamic measurement fields, stitching options, payments, reports, and printable customer measurement slips.

The system follows a clean **MVC (Model-View-Controller) architecture** and uses a MySQL database for persistent data management.

---

## Features

### Dashboard

- Total Customers
- Total Orders
- Pending Orders
- Ready Orders
- Delivered Orders
- Today's Income
- Monthly Income
- Outstanding Balance
- Quick access to major modules

---

### Customer Management

Manage complete customer information from a centralized interface.

- Add customers
- Edit customers
- Delete/manage customers
- Customer search
- Customer phone number
- Father name
- Village
- Mohalla
- Booking number
- Customer order history

---

### Order Management

Create and manage tailoring orders efficiently.

- Create new orders
- Assign customer to order
- Select garment type
- Order date
- Delivery date
- Order status
- Total amount
- Advance payment
- Discount
- Remaining balance
- Pending orders
- Ready orders
- Delivered orders

### Order Status

- Pending
- Ready
- Delivered

---

## Dynamic Measurement Management

One of the main features of MR Tailor is its **database-driven measurement system**.

Measurement fields are not hard-coded into the customer measurement page.

Administrators can manage measurement types dynamically.

### Measurement Type Management

- Add measurement type
- Edit measurement type
- Activate/deactivate measurement type
- Delete/soft-delete functionality
- Garment-specific measurements
- English measurement name
- Urdu measurement name
- Measurement section
- Urdu section name
- Placeholder
- Print order
- Measurement status

For example:

- Chest
- Length
- Shoulder
- Sleeve
- Waist
- Collar
- Cuff
- Shalwar
- Trouser
- etc.

Only **active measurement types assigned to the selected garment** are displayed in the measurement interface and printed measurement slip.

---

## Dynamic Stitching Options

Stitching options are also database-driven.

Administrators can create and manage stitching options for different garments.

### Stitching Option Features

- Add stitching option
- Edit stitching option
- Activate/deactivate option
- Garment-specific options
- English name
- Urdu name
- Category
- Print order
- Selection type
- Duplicate validation

Examples:

- Simple stitching
- Double stitching
- Pocket styles
- Collar styles
- Cuff styles
- Button styles
- Special stitching instructions

Only the **selected stitching options saved for the customer's order** are displayed on the measurement slip.

---

# Measurement Slip

MR Tailor includes a compact, print-friendly customer measurement slip.

The measurement slip is designed for **single-page printing** and contains:

### Customer & Order Information

Displayed in a two-column layout:

- Customer name
- Phone
- Village
- Garment
- Booking number
- Order date
- Delivery date
- Order status

### Measurements

The measurement section uses a compact two-column layout.

Only measurements actually saved for the order are displayed.

### Stitching Options

Only stitching options selected for the specific order are displayed.

### Payment Summary

Payment information is displayed horizontally:

- Total
- Advance
- Discount
- Balance

The print layout is optimized to minimize unnecessary whitespace and keep the measurement slip on a single page.

---

# Shop Settings

The system provides a dynamic shop settings module.

Administrators can update shop information from the UI without changing source code.

### Configurable Settings

- Shop name
- Owner name
- Phone number
- Email
- Website
- Address
- Currency
- Timezone
- Invoice footer
- Shop logo

Settings are stored in the database and dynamically used throughout the application.

For example:

```php
Config::get("shop_name")
