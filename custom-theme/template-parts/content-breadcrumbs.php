<ul itemscope itemtype="https://schema.org/BreadcrumbList" style='list-style:none; display:flex; gap: 10px;'> <?php

	$i = 0;
	$id = get_the_ID();

	if ( get_post_parent($id) ) {	
		$ancestors = get_post_ancestors( $id );
		$ancestors = array_reverse( $ancestors );
		foreach( $ancestors as $ancestor ){ 
			$i++; ?>

			<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" style='list-style:none; display:flex; gap: 10px;'>
				<a itemprop="item" href="<?php echo get_permalink( $ancestor ); ?>">
					<span itemprop="name"><?php echo get_the_title( $ancestor ); ?> </span>
				</a>
				<meta itemprop="position" content="<?php echo $i; ?>" />
			</li> 
			<p> > </p>
		<?php } ?>

		<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" style='list-style:none; display:flex; gap: 10px;'>
			<a itemprop="item" href="<?php echo get_permalink( $id ); ?>">
				<span itemprop="name"><?php echo get_the_title( $id ); ?> </span>
			</a>
			<meta itemprop="position" content="<?php echo count( $ancestors ); ?>" />
		</li> <?php 
	}
?> </ul> <?php
