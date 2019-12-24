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
	<p><a href="https://github.com/jmr4274tbj/Applications_Internet">Lien github</a></p>
	<p> 
            
        
        <h4>Fonctionnement du démarrage de session et du changement de mot de passe :</h4>
        <p>
            <ul>
		<li>1. Ajouter un emprunt</li>
		<li>2. Modifier un emprunt</li>
		<li>3. Clique sur liste dynamiques sur le gabarit qui....</li>
		<li>4. Cliquer sur about sur le gabarit qui affiche la page À propos</li>
            </ul>
	</p>
        <h4>Fonctionnement du "Captcha" :</h4>
        <p>
            <ul>
		<li>1. </li>
		<li>2. </li>
            </ul>
	</p>
        <h4>Procédure pour tester le fonctionnement de l'interface AngularJS des listes liées et du modèle "CRUD" monopage :</h4>
        <p>
            <ul>
		<li>1. </li>
		<li>2. </li>
            </ul>
	</p>
        <h4>Fonctionnement du cliquer-glisser pour ajouter une image :</h4>
        <p>
            <ul>
		<li>1. </li>
		<li>2. </li>
            </ul>
	</p>
      
    </body>
</html>
