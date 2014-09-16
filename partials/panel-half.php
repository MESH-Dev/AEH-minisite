<section class="half <?php echo $section['section_color']; ?>fade panel <?php echo $section['section_color']; ?>" id="<?php echo $section['section_color']; ?>">
	<div class="bgfade">
		<div class="container">
		<div class="gutter clearfix">
			<h2 class="panel-title"><?php echo $section['section_title']; ?></h2>
			<div class="one-half floatleft">
				<div class="gutter">
					
					<?php if($section['half_left_column_title']!='')
					{ ?>
						<h2 class="section_title"><?php echo $section['half_left_column_title']; ?></h2>
					<?php } ?>
					<?php echo $section['half_left_column_content']; ?>
				</div>
			</div>
			<div class="one-half floatright">
				<div class="gutter">

					<?php if($section['half_right_column_title']!='')
					{ ?>
						<h2 class="section_title"><?php echo $section['half_right_column_title']; ?></h2>
					<?php } ?>

					<?php if($section['half_right_column_left'] && $section['half_right_column_right']){ ?>
					<div class="one-half floatleft sub-col smaller">
						<div class="gutter">
							<?php echo $section['half_right_column_left']; ?>
						</div>
					</div>
					<div class="one-half floatright sub-col smaller">
						<div class="gutter">
							<?php echo $section['half_right_column_right']; ?>
						</div>
					</div>
					<?php }else{ ?>
					<div class="full-width floatleft sub-col">
						<div class="gutter">
							<?php echo $section['half_right_column_left']; ?>
						</div>
					</div>
					<?php } ?>

				</div>
			</div>
		</div>
		</div>
	</div>
</section>