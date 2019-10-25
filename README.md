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
       
    
    
    
    
    
