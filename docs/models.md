# Models Documentation

Generated on: 2026-11-02 13:16:53

## Booking

**Table:** `bookings`

**Primary Key:** `id`

| Field | Type | Null | Key | Default |
|-------|------|------|-----|---------|
| `id` | bigint(20) unsigned | NO | PRI | NULL |
| `user_id` | bigint(20) unsigned | NO | MUL | NULL |
| `experience_id` | bigint(20) unsigned | NO | MUL | NULL |
| `booking_date` | date | NO |  | NULL |
| `pax` | int(10) unsigned | NO |  | NULL |
| `total_price` | decimal(10,2) | NO |  | NULL |
| `status` | enum('pending','confirmed','cancelled') | NO |  | pending |
| `created_at` | timestamp | YES |  | NULL |
| `updated_at` | timestamp | YES |  | NULL |

**Fillable:** user_id, experience_id, booking_date, pax, total_price, status

---

## Experience

**Table:** `experiences`

**Primary Key:** `id`

| Field | Type | Null | Key | Default |
|-------|------|------|-----|---------|
| `id` | bigint(20) unsigned | NO | PRI | NULL |
| `vendor_profile_id` | bigint(20) unsigned | NO | MUL | NULL |
| `name` | varchar(255) | NO |  | NULL |
| `location` | varchar(255) | NO |  | NULL |
| `category` | varchar(255) | NO |  | NULL |
| `description` | text | NO |  | NULL |
| `menu` | varchar(255) | YES |  | NULL |
| `price` | decimal(8,2) | NO |  | NULL |
| `status` | enum('active','inactive') | NO |  | active |
| `created_at` | timestamp | YES |  | NULL |
| `updated_at` | timestamp | YES |  | NULL |

**Fillable:** vendor_profile_id, name, location, category, description, menu, price, status

---

## Review

**Table:** `reviews`

**Primary Key:** `id`

| Field | Type | Null | Key | Default |
|-------|------|------|-----|---------|
| `id` | bigint(20) unsigned | NO | PRI | NULL |
| `user_id` | bigint(20) unsigned | NO | MUL | NULL |
| `experience_id` | bigint(20) unsigned | NO | MUL | NULL |
| `rating` | tinyint(3) unsigned | NO |  | NULL |
| `comment` | text | NO |  | NULL |
| `created_at` | timestamp | YES |  | NULL |
| `updated_at` | timestamp | YES |  | NULL |

**Fillable:** user_id, experience_id, rating, comment

---

## User

**Table:** `users`

**Primary Key:** `id`

| Field | Type | Null | Key | Default |
|-------|------|------|-----|---------|
| `id` | bigint(20) unsigned | NO | PRI | NULL |
| `name` | varchar(255) | NO |  | NULL |
| `email` | varchar(255) | NO | UNI | NULL |
| `phone` | varchar(15) | YES |  | NULL |
| `password` | varchar(255) | NO |  | NULL |
| `role` | enum('admin','user') | NO |  | user |
| `remember_token` | varchar(100) | YES |  | NULL |
| `created_at` | timestamp | YES |  | NULL |
| `updated_at` | timestamp | YES |  | NULL |

**Fillable:** name, email, phone, password, role

---

## VendorProfile

**Table:** `vendor_profiles`

**Primary Key:** `id`

| Field | Type | Null | Key | Default |
|-------|------|------|-----|---------|
| `id` | bigint(20) unsigned | NO | PRI | NULL |
| `name` | varchar(255) | NO |  | NULL |
| `phone` | varchar(15) | NO |  | NULL |
| `location` | varchar(255) | NO |  | NULL |
| `description` | text | YES |  | NULL |
| `status` | enum('active','inactive') | NO |  | active |
| `created_at` | timestamp | YES |  | NULL |
| `updated_at` | timestamp | YES |  | NULL |

**Fillable:** name, phone, location, description, status

---

