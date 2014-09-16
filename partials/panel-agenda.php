<section class="agenda panel <?php echo $section['section_color']; ?>">
	<div class="container">
		<div class="gutter clearfix">
			<div class="agenda-header">
				<h2 class="panel-title"><?php echo $section['section_title']; ?></h2>
				<ul class="content-filter">
					<li class="active" data-filter="short">At a Glance</li>
					<li data-filter="extended">Full Version</li>
				</ul>
				<!--
				<select class="session-filter">
					<option>Sort By Session Track</option>
				</select>-->
				<span class="print-agenda"><a href="<?php echo get_post_type_archive_link('agenda'); ?>">Print Full Agenda</a></span>
			</div>
			<div class="agenda-wrap">
				<?php
				//Normal Query
					$args = array(
					'posts_per_page'   => -1,
					'offset'           => 0,
					'category'         => '',
					'orderby'          => 'meta_value_num',
					'order'            => 'asc',
					'include'          => '',
					'exclude'          => '',
					'meta_key'         => 'date',
					'meta_value'       => '',
					'post_type'        => 'agenda',
					'post_mime_type'   => '',
					'post_parent'      => '',
					'post_status'      => array('publish','future'),
					'suppress_filters' => true );
					$posts = get_posts($args);

					$oldDate = '';
					$counter = 0;
					$count = count($posts) - 1;
					foreach($posts as $post){
						$postID = $post->ID;
						$multitrack = get_field('track',$postID,true);
						$newDate = date('dmy',get_post_meta( $postID, 'date', true ));
						$postTime = get_post_meta( $postID, 'time', true );
						$postLoc = get_post_meta( $postID, 'location', true );




						if($oldDate != $newDate && !$multitrack){
							$oldDate = $newDate;
							$newDate = get_post_meta( $postID, 'date', true );
							$displayDate = date('l F j', $newDate);
							//create new row and date banner
							if($counter != 0 || $counter == $count){
								echo '</div>';
							}
							echo '<div class="agenda-row full-width floatleft">';
							echo '<div class="agenda-day-bar full-width floatleft bg">'.$displayDate.'</div>';
							echo '<div class="agenda-entry one-fourth floatleft">
									<div class="gutter">
									<h3>'.$post->post_title.'</h3>
									<p class="timeloc">'.$postTime.'<br><span class="loc">'.$postLoc.'</span></p>
									<div class="agenda-event-content">'.apply_filters("the_content", $post->post_content).'</div>
									</div>
								</div>';





						}elseif($oldDate != $newDate && $multitrack ){
							$oldDate = $newDate;
							$newDate = get_post_meta( $postID, 'date', true );
							$displayDate = date('l F j', $newDate);
							//create new row and date banner
							if($counter != 0 || $counter == $count){
								echo '</div>';
							}
							$tracks = get_field('tracks',$postID);
							$terms = wp_get_post_terms( $postID, 'track' );


							if(count($tracks) > 1){
								$multiple = 'multiple';
							}else{
								$multiple = 'single';
							}

							echo '<div class="agenda-row full-width floatleft">';
							echo '<div class="agenda-day-bar full-width floatleft bg">'.$displayDate.'</div>';
							echo '<div class="agenda-entry one-fourth floatleft workshop multiple '.$multiple.'"><div class="bgx">
									<div class="gutter">
									<h3>'.$post->post_title.'</h3>
									<p class="timeloc">'.$postTime.'</p>';

								echo '<div class="agenda-event-tracks">';
								$trackCount = 1;
								foreach($tracks as $track){
									echo '<div class="agenda-entry-track one-fourth floatleft ';

									$trackTerms = $track['tracks_new'];
									if($trackTerms){
										foreach($trackTerms as $term){
											echo $term->slug.' ';
										}
									}

									echo '" data-filter=" ';

									if($trackTerms){
										foreach($trackTerms as $term){
											echo $term->slug.' ';
										}
									}
									echo '"><div class="gutter">';


									if($terms){
										foreach($terms as $term){
											echo '<span class="trackname">'.$term->name.'</span>';
										}
									}


									echo	'<h3>'.$track["title"].'</h3>
											<p><span class="loc">'.$track["location"].'</span></p>
											<div class="agenda-event-content">'.$track["information"].'</div>
											</div>
										</div>';
									$trackCount++;
								}
								echo  '</div>';

							echo '</div></div></div>';








						}elseif($oldDate == $newDate && $multitrack ){
							$tracks = get_field('tracks',$postID);
							$terms = wp_get_post_terms( $postID, 'track' );

							if(count($tracks) > 1){
								$multiple = 'multiple';
							}else{
								$multiple = 'single';
							}
							echo '<div class="agenda-entry one-fourth floatleft workshop multiple '.$multiple.'"><div class="bgx">
									<div class="gutter">
									<h3>'.$post->post_title.'</h3>
									<p class="timeloc">'.$postTime.'</p>';

								echo '<div class="agenda-event-tracks">';
								$trackCount = 1;
								foreach($tracks as $track){

									echo '<div class="agenda-entry-track one-fourth floatleft" data-filter=" ';
									$trackTerms = $track['tracks_new'];
									if($trackTerms){
										foreach($trackTerms as $term){
											echo $term->slug.' ';
										}
									}

									echo '" data-filter=" ';

									if($trackTerms){
										foreach($trackTerms as $term){
											echo $term->slug.' ';
										}
									}
									echo '"><div class="gutter">';
									if($terms){
										foreach($terms as $term){
											echo '<span class="trackname">'.$term->name.'</span>';
										}
									}
									echo	'<h3>'.$track["title"].'</h3>
											<p><span class="loc">'.$track["location"].'</span></p>
											<div class="agenda-event-content">'.$track["information"].'</div>
											</div>
										</div>';
									$trackCount++;
								}
								echo  '</div>';

							echo '</div></div></div>';


						}else{
							echo '<div class="agenda-entry one-fourth floatleft">
									<div class="gutter">
									<h3>'.$post->post_title.'</h3>
									<p class="timeloc">'.$postTime.'<br><span class="loc">'.$postLoc.'</span></p>
									<div class="agenda-event-content">'.apply_filters("the_content", $post->post_content).'</div>
									</div>
								</div>';
						}
						$counter++;
					} wp_reset_query();
				?>
			</div>
		</div>
	</div>
</section>