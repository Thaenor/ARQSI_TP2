ARQSI_TP2
=========
#NOTAS TEMPORÁRIAS PARA O DESENVOLVIMENTO#

##Criar a base de dados local da editora##
1. From the Tools menu, click Library Package Manager and then Package Manager Console
2. At the PM> prompt enter the following command:
> enable-migrations -contexttypename MusicContext

![It should show this](http://i2.asp.net/media/4336278/1pm2.png?cdn_id=2014-11-11-001)

3. > add-migration InitialCreate
update-database

![It should show this](http://i3.asp.net/media/4336302/1addMIg.png?cdn_id=2014-11-11-001)

you should be able to see this in the server explorer

![something](http://i1.asp.net/media/4336272/1dbG.PNG?cdn_id=2014-11-11-001)

=========
##Project Overview##

This project is developed in the context of system architecture classes (ARQSI).
It consist in creating an "ecosystem" for music album stores. The project consists in a total of 3 different servers.

1. IDEIMusic: A record label. It creates music albums and supplies them to music stores. This is developped in ASP.Net

2. MusicStore: A music store that buys music albums from the label editor and resells them to the end users (costumers). This is developped in PHP **(using framework NuSOAP and MINI)**

3. ImportMusic: This server consist in a market analyst, it records sales and stores them in it's own database.

**Important notes:**

. each server has it's own database
. for the purposes of this project MusicStore's database will consist in a part of IDEIMusic's DB, *which will be the albums purchased from the label editor*

=========

###IDEI Music Documentation ###

**TODO: add documentation graphics here**

=========

###Music Store Documentation ###

**TODO: add documentation graphics here**

=========
=========

##Resumo do projecto##

Este projecto foi desenvolvido no contexto da disciplina do ISEP de Arquitectura de Sistemas (ARQSI).
Consiste no desenvolvimento de um "ecossitema" de compra e venda de albuns musicas. Para tal serão implementados 3 diferentes servidores independentes que comunicam entre si.

1. IDEIMusic: Desenvolvida em ASP.Net, é a editora de albuns. Responsável pelo fornecimento dos mesmos às lojas de música no geral

2. MusicStore: Desenvolvida em PHP. Refere-se a uma loja de musica que recebe os albuns da editora IDEIMusic para posteriormente os redistribuir para os clientes finais.

3. ImportMusic: Um servidor de análise de mercados. As compras registadas são enviadas para este, e posteriormente registadas numa base de dados

**Notas importantes:**

. Cada servidor possuí a sua própria base de dados

Autores:
Francisco Santos (1111315)
Rui Silva ()
Sofia Sá ()