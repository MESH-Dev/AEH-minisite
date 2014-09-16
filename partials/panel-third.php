<section class="half panel <?php echo $section['section_color']; ?> <?php echo $section['section_color']; ?>fade" id="<?php echo $section['section_color']; ?>">
	<div class="bgfade">
		<div class="container">
		<div class="gutter clearfix">
		<h2 class="panel-title"><?php echo $section['section_title']; ?></h2>
			<div class="two-third floatleft">
				<div class="gutter">
					<?php if($section['third_left_column_title'] != '')
					{ ?>
						<h2 class="section_title"><?php echo $section['third_left_column_title']; ?></h2>
			        <?php } ?>
					<?php echo $section['third_right_column_left']; ?>
				</div>
			</div>
			<div class="one-third floatright">
				<div class="gutter">
					<?php if($section['third_right_column_title'] != '')
					{ ?>
						<h2 class="section_title"><?php echo $section['third_right_column_title']; ?></h2>
			        <?php } ?>
					<?php echo $section['third_right_column_right']; ?>
				</div>
			</div>
		</div>
		</div>
	</div>
</section>