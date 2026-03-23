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

    		<section id="queesfastlight"  class="flex-container gap2">
				<div class="flex2 readable" data-event="dblclick">
            		<h2>Introducción</h2>
            		
            		<p>
            			Esta aplicación es un ejemplo de clase para los cursos de Desarrollo de aplicaciones web que imparte Robert Sallent. 
						Se desarrolla a lo largo de múltiples sesiones, hasta conseguir un resultado similar al que se muestra.
						Ha sido implementada con el Framework FastLight, que es un framework PHP rápido y ligero para desarrollar aplicaciones web o APIs RESTFUL.
            		</p>
            	
    		    </div>   
    		    
    		    <figure class="flex1 medium centered centered-block">
    		    	<img class="square fit with-modal" src="/images/template/phpmysql.png" 
    		    		 alt="FastLight recomienda PHP8.2 y MySQL8"
    		    		 title="FastLight recomienda PHP8.2 y MySQL8"
    		    		 data-caption="La combinación perfecta"
    		    		 data-description="Se recomienda PHP8.2 y MySQL8"
    		    	>
    		    </figure>
		    </section>
		    
		</main>
    
		<?= $template->footer() ?>
		<?= $template->version() ?>
		
	</body>
</html>

