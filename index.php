<?php get_header(); ?>
<div class="container">
	<div class="row">
        <div class="col">
            <div class="row">
                <?php if (have_posts()): while (have_posts()): the_post();?>
                    <!-- посты -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="<?php the_permalink(); ?>"><h5 class="card-title"><?php the_title(); ?> </h5></a>
                            </div>
                            <div class="card-body">
                                <?php if (has_post_thumbnail()) :
                                    the_post_thumbnail('thumbnail', array('class' => 'float-left mr-3'));
                                else:?>
                                    <img src="https://picsum.photos/150/150" width="150" height="150" class="float-left mr-3">
                                <?php endif; ?>
                                <p class="card-text"><?php  the_excerpt(); //the_content(''); // ?></p>
                            </div>
                            <div class="card-footer">
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Читать далее...</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                    <!-- навигация -->
                    <?php the_posts_pagination(array(
                        'show_all'     => false,
                        'end_size'     => 2,
                        'mid_size'     => 2,
                        'prev_next'    => true,
                        'prev_text'    => __('« Назад'),
                        'next_text'    => __('Вперед »'),
                        'type'         => 'list',
                        'add_args'     => false,
                        'add_fragment' => '',
                        'screen_reader_text' => __( ' ' ),
                    ) ); ?>
                <?php else: ?>
                    <!-- нет постов -->
                    <p>Постов нет...</p>
                <?php endif; ?>
            </div>
        </div>
        <?php get_sidebar('left'); ?>
        <?php get_sidebar(); ?>
    </div>
</div>




<?php get_footer(); ?>
