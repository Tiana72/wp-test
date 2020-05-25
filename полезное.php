    <?php if (have_posts()): while (have_posts()): the_post();?>
		<!-- пост -->
        
    <?php endwhile; ?>
		<!-- навигация -->

    <?php else: ?>
		<!-- нет постов -->
    
    <?php endif; ?>