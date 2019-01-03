# portal-anket
Projenin Çalıştırılması

portal dizini altinda ki composer.json dosyasının içerisine aşağıdaki kod eklenir.


   "repositories": [
        ....
        {
        "type": "vcs",
        "url": "https://github.com/PluwJin/portal-anket.git"
    }
    ....
    ]

daha sonra vagrant ssh ile bağlanılarak /var/www/portal dizininde:
"composer require kouosl/portal-anket:dev-master" 
komutu çalıştırılarak composer.json da require kısmının eklenmesi sağlanır
 
       
portal/backend/config/main.php ve portal/frontend/config/main.php dosyasinda


        'modules' => [
        ....
    'anket' => [

        'class' => 'kouosl\anket\Module',

    ],
    ....
],



seklinde ekleme yapilir.

daha sonra composer update komutu çalıştırılır.
Son olarak migration islemi olarak vagrant ssh ile bağlanıp  cd /var/www/portal dizinine gidilir.
php yii migrate --migrationPath=@vendor/kouosl/portal-anket/migrations
komutu uygulayarak veritabanımızı hazır hale getiriyoruz.

frontend tarafina http://portal.kouosl/anket

backend kismina

http://portal.kouosl/admin/anket

adreslerinden ulasabilirsiniz.

