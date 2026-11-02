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
