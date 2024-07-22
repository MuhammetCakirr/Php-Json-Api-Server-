Proje Açıklaması
Bu proje, bir kütüphanenin kitap ve kullanıcı yönetimini kolaylaştırmak amacıyla geliştirilmiş sunucu uygulamasıdır. Kullanıcılar, kitapları ödünç alabilir, kitapların detaylarını görüntüleyebilir ve çeşitli kitap istatistiklerini inceleyebilirler. Yönetici ve yetkili kullanıcılar, kitap ve kullanıcı bilgilerini yönetebilir, yetkisiz erişim girişimlerini takip edebilir ve sistemin genel işleyişini kontrol edebilirler.

Temel Özellikler
Kullanıcı Yönetimi: Kullanıcılar sisteme kaydolabilir, giriş yapabilir ve profil bilgilerini güncelleyebilir.
Kitap Yönetimi: Kitap ekleme, güncelleme, silme ve kitap detaylarını görüntüleme işlemleri yapılabilir.
Ödünç Alma ve İade: Kullanıcılar kitapları ödünç alabilir ve iade edebilirler. Her bir ödünç alma ve iade işlemi kaydedilir.
Kitap Görüntüleme İstatistikleri: Hangi kitapların en çok görüntülendiği ve hangi kullanıcıların en çok kitap görüntülediği takip edilir.
En Çok Ödünç Alınan Kitaplar: En popüler kitapların listesi oluşturulur.
Kullanıcı Giriş Çıkış Logları: Kullanıcıların sisteme giriş ve çıkış zamanları kaydedilir.
Yetkisiz Erişim Denemeleri: Yetkisiz erişim girişimleri kaydedilir ve bu girişimlere karşı kullanıcılar engellenebilir.
Günlük, Haftalık ve Aylık İstatistikler: Günlük, haftalık ve aylık olarak kitap ödünç alma istatistikleri raporlanır.
API Tabanlı Mimari: Laravel kullanılarak geliştirilen RESTful API ile frontend ve mobil uygulama entegrasyonları yapılabilir.

Kullanılan Teknolojiler ve Araçlar
Backend Framework: Laravel 11
API Authentication: Laravel Sanctum
Yetki ve Rol Yönetimi: Spatie Laravel-Permission
Veritabanı: MySQL
Versiyon Kontrol: Git
Diğer Araçlar: Composer, Artisan
API Test Aracı: Postman
Veritabanı Doldurma: Seeder
Kod Standartları: PSR-12

Öne Çıkan Özellikler
Güçlü Yetki Yönetimi: Spatie Laravel-Permission kullanılarak kullanıcı yetkileri ve roller detaylı bir şekilde yönetilir.
Gelişmiş Loglama: Yetkisiz erişim denemeleri, kullanıcı giriş-çıkışları ve olağan dışı davranışlar detaylı olarak loglanır.
Analiz ve Raporlama: Kitap ödünç alma ve görüntüleme istatistikleri raporlanarak analiz edilir.

Ekstra Özellikler
IP Adresi Takibi: Kullanıcıların sistemdeki hareketleri IP adresi bazında takip edilir.
Saldırı Önleme Mekanizması: Bir URL'ye aşırı istek yapan kullanıcıların geçici olarak erişimlerinin kısıtlanması sağlanır.

Project Description
This project is a server application developed to facilitate the book and user management of a library. Users can borrow books, view the details of books, and review various book statistics. Administrator and authorized users can manage books and user information, track unauthorized access attempts, and control the overall functioning of the system.

Basic Features
User Management: Users can register to the system, log in and update their profile information.
Book Management: Adding, updating, deleting books and viewing book details can be performed.
Borrowing and Return: Users can borrow and return books. Each borrowing and return transaction is recorded.
Book Viewing Statistics: It tracks which books have been viewed the most and which users have viewed the most books.
Most Borrowed Books: A list of the most popular books is created.
User Log-in and Log-out Logs: The log-in and log-out times of users to the system are recorded.
Unauthorized Access Attempts: Unauthorized access attempts are recorded and users can be blocked against these attempts.
Daily, Weekly and Monthly Statistics: Book borrowing statistics are reported daily, weekly and monthly.
API-Based Architecture: Frontend and mobile application integrations can be made with the RESTful API developed using Laravel.

Technologies and Tools Used
Backend Framework: Laravel 11
API Authentication: Laravel Sanctum
Authority and Role Management: Spatie Laravel-Permission
Database: MySQL
Version Control: Go
Other Tools: Composer, Artisan
API Testing Tool: Postman
Filling in the Database: Seeder
Code Standards: PSR-12

Featured Features
Powerful Authority Management: User permissions and roles are managed in detail using Spatie Laravel-Permission.
Advanced Logging: Unauthorized access attempts, user log-ins and unusual behaviors are logged in detail.
Analysis and Reporting: Book borrowing and viewing statistics are analyzed by reporting.

Extra Features
IP Address Tracking: Users' movements in the system are tracked based on their IP address.
Intrusion Prevention Mechanism: Allows users who make excessive requests to a URL to temporarily restrict their access.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

