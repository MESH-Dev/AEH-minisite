<section class="speaker bg panel <?php echo $section['section_color']; ?>fade" id="<?php echo $section['section_color']; ?>">
	<div class="bgfade">
		<div class="container">
			<div class="gutter">
				<h2 class="panel-title"><?php echo $section['section_title']; ?></h2>
				<?php $speakers = $section['speakers'];
					foreach($speakers as $speaker){ ?>
					<div class="one-half floatleft speaker-entry">
						<div class="speaker-portrait one-fourth floatleft">
							<img src="<?php echo $speaker['portrait']; ?>"/>
						</div>
						<div class="speaker-info three-fourth floatleft">
							<div class="gutter">
								<h3><?php echo $speaker['name']; ?></h3>
								<span class="speaker-session"><?php echo $speaker['session']; ?></span>
								<?php echo $speaker['description']; ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>