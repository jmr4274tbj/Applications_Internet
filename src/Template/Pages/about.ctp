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
    
	<h1>Jonathan Martel-Raiche</h1>
	<h2>420-5b7 MO <?= __('Applications internet') ?></h2>
	<h3><?= __('Automne 2019, Collège Montmorency') ?><h3>
	<br />
	<p><?= __('Diagramme de la bd') ?></p>
	<?php echo $this->html->image('diagramme_bd.png', ['alt' => 'diagramme']); ?>
    <p><a href="http://www.databaseanswers.org/data_models/library/index.htm"><?= __('Diagramme original') ?></a></p>
	<p><a href="https://github.com/jmr4274tbj/Applications_Internet">Lien github</a></p>
	<p> 
	<h4>Étapes dutilisations :</h4>
	<p>
		<ul>
			<li>1. Ajouter un emprunt</li>
			<li>2. Modifier un emprunt</li>
			<li>3. Clique sur liste dynamiques sur le gabarit qui....</li>
			<li>4. Cliquer sur about sur le gabarit qui affiche la page À propos</li>
		</ul>
	</p>
      
    </body>
</html>
