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
    * Sauvegarder le fichier /etc/asterisk/users.conf `# cp /etc/asterisk/users.conf /etc/asterisk/users.conf.save` 
    * Puis Ouvrer ce fichier et effacer tous 
    * Puis ajouter comme ceci: <img align="center" src='https://github.com/gaetan1903/Asterisk-VoiP/blob/master/data/users-config.png'>
    
