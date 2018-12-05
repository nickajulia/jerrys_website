<?php get_header(); ?>

  <tr>
    <td align="left" valign="top" style="padding-top:10px;"><table width="880" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="668" align="left" valign="top"><table width="98%" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top"><table width="630" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td width="11" align="left" valign="top"><img src="<?php bloginfo('template_url') ?>/images/heading-left.jpg" alt="" width="11" height="40" /></td>
                <td width="608" align="left" valign="middle" class="headeing-mid"><div class="left">BREAKING NEWS</div><div class="right"><img src="<?php bloginfo('template_url') ?>/images/rss.png" alt="" /></div></td>
                <td width="11" align="right" valign="top"><img src="<?php bloginfo('template_url') ?>/images/heading-right.jpg" alt="" width="11" height="40" /></td>
              </tr>
            </table></td>
          </tr>

	<?php if (have_posts()) : ?>

		<tr>
                      <td align="left" valign="top" class="content-bg" style="padding-bottom:15px;"><h2 class="pagetitle">Search Results</h2></td>
                      </tr>
 <tr>
            <td align="left" valign="top" class="content-bg">
            
            <div class="post-nav">
            <ul>
		<?php while (have_posts()) : the_post(); ?>

			<li>
            <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
     <h1> <?php the_time('F jS, Y') ?></h1></td>
  </tr>
  <tr>
    <td align="left" valign="top" style="padding-top:10px; padding-bottom:10px;" class="content_text"><p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p></td>
  </tr>
</table>

            
            
            
            
            </li>
            
           <?php endwhile; ?>
            
            </ul>
            
            
            </div>
            
            
            </td>
          </tr>
           <tr>
                      <td align="left" valign="top" class="content-bg"><table width="95%" border="0" align="center" cellpadding="2" cellspacing="2">
                        <tr>
                          <td width="50%" align="left" valign="top"><?php next_posts_link('&laquo; Older Entries') ?></td>
                          <td width="50%" align="right" valign="top"><?php previous_posts_link('Newer Entries &raquo;') ?></td>
                        </tr>
                      </table></td>
                    </tr>
                     <?php else : ?>
                    <tr>
                      <td align="left" valign="top" class="content-bg"><h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?></td>
                    </tr>
                 	<?php endif; ?>
          <tr>
            <td align="left" valign="top"><img src="<?php bloginfo('template_url') ?>/images/content-bottom.jpg" alt="" width="630" height="16" /></td>
          </tr>
        </table></td>
       <td  align="left" valign="top" style="border-left:1px solid #a0a0a0; padding-left:10px;"><?php get_sidebar(); ?></td>
      </tr>
    </table></td>
  </tr>
 
<?php get_footer(); ?>