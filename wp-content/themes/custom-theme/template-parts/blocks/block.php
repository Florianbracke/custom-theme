<?php

/**
 * Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$question = get_field('question') ?: 'Your question here...';
$answer = get_field('answer') ?: 'Your answer here...';
$background_color = get_field('background_color');
$text_color = get_field('text_color');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <div class="inner-container">

        <span>
            <h3> <?php echo $question; ?></h3> 
            <span class='plus-min'> 
                <span class="one"></span> 
                <span class="two"></span>
            </span>
        </span>
    
        <p class='answer'> <?php echo $answer; ?> </p>

    </div>
</div>
