<?php
/**
 * Search form template
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="search-form__label" for="search-field">
        <span class="screen-reader-text">
            <?php echo esc_html( theme_translate( 'Search for:' ) ); ?>
        </span>
    </label>

    <input
        type="search"
        id="search-field"
        class="search-form__field"
        name="s"
        value="<?php echo esc_attr( get_search_query() ); ?>"
        placeholder="<?php echo esc_attr( theme_translate( 'Search...' ) ); ?>"
    >

    <button type="submit" class="search-form__submit">
        <?php echo esc_html( theme_translate( 'Search' ) ); ?>
    </button>
</form>