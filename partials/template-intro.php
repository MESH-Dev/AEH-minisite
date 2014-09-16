<section id="intro" class="panel"><div class="bg">
	<div class="container">
		<div class="gutter clearfix">
			<div id="intro-left" class="two-third floatleft">
			<div class="gutter">
				<span class="intro">
					<?php the_field('intro_left_column'); ?>
				</span>

				<?php if(get_field('intro_left_column_first') && get_field('intro_left_column_second')){?>
				<div class="one-half floatleft">
					<div class="gutter">
						<?php the_field('intro_left_column_first'); ?>
					</div>
				</div>
				<div class="one-half floatright">
					<div class="gutter">
						<?php the_field('intro_left_column_second'); ?>
					</div>
				</div>
				<?php }else{ ?>
				<div class="full-width floatleft">
					<div class="gutter">
						<?php the_field('intro_left_column_first'); ?>
					</div>
				</div>
				<?php } ?>

			</div>
			</div>

			<div id="intro-right" class="one-third floatright">
				<div class="gutter">
					<?php if(get_field('registration_link') && get_field('registration_label'))?>
					<div id="registration">
						<a href="http://<?php the_field('registration_link'); ?>"><?php the_field('registration_label'); ?></a>
					</div>
					<div class="data">
						<?php the_field('intro_right_column'); ?>
					</div>
				</div>
			</div>

			<div id="intro-sponsors" class="full-width floatleft">
				<?php the_field('intro_sponsors'); ?>
			</div>
		</div>
	</div>
</div></section>