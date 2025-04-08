# Heranında Laravel Mülakat Görevi
Proje tamamiyle API endpointlerini kapsamaktadır. Postman Collection dosyası repo içerisinde aktif olarak mevcuttur.

## Gereksinimler
```
php 8.2
composer
```
## Kurulum
PHP 8.2 ve Composer yüklü olduğundan emin olunduktan sonra
```
composer install
php artisan serve
```
komutlarını çalıştırıp .env ve .env.testing dosyalarını kendinize göre ayarlayabilirsiniz. Dilerseniz Laravel Valet için de Postman Collection üzerinde bir Environmnet düzenlenmiştir.
## Testler
Ekstra olarak pest ile yazılmış olan testleri çalıştırabilmek için;
```
php artisan test
```
komutu kullanılabilir.