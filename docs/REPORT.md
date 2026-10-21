# Bartwel Sports & Fitness: Online Store
**Group 2** | Bartwel Mwanza (leader), Thelma Swana, Jonathan Kalaki, Mapesho Mulenda, Joshua Lifumbo, Blessings Mulenga

## 1. Introduction
Bartwel Sports & Fitness sells football gear, gym equipment, running wear and supplements. Customers currently have to visit the shop to see what is available. This project is a web application that lets customers browse products, add them to a cart, place orders and track them, and lets the shop owner manage products, categories, orders and users from an admin dashboard.

## 2. Objectives
- Let customers view and filter products by category.
- Let customers add items to a cart and place an order.
- Let customers register, log in and view their order history.
- Let the admin manage products (with images), categories, orders and users.
- Keep admin pages hidden from ordinary customers.

## 3. Tools and technologies
Laravel 12 (PHP 8.2) using the MVC pattern; MySQL database (XAMPP); Blade templates; Bootstrap 5 for styling; Laravel Breeze for authentication; Git and GitHub for teamwork; Vite for front-end assets.

## 4. System design
**Users:** Customer (browse, cart, order, dashboard) and Admin (everything above plus management pages).

**Database tables**
| Table | Main fields |
|---|---|
| users | id, name, email, password, role (customer/admin) |
| categories | id, name, slug |
| products | id, category_id, name, description, price, stock, image |
| orders | id, user_id, total, status, address, phone, payment |
| order_items | id, order_id, product_id, name, price, quantity |

**Relationships:** a category has many products; a user has many orders; an order has many order items; an order item belongs to a product.

## 5. Pages (10)
1 Landing; 2 Products list; 3 Product details; 4 Cart; 5 Checkout; 6 Login/Register; 7 User dashboard; 8 Admin overview; 9 Admin products (add/edit/delete) and categories; 10 Admin orders and users.

## 6. Implementation
- **Routing:** `routes/web.php` maps each URL to a controller method. Admin routes are grouped under `/admin` with the `auth` and `admin` middleware.
- **Controllers:** ProductController, CartController, UserDashboardController, AdminController, HomeController.
- **Cart:** stored in the session so guests can shop; login is required only at checkout.
- **Orders:** placed inside a database transaction that saves the order, saves each item and reduces stock together, so nothing is half-saved.
- **Security:** CSRF tokens on every form, validation on every input, hashed passwords, role check middleware, image uploads limited to images under 2 MB.
- **Images:** uploaded to `storage/app/public/products` and shown through the `storage:link` shortcut.

## 7. Testing
20 test cases were run (see TESTING.md): browsing, cart, checkout, registration, access control, admin management. Results: (Blessings: write the pass/fail summary and any bugs found and fixed here.)

## 8. Limitations and future work
- Payment is recorded as "mobile money" or "cash on delivery" but not processed online. Future work: integrate a mobile money payment API.
- No email notifications, product reviews or search.
- Cart is cleared if the session expires.

## 9. Conclusion
The system lets customers shop online and gives the owner one place to run the store. It met the objectives within the 10-page limit.

## 10. Team contributions
(See the table in PRESENTATION.md; each member describes their part in 3 to 4 sentences.)
