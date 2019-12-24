<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
    </head>
	
    <style>
    body
    {
        text-align:center;
    }
    </style>
	
    <body>
        
    <h4>Quel est l'intérêt de ce prototype d'application web ?</h4>
	<p>
            Le site va être utilisé par une catégorie d’utilisateurs, 
            alors il faut savoir cibler les types d’utilisateurs que 
            le site concerne et établir le contenu selon ce type. 
            On peut accomplir cela par une interview des clients de 
            l'entreprise par exemple. On veut que le site permettre 
            à l’organisation de combler ses objectifs. Pour vérifier 
            que tous les objectifs sont pris en compte, l’idéal est 
            d’associer des critères opérationnels et quantifiables 
            pour mesurer si les objectifs ont été atteints.
	</p>
        <br />
	<h1>Jonathan Martel-Raiche</h1>
	<h2>420-5b7 MO <?= __('Applications internet') ?></h2>
	<h3><?= __('Automne 2019, Collège Montmorency') ?><h3>
	<br />
	<p><?= __('Diagramme de la bd') ?></p>
	<?php echo $this->html->image('diagramme_bd.png', ['alt' => 'diagramme']); ?>
    <p><a href="http://www.databaseanswers.org/data_models/library/index.htm"><?= __('Diagramme original') ?></a></p>
    <br />
    <p><a href="https://github.com/jmr4274tbj/Applications_Internet">Lien github</a></p>
    <br />
    <h4>Voir le fichier texte "passwords.txt" du dossier "bd" à la racine du projet pour l'information sur les comptes.</h4>
    <br />
    <h4>Fonctionnement du démarrage de session et du changement de mot de passe  :</h4>
        <ul>
            <li>1. L'application attend une réponse positive ou négative.</li>
            <li>2. L'utilisateur peut changer son mot de passe s'il a oublié celui-ci.</li>
            <li>3. Le "Captcha" sert à vérifier si l'utilisateur est bien un humain.</li>
        </ul>
        <h4>Procédure pour tester le fonctionnement de l'interface AngularJS des listes liées et du modèle "CRUD" monopage :</h4>
            <ul>
		<li>1. Cliquer sur le lien "Listes dynamiques avec AngularJS". </li>
		<li>2. Sélectionner une catégorie et les choix de sous-catégories change dynamiquement selon la catégorie choisi.</li>
            </ul>
        <h4>Fonctionnement du cliquer-glisser pour ajouter une image :</h4>
            <ul>
		<li>1. Cliquer sur le lien pour afficher la liste de tous les fichiers. </li>
		<li>2. Glisser un fichier dans la zone "Drop files here to upload".</li>
            </ul>
      
    </body>
</html>
