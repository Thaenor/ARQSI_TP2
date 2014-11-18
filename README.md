IDEIMusic
=========

A project developped in the context of system arquichtecture classes.

#RUI DEVES-ME UM CAFÉ!!!#

#Important Notes:#

The Index view for Album and User are currently working, you can view this by going straight to the url localhost/User/index and localhost/Album/Index I'm too tired to figure out why the home page isn't opening the links directly but it probably has to do with the default layout where I first wrote the links for those pages.

**very important**
I haven't tried setting up this project in any other machine but chances are you are going to have to build the database on your own.
For that follow these steps.

1. From the Tools menu, click Library Package Manager and then Package Manager Console
2. At the PM> prompt enter the following command:
> enable-migrations -contexttypename MusicContext

![It should show this](http://i2.asp.net/media/4336278/1pm2.png?cdn_id=2014-11-11-001)

3. > add-migration InitialCreate
update-database

![It should show this](http://i3.asp.net/media/4336302/1addMIg.png?cdn_id=2014-11-11-001)

you should be able to see this in the server explorer

![something](http://i1.asp.net/media/4336272/1dbG.PNG?cdn_id=2014-11-11-001)