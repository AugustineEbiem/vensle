# vensle
Vensle.com is an online marketplace that bring buyers and sellers in a neighbourhood together. You can sell or buy new and used items to people around you. With vensle.com, buying and selling is very fast and easy.

# vensle
Clone the repository.
Run composer install.
Change database credentials in config.php to match yours.

in .htaccess , change this below to reflect your server's folder structure.
```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase {{/vensle-current}}
 ```
   

If your folder name is vensle, change it to vensle. If it is on your root server, change it to "/"

Mine was located in /var/www/html/vensle-current , that is why it is stated as vansle-current

Do the same in index.php, line 14 
```
$uri = '/vensle-current';
```
	
Change $uri to reflect your folder name

Finally, now you can run the application.
However, do note that I will have to send the vensle-assets folder to you as a zip.
I will upload it on Google drive and send the link to the whatsapp group
Unfortunately, it contains all the images of the server and is to big to be uploaded here to github.
