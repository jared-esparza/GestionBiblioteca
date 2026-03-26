<!DOCTYPE html>
<html lang="<?= LANGUAGE_CODE ?>">
	<head>
		<?= $template->metaData(
            "Panel del bibliotecario",
            "Panel de control con las operaciones principales para el bibliotecario"
        ) ?>
        <?= $template->css() ?>
	</head>

	<body>

		<?= $template->header(null, 'Panel de bibliotecario') ?>
		<?= $template->menu() ?>
		<?= $template->breadCrumbs(["Panel de bibliotecario" => null]) ?>
		<?= $template->messages() ?>

		<main>
    		<h1>Panel del bibliotecario</h1>

    		<p>Aquí encontrarás los enlaces a las distintas operaciones.</p>

    		<div class="flex-container gap2">
        		<section class="flex1">
        			<h2>Operaciones con libros</h2>
        			<ul>
        				<li><a href="/Libro">Libros</a></li>
        				<li><a href="/Libro/create">Nuevo libro</a></li>
        			</ul>
        		</section>

        		<section class="flex1">
        			<h2>Operaciones con socios</h2>
        			<ul>
        				<li><a href="/Socio">Socios</a></li>
        				<li><a href="/Socio/create">Nuevo socio</a></li>
        			</ul>
        		</section>
    		</div>

    		<div class="flex-container gap2">
        		<section class="flex1">
        			<h2>Operaciones con temas</h2>
        			<ul>
        				<li><a href="/Tema">Temas</a></li>
        				<li><a href="/Tema/create">Nuevo tema</a></li>
        			</ul>
        		</section>

        		<section class="flex1">
        			<h2>Operaciones con préstamos</h2>
        			<ul>
        				<li><a href="/Prestamo">Préstamos</a></li>
        				<li><a href="/Prestamo/create">Nuevo préstamo</a></li>
        			</ul>
        		</section>
    		</div>
		</main>

		<?= $template->footer() ?>
		<?= $template->version() ?>
	</body>
</html>

