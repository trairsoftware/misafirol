# MİSAFİR OL

Misafirol.org 

### Bağımlılıklar
- Laravel
- Composer
- PHP
- PostgreSQL

## Projenin ayağa kaldırılması
.env isimli dosya yaratılıp .env.example baz alınarak;
-  veritabanı bağlantısı için veritabanı bilgileri, 
-  mail hizmetinin çalışması için mail bilgileri,
-  sms sistemi için NETGSM bilgileri girilmelidir (opsiyonel).

Composer paketlerinin indirilmesi için;
```sh
composer install
```
Migration işlemi için;
```sh
php artisan migrate
```
Geliştirme modunda çalışmak için;
```sh
php artisan serve
```
## Ayrıca Slack kanalımıza katılarak bize destek olabilirsiniz.

https://join.slack.com/t/msafrol/shared_invite/zt-1rzhbunbb-lUj0aOM1lYD_vxDSpowa~Q
