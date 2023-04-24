<ul itemscope itemtype="https://schema.org/BreadcrumbList" style='list-style:none; display:flex; gap: 10px;'> <?php

		$i = 0;
		$id = get_the_ID();

		if (get_post_parent($id) ){	
			$ancestors = get_post_ancestors($id);
			$ancestors = array_reverse($ancestors);
			foreach( $ancestors as $ancestor){ 
				$i++; ?>

				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" style='list-style:none; display:flex; gap: 10px;'>
					<a itemprop="item" href="<?php echo get_permalink($ancestor); ?>">
						<span itemprop="name"><?php echo $ancestor; ?> </span>
					</a>
					<meta itemprop="position" content="<?php echo $i; ?>" />
					<?php if ( $ancestors[$i]){ ?>
						<p> > </p>
					<?php } ?>
				</li> <?php 
			}
		}

	?> </ul> <?php
