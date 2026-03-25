<!DOCTYPE html>
<html lang="<?= LANGUAGE_CODE ?>">
	<head>
		<?= $template->metaData(
                "Portada del sitio",
                "Página de inicio del framework PHP FastLight"
        ) ?>           
        <?= $template->css() ?>
		
		<!-- JS -->
		<script src="/js/TextReader.js"></script>
		<script src="/js/Modal.js"></script>
	</head>
	
	<body>
		
		<?= $template->menu() ?>
		<?= $template->header('Aplicación BiblioCIFO') ?>
		<?= $template->messages() ?>
		<?= $template->acceptCookies() ?>
		
		<main>
    		<h1>¡Bienvenido a BiblioCIFO!</h1>

			<section class="flex-container gap1">
				<div class="flex2">
					<h2>Introducción</h2>
					
            		<p>Esta aplicación es un ejemplo de clase para los cursos de <b>Desarrollo de aplicaciones web</b> 
            		que imparte <a href="https://robertsallent.com">Robert Sallent</a>. Se desarrolla a lo largo de múltiples 
            		sesiones, hasta conseguir un resultado similar al que se muestra.</p>
            		
            		<p>Ha sido implementada con el Framework 
            		<code><a href="https://github.com/robertsallent/fastlight">FastLight</a></code>,
            		que es un <i>framework PHP</i> rápido y ligero para desarrollar <b>aplicaciones web</b> o <b>APIs RESTFUL</b>.</p>
            		
            		<p>Para más información sobre el framework, cursos o solicitar documentación, podéis usar el 
            		<a href="/Contacto">formulario de contacto</a>.</p>
            		
            		<div class="mt3">
            			<a href="/Libro" class="button maxi">Ver los libros</a>
            		</div>
            		
        		</div>
        		<figure class="flex1">
        			<img class="with-modal" data-caption="BiblioCIFO" data-description="El proyecto de aplicación para gestión de bibliotecas del CIFO Sabadell." 
						src="images/template/library.jpg" alt="Nuestra biblioteca en CIFO Sabadell" title="nuestra biblioteca en CIFO Sabadell">
        			<figcaption>Biblioteca BiblioCIFO</figcaption>
        		</figure>
    		</section>

			<section>
    			<h2>Novedades</h2>
    			
    		   	<p>Estas son nuestras últimas adquisiciones: </p>
    			  
    			<div class="galeria w100">
				<?php foreach($libros as $libro){ ?>
    				<figure class="card">
						<img src="<?= BOOK_IMAGE_FOLDER . '/' .($libro->portada ?? DEFAULT_BOOK_IMAGE) ?>" 
							alt="<?= $libro->titulo ?>" title="<?= $libro->titulo ?>" 
							data-caption="<?= $libro->titulo ?>" data-description="De <?= $libro->autor ?>" 
							class="with-modal portrait fit">
						<figcaption class="my2">
							<div style="min-height: 60px">
								<?= $libro->titulo ?>, de <?= $libro->autor ?>
							</div>
							<div class="right">
								<a class="button" href="/Libro/show/<?= $libro->id ?>">Ver</a>
							</div>
						</figcaption>
					</figure> 
    			<?php } ?>					
    			</div>	
    				    
		    </section>
		    
		</main>
    
		<?= $template->footer() ?>
		<?= $template->version() ?>
		
	</body>
</html>

