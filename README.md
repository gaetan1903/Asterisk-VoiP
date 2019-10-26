# Asterisk-VoIP

## Presentation 

#### Ceci est un projet du cours *Configuration Informatique (INFO_260)* de [ESTI](https://esti.mg)

> Quoi? , attends! Tu veux dire que ce truc n'est qu'un devoir? alors pourquoi le publié ici? :open_mouth:

Et oui, On appelle plutôt cela chez nous, à  l'ESTI **un projet**.
C'est quelque chose que beaucoup d'entreprises recherche.

#### Ce Projet consiste à installer et configurer un serveur Asterisk
Le but de ce projet est de réaliser des appels locals sans frais, juste un réseau communs 

> c'est génial alors, donc On peut telephoner, sans frais supplémentaires, 
>> Oh, J'ai hâte que l'on puisse l'installer. :heart_eyes:

#### En outre, On va ajouté un serveur IVR avec 
> C'est quoi ça encore ? 

Calmez vous, Vous aller voir après.


## Outils

Dans ce petit tutoriels `Si on peut l'appeler comme ça` Nous alons utiliser Debian comme OS.

> Debian, Mais il y a beaucoup de versions ! Lequel? 

Oui, Les vieux vont vous dire, les anciennes versions sont parfaites :stuck_out_tongue:, Les legendes utilisent la dernière. :joy: 
Hahaha! Je plaisante, à vous de voir. Je ne pense pas être le mieux placé pour repondre à cette question . :grin:


## Installation
#### VOUS POUVEZ PASSER CETTE SECTION SI VOUS AVEZ DEJA REUSSI L'INSTALLATION

##### Je connais deux methodes d'installation sous debian et ses dérivés (Ubuntu, Kali, ...) 

- ###  Installation via la source (Recommandé) 
  * Je vous conseil ce [pdf](https://thomas-romnain.weebly.com/uploads/2/5/8/8/25885917/procdure_asterisk.pdf) pour cette methode: [Cliquer ici pour le Télécharger](https://thomas-romnain.weebly.com/uploads/2/5/8/8/25885917/procdure_asterisk.pdf)
- ###  Installation via depot `apt` ou `apt-get`
  * Je vous conseil de voir sur le doc officiel de Ubuntu pour celle-ci: [Cliquer ici](https://doc.ubuntu-fr.org/asterisk)
  
  
## Configuration d'appel
> Houra! J'ai réussi l'installation :smiley:
  
C'est un bon debut, bravo :grin: Maintenant passons à la configuration.

- #### Modifier le fichier /etc/asterisk/sip.conf 
    Ouvrir le fichier avec nano ou vim `Si vous l'avez installé` Mais je pense que nano est plus simple.
    
    > Non mais, on veut des interfaces nous!
    
    Ok, d'accord, haha! :smiley:  Je comprend que vous preferiez les choses avec les fenetres (Windows :stuck_out_tongue:)
    
    > Avoue que c'est plus agréable à voir.
    
    Bref, Ouvrez avec `gedit` ou `leafpad`
    
    Aller vers la ligne 334 ou 358 , et trouvez la ligne ***language=***, le mieux et de faire un `Ctrl + w` (si vous êtes sous nano) et taper `language` pour la recherche.
    
    Si vous avez trouver la ligne, il suffit de mettre en `fr` le `en` , et decommenter le si ce n'est pas le cas
    
    <img align="center" src='https://github.com/gaetan1903/Asterisk-VoiP/blob/master/data/sip-langage.png'>


- ### Ajouter des Utilisateurs
    * Sauvegarder le fichier /etc/asterisk/users.conf 
       `# cp /etc/asterisk/users.conf /etc/asterisk/users.conf.save` 
    * Puis Ouvrer ce fichier et effacer tous 
    * Puis ajouter comme ceci: <img align="center" src='https://github.com/gaetan1903/Asterisk-VoiP/blob/master/data/users-config.png'>
    * En modifions bien sur les choses essentielles (context, nom, ...), ajouter tant d'utilisateurs que vous voudriez
    * Si vous vouliez ajouter beaucoup d'utilisateures, essayer de voir les [templates](https://www.voip-info.org/asterisk-config-template/)

- ### Modifier /etc/asterisk/extensions.conf 
  * Sauvegarder le fichier  en question, et supprimer tous de dans, Ce sera  plus en ordre comme ça.  
  * Puis ajouter les lignes suivantes: 
  
    ` [gl]
    ` exten =>  _1XXX,1, Dial(SIP/${EXTEN},20)
    ` exten =>  _1XXX,2, Hangup() 
    
    En gros ces lignes veut dire, que si le numero commençons par 1 suivi de 3 chiifres est composés, appeler le.
    
    Si l'appel est terminé, raccrocher. 
    
 
 - ### Rechager la configuration
 Vous avez deux methodes de le faire:
   * Soit en faisant un: `systemctl reload asterisk ` 
   * Soit en la restartant directe avec : ` systemctl restart asterisk ` 
   * Soit en tapant sous la console : `# asterisk -cvvvvr ` et puis *reload*
   
  - ### Configurer vos applications clients, et faites les testes 
    A ce niveau , tous doit fonctionner, Pour les applications , je recommande:
      * ***X-Lite*** pour Windows
      * ***Jami ou ZoiPPer*** pour Linux
      * ***ZoiPPer, MizuDroid*** Pour Android 
      > Eh ô, et pour les I-Phone alors ???           
       
       Désolé , ce monde m'est totalement inconnu :smiley: 
       
       A vous de jouer maintenant, tester les appels. :wink:
       
       
       
## Mise en place d'un Serveur Vocale Interactif

C'est ici que ça devient interessant, On va installer un serveur qui nous fait interagir avec la base de donnée.

> Attend, une seconde, que veux tu dire par une base de donnée? tu parle de mysql, Oracle, et tout ?

Oui, tu as tout vu, On va par exemple faire deux options, consulter notre solde et de pouvoir transferer les soldes.

> Estce que c'est normal si j'ai peur?, ça sent la programmation ce truc quoi :worried:

Non, ce sera simple, crois moi, quand tu auras fini, tu vas te dire, genre seulement ça :wink: :joy:


1. ### Installons quelque chose qui va simuler du voix 

Justement, si on utilisait un script de google pour le faire, bon,  de plus google offre cela avec son script fait avec du langage `perl` , de pouvoir transformer du texte facilement en voix, c'est à dire de la lire. 

 D'abord installez ces dependances pourqu'il puisse bien fonctionner 
 
 `# apt-get install perl libwww-perl sox mpg123` 
 
 Puis, Aller dans le dossier de l'AGI BIN
   * dans ***cd /var/lib/asterisk/agi-bin/*** , Si vous avez installer via source
   * dans ***cd /usr/share/asterisk/agi-bin/***, Si vous avez installer via `apt-get` 
   
 Arriver dans le dossier, telecharger le fichier: 
 
 `# wget https://raw.github.com/zaf/asterisk-googletts/master/googletts.agi`
 
 Puis, donner la permission d'execution au script: `chmod +x googletts.agi`
 
 
 
 2. ### Codons Maintenant 
 
 Pour la liaison **asterisk** **php**, il y a differents methodes
   * En utilisant curl et apache 
   * En utilisant le cdr
   * ... 
   
  Ce que je vais utiliser ici, c'est de lancer un script php, en faisant appel à la fonction `agi()`
  
  > mille milliards de mille sabords, c'est quoi encore ça ? agi tu as dis? 
  
  Oui, C'est une fonction qui permet de lancer un script, elle est integrer à Asterisk.
  
  **exemple**:
  
   Pour lancer le googletts, on utilise la fonction agi: ` agi(googletts.agi, "Je susi un test ", fr, any)`
   
   
      " Talk is cheap, Show me the code " 
                               Linus Torvalds 
                               
Okey d'accord, J'arrete de parler! Fallais pas s'enerver. :sweat_smile:

Bon, Analysons directe notre extensions.conf alors `Je suppose que vous savez où c'est.`


    ;Répondeur asterisk
    exten => 1000,1,Answer() ; si quelq'un appel repond 
    ;On met un timeout de 10 secondes pour le choix du destinatire
    exten => 1000,2,Set(TIMEOUT(response)=10)
    ;On annonce les différents choix
    exten => 1000,3,agi(googletts.agi,"Bienvenues chez gaetan1903.github.io",fr,any)
    exten => 1000,4,agi(googletts.agi,"Pour consultez votre solde tapez 1",fr,any)
    exten => 1000,5,agi(googletts.agi,"Pour faire une transaction tapez 2",fr,any)
    ;On attend que l'utilisateur appuis sur une touche
    exten => 1000,6,WaitExten()
 
 
Voila, les repondeurs interactifs repond , à nous d'entrer notre choix maintenant 

  
    ;Si l'utilisateur appuis sur 1, y a une consultation de solde.
    exten => 1,1,agi(script1.php)


Donc l'instruction ci-dessous indique que, si on tape sur 1, agi va executer, le script1.php 

> Oui, mais , attend une minute, c'est quoi ce script1.php, je me perds là . 

Du calme, on l'as pas encore créer, mais on va le créer bientôt.

> Mais après, comment php va reconnaître qui demande le solde ?  

Oui, bonne question, pour cela on envoie un parametre à php 

Pour envoyer un parametre on le met apres le nom du script suivit du virgule.

exemple: `exten 1,1, => agi(script1.php, 5000)`

> Ah je comprends, Mais c'est trop static ça, et si c'était pas le numero 5000 mais autre? 

Hahaha, Je vois que tu raisonne bien, Bon , si on consultait un peu [la documentation officielle](https://www.voip-info.org/asterisk-agi-php/)

![fragment de capture dans la documentation](https://github.com/gaetan1903/Asterisk-VoiP/blob/master/data/list_variable.png)

C'est une image que j'ai capturer, il decrit les variables pré-definis dans asterisk. 

Vous pouvez alors mettre un ou plusieurs de ces varibles en parametre à donner à notre script php. 

On va prendre le ***agi_callerid*** `le numero de la personne qui appelle` 

donc notre instructions devient: 

     ;Si l'utilisateur appuis sur 1, y a une consultation de solde.
    exten => 1,1,agi(script1.php, agi_callerid)
    
    
Okey, Ne vous réjouissez pas encore, on a pas encore écrit le **script php** 
> Oh Maman, j'ai peur :anguished: 

Oh lala! Je n'ai pas voulu te faire peur, mais ce n'est qu'un script



- Installer mysql 
  * Sous linux, on installe la version open source de mysql pour l'avoir: **mariadb** 
  
    un `# apt-get install mariadb-server` fera l'affaire je pense 
    
-  Installer php 
     
     
     
Bon, les outils sont prêts, la connexion entre php et mysql(mariadb) va se faire avec la classe PDO 

Chercher sur Internet comment activer votre pdo ( Je n'en parle pas dans ce propos )


#### NB: ici, je suppose que vous avez installer via source, donc votre agi-bin se trouve dans */var/lib/asterisk/agi-bin*


  cd /var/lib/asterisk/agi-bin
  
  touch script1.php
  
Voilà, on vient de creer ce fameux *fichier php*  

Maintenant ouvrer le avec votre editeur (nano, vim, gedit, ...) 

Ajouter à la première ligne l'interpreteur qui va lancer ce fichier, on indique donc php 

Comme ceci: `#!/usr/bin/php ` (le chemin ou se trouve php dans le system)

Puis, aux bonnes habitudes de php , comme : 

![Script php vierge](https://github.com/gaetan1903/Asterisk-VoiP/blob/master/data/script1-vierge.png)


On va d'abord creer une base de donnée 

- Ouvrir mysql avec la commande: `# mysql `
- Creer une base de donnée: `> CREATE DATABASE asterisk;` Vous pouvez mettre le nom qui vous convient
- Selecionner cette base de donnée: `USE asterisk;`
- Creer une table : `CREATE TABLE User (nom Varchar(25), numero int, solde int);`
- Créer un utilisateur: `CREATE USER 'gaetan'@'localhost' identified by 'password';`
- Donner privileges: `GRANT ALL PRIVILEGES ON *.* TO 'gaetan'@'localhost';`
- CONFIRMER: `FLUSH PRIVILEGES;`

A vous d'inserer les données.

Ouvrons Maintenant notre script.php, on vas faire la connexion

`$bdd = new PDO('mysql:host=localhost;dbname=asterisk','gaetan','password');`

- asterisk: le nom de la base de donnée
- changer à votre propre option. 

Maintenant, il faut recuperer les parametres que la fonction agi dans extension.conf a envoyer.

On va utiliser un module qui s'appelle php-agi.

Il faudra la telecharger : <http://phpagi.sourceforge.net/>

> Hey Monsieur, Je suis en mode console moi, comment voulez vous que je telecharge ça.

Tu vas le telecharger directement via wget, j'ai un lien special pour toi:

`wget https://raw.githubusercontent.com/gaetan1903/Asterisk-VoiP/master/data/phpagi.zip`

SI vous avez aussi des difficultés pour le telecharger, faîtes la ligne de commande precedante.

Heuresement que je l'ai heberger dans mon repertoire github :stuck_out_tongue_closed_eyes:

Maintenant decommpresser le avec `unzip phpagi.zip ` (installer unzip si il ne l'est pas )

Si reussi, un dossier phpagi est  créer. > Vous êtes actuellement dans le dossier **agi-bin/**

*Revenons à nos moutons*

Ouvrez maintenant script1.php et importer le agi-php en question 

`require('phpagi/phpagi.php');`  le module se trouve dans le dossier phpagi.

Nous pouvons maintenant instancier la classe AGI,  comme suite: 

`$agi = new AGI();`

Nous obtiendrons alors comme ceci : 

![Instanciation de la classe AGI](https://github.com/gaetan1903/Asterisk-VoiP/blob/master/data/script1-require.png)


Pour recuperer le parametre envoyer, On va utiliser, la proprieté ***request*** de la classe AGI() 

`$callerid = $agi->request['agi_callerid'];` Le parametre que nous avons ecrit dans extensions.conf

> Hourra! j'ai recuperer dans la variable $callerdid le numero de l'appelant !

Oui, c'est cela, vous pouvez utiliser celle-ci comme indice de rquete de base de donnée 

    $consulter =  $bdd->query( "SELECT solde  FROM Users where numero = '$callerid' ");
		  $sld = $consulter->fetchall();
    $solde = $sld[0][0];
    
 Voila un petit code php qui va faire la requete du solde et de mettre dans la variable $solde la reponse 
 
 > Calme toi, Je ne comprends pas ce code !! 
 
 Oh Domage , Je ne suis pas prof de php , essaie de trouver par toi même pour ceci.
 
 > Haha, Je plaisantais, Bien sur que je sais faire un requet avec php, On l'a déjà fait avec le projet de Monsieur Nirina.
 
 Donc, voila le solde est maintenant dans la variable $solde. 
 
 > Et comment on fait pour le donner à Asterisk ? 
 
 Il existe une methode de l'objet AGI() qui sert à declarer depuis php une variable dans l'extension.conf
 
 > Vas-y doucement, Je n'arrive pas à suivre
 >
 > Et puis c'est quoi objet, methode et tout? 
 
 En gros, une methode c'est un fonction propre à la classe ( notion de la programmation orienté objet ) 
 
 > Tu sais, laisse tomber, c'est complqiuer, et puis on s'en fou de qu'est ce que c'est :grin:
 
 D'accord, on va supposer que c'est juste une fonction dans la classe AGI(), la fonction en question est **set_variable**
 
 Elle prend 2 parametres, le nom de la variable à declarer et puis sa valeur.
 
 > Juste une question, comme tu sais tout ça.
 
 Haha, J'ai fouillé le code source de leur code quoi, tu peux jeter un coup d'oeil [ici](https://github.com/gaetan1903/Asterisk-VoiP/blob/master/phpagi/phpagi.php)
 
 Mais avant de declarer la variable, il faut d'abord appeler la methode `answer` 
 
 On implemente donc le code avec:
 
    $agi->answer();
    $agi->set_variable('VOLA', $solde);
    
  Voila, le tours est joué.
    
 
 
 




  
  
