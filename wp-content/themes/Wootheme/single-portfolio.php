<?php get_template_part( 'template-part/portfolio', 'header' ); ?>



                    <?php while (have_posts()) : the_post(); ?>
             
                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
                        <p class="meta">Posted By <a><?php the_author_link() ?></a> On <?php echo get_the_date() ?> Category :- <?php  get_the_category();?></p>
                        <div class="entry">
                            <?php the_content(); 
                                 comments_template('/comments.php');
                                endwhile;
                            ?>
                        </div>
                        
                <?php get_template_part( 'template-part/portfolio', 'footer' ); ?>