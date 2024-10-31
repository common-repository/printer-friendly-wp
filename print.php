<!DOCTYPE html>
<html>
<meta charset="UTF-8" />
<head>
<title></title>
</head>

<body>
<?php $postid = $_GET["id"];?>
<?php $wpLoad = $_GET["arl"];?>
<?php $load = $wpLoad.'wp-load.php';?>
<?php require_once($load);  ?>


<?php query_posts('p='.$postid) ?>
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h2><?php the_title(); ?></h2>
               
                
                				<small><?php the_time('F jS, Y') ?> by <?php the_author() ?> | <?php the_permalink() ?></small>
<br /><br />
				<div class="entry">
					<?php 
					
					//the_content();
					
					echo preg_replace("/\[caption .+?\[\/caption\]|\< *[img][^\>]*[.]*\>/i","",get_the_content(),1);
					
					?>
				</div>
				
			</div>

		<?php endwhile; ?>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>
<body/>
</html>