# KampungRelish Project Documentation

# Blade Views

| View | Location |
|------|----------|
| auth/login | resources/views/auth/login.blade.php |
| auth/register | resources/views/auth/register.blade.php |
| bookings/create | resources/views/bookings/create.blade.php |
| bookings/edit | resources/views/bookings/edit.blade.php |
| bookings/index | resources/views/bookings/index.blade.php |
| contact | resources/views/contact.blade.php |
| dashboard | resources/views/dashboard.blade.php |
| experiences/_form | resources/views/experiences/_form.blade.php |
| experiences/create | resources/views/experiences/create.blade.php |
| experiences/edit | resources/views/experiences/edit.blade.php |
| experiences/index | resources/views/experiences/index.blade.php |
| experiences/show | resources/views/experiences/show.blade.php |
| home | resources/views/home.blade.php |
| layouts/app | resources/views/layouts/app.blade.php |
| reviews/_form | resources/views/reviews/_form.blade.php |
| reviews/create | resources/views/reviews/create.blade.php |
| reviews/edit | resources/views/reviews/edit.blade.php |
| reviews/index | resources/views/reviews/index.blade.php |
| vendors/_form | resources/views/vendors/_form.blade.php |
| vendors/create | resources/views/vendors/create.blade.php |
| vendors/edit | resources/views/vendors/edit.blade.php |
| vendors/index | resources/views/vendors/index.blade.php |
| welcome | resources/views/welcome.blade.php |


# Controllers

## App\Http\Controllers\AuthController
**Location:** app/Http/Controllers/AuthController.php

| Method |
|--------|
| showRegister() |
| register() |
| showLogin() |
| login() |
| logout() |

## App\Http\Controllers\BookingController
**Location:** app/Http/Controllers/BookingController.php

| Method |
|--------|
| index() |
| create() |
| store() |
| edit() |
| update() |
| destroy() |

## App\Http\Controllers\ExperienceController
**Location:** app/Http/Controllers/ExperienceController.php

| Method |
|--------|
| index() |
| show() |
| create() |
| store() |
| edit() |
| update() |
| destroy() |

## App\Http\Controllers\PageController
**Location:** app/Http/Controllers/PageController.php

| Method |
|--------|
| home() |
| dashboard() |
| contact() |
| sendContact() |

## App\Http\Controllers\ReviewController
**Location:** app/Http/Controllers/ReviewController.php

| Method |
|--------|
| index() |
| create() |
| store() |
| edit() |
| update() |
| destroy() |

## App\Http\Controllers\VendorProfileController
**Location:** app/Http/Controllers/VendorProfileController.php

| Method |
|--------|
| index() |
| create() |
| store() |
| edit() |
| update() |
| destroy() |



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



# Routes

| Method | URI | Name | Action | Middleware |
|--------|-----|------|--------|------------|
| GET,HEAD,POST,PUT,PATCH,DELETE,OPTIONS | // | - | \Illuminate\Routing\RedirectController | web |
| GET,HEAD | /home | home | App\Http\Controllers\PageController@home | web |
| GET,HEAD | /contact | contact | App\Http\Controllers\PageController@contact | web |
| POST | /contact | contact.send | App\Http\Controllers\PageController@sendContact | web |
| GET,HEAD | /register | register | App\Http\Controllers\AuthController@showRegister | web, guest |
| POST | /register | register.store | App\Http\Controllers\AuthController@register | web, guest |
| GET,HEAD | /login | login | App\Http\Controllers\AuthController@showLogin | web, guest |
| POST | /login | login.attempt | App\Http\Controllers\AuthController@login | web, guest |
| POST | /logout | logout | App\Http\Controllers\AuthController@logout | web, auth |
| GET,HEAD | /dashboard | dashboard | App\Http\Controllers\PageController@dashboard | web, auth |
| GET,HEAD | /experiences/create | experiences.create | App\Http\Controllers\ExperienceController@create | web, auth, admin |
| POST | /experiences | experiences.store | App\Http\Controllers\ExperienceController@store | web, auth, admin |
| GET,HEAD | /experiences/{experience}/edit | experiences.edit | App\Http\Controllers\ExperienceController@edit | web, auth, admin |
| PUT | /experiences/{experience} | experiences.update | App\Http\Controllers\ExperienceController@update | web, auth, admin |
| DELETE | /experiences/{experience} | experiences.destroy | App\Http\Controllers\ExperienceController@destroy | web, auth, admin |
| GET,HEAD | /vendors | vendors.index | App\Http\Controllers\VendorProfileController@index | web, auth, admin |
| GET,HEAD | /vendors/create | vendors.create | App\Http\Controllers\VendorProfileController@create | web, auth, admin |
| POST | /vendors | vendors.store | App\Http\Controllers\VendorProfileController@store | web, auth, admin |
| GET,HEAD | /vendors/{vendor}/edit | vendors.edit | App\Http\Controllers\VendorProfileController@edit | web, auth, admin |
| PUT,PATCH | /vendors/{vendor} | vendors.update | App\Http\Controllers\VendorProfileController@update | web, auth, admin |
| DELETE | /vendors/{vendor} | vendors.destroy | App\Http\Controllers\VendorProfileController@destroy | web, auth, admin |
| GET,HEAD | /reviews | reviews.index | App\Http\Controllers\ReviewController@index | web, auth, admin |
| GET,HEAD | /experiences | experiences.index | App\Http\Controllers\ExperienceController@index | web, auth |
| GET,HEAD | /experiences/{experience} | experiences.show | App\Http\Controllers\ExperienceController@show | web, auth |
| GET,HEAD | /bookings | bookings.index | App\Http\Controllers\BookingController@index | web, auth |
| GET,HEAD | /bookings/create | bookings.create | App\Http\Controllers\BookingController@create | web, auth |
| POST | /bookings | bookings.store | App\Http\Controllers\BookingController@store | web, auth |
| GET,HEAD | /bookings/{booking}/edit | bookings.edit | App\Http\Controllers\BookingController@edit | web, auth |
| PUT,PATCH | /bookings/{booking} | bookings.update | App\Http\Controllers\BookingController@update | web, auth |
| DELETE | /bookings/{booking} | bookings.destroy | App\Http\Controllers\BookingController@destroy | web, auth |
| GET,HEAD | /experiences/{experience}/reviews/create | reviews.create | App\Http\Controllers\ReviewController@create | web, auth |
| POST | /experiences/{experience}/reviews | reviews.store | App\Http\Controllers\ReviewController@store | web, auth |
| GET,HEAD | /reviews/{review}/edit | reviews.edit | App\Http\Controllers\ReviewController@edit | web, auth |
| PUT | /reviews/{review} | reviews.update | App\Http\Controllers\ReviewController@update | web, auth |
| DELETE | /reviews/{review} | reviews.destroy | App\Http\Controllers\ReviewController@destroy | web, auth |


