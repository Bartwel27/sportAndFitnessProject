# Test checklist (Blessings runs this; tick Pass/Fail and note the date)

| # | Test | Steps | Expected | Pass/Fail |
|---|------|-------|----------|-----------|
| 1 | Landing loads | Open / | Hero, categories, 4 products from the database | |
| 2 | Category link | Click "Football" | /products shows only football items | |
| 3 | Product details | Click View on any product | Name, price, stock, description shown | |
| 4 | Add to cart (guest) | Click Add to cart | Green message; cart count in the navbar goes up | |
| 5 | Update quantity | Cart: change quantity, Update | Subtotal and total change | |
| 6 | Remove item | Cart: Remove | Item disappears | |
| 7 | Checkout needs login | Logged out, open /checkout | Redirected to login | |
| 8 | Register | /register with new details | Account created, logged in | |
| 9 | Place order | Add item, /checkout, fill form, Place order | Redirected to /dashboard, order listed as pending, cart empty | |
| 10 | Stock reduces | Compare product stock before and after order | Stock reduced by quantity ordered | |
| 11 | Customer blocked from admin | Logged in as customer, open /admin | 403 error | |
| 12 | Admin login | admin@bartwel.com / password, open /admin | Stats and latest orders shown | |
| 13 | Add product with image | Admin > Products > fill form, choose image | Product appears with thumbnail, also on /products | |
| 14 | Edit product | Click Edit, change price, Save | New price shown | |
| 15 | Delete product | Click Delete, confirm | Product removed | |
| 16 | Add category | Admin > Categories > add "Swimming" | Appears in list and in product forms | |
| 17 | Delete category with products | Try deleting Football | Refused with message | |
| 18 | Update order status | Admin > Orders > change to shipped, Save | Customer sees "Shipped" on their dashboard | |
| 19 | Users list | Admin > Users | All users with role and order count | |
| 20 | Logout | Click Logout | Returned to guest view | |
