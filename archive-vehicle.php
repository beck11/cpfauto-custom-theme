<?php
/**
 * Archive Vehicle Template
 *
 * @package Cpfauto
 */

get_header();
?>

<main id="main-content" class="site-main">

    <!-- Page Header -->
    <?php
    $header_bg_start = get_theme_mod('cpfauto_vehicle_archive_header_bg', '#15153f');
    $header_bg_end = get_theme_mod('cpfauto_vehicle_archive_header_bg_end', '#090924');
    $header_bg_style = 'background: linear-gradient(to right, ' . esc_attr($header_bg_start) . ', ' . esc_attr($header_bg_end) . ');';
    $heading_color = get_theme_mod('cpfauto_vehicle_archive_heading_color', '#ffffff');
    $heading_style = 'color: ' . esc_attr($heading_color) . ';';
    ?>
    <div class="text-white py-12 md:py-16" style="<?php echo esc_attr($header_bg_style); ?>">
        <div class="container-custom">
            <div class="text-center animate-fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4" style="<?php echo esc_attr($heading_style); ?>">
                    <?php
                    if (is_post_type_archive()) {
                        post_type_archive_title();
                    } elseif (is_tax('vehicle_category')) {
                        single_term_title();
                    } elseif (is_tax('vehicle_tag')) {
                        single_term_title();
                    } else {
                        _e('Browse Our Inventory', 'cpfauto');
                    }
                    ?>
                </h1>

                <?php if (term_description()) : ?>
                    <div class="text-lg text-white/90 max-w-2xl mx-auto">
                        <?php echo term_description(); ?>
                    </div>
                <?php else : ?>
                    <p class="text-lg text-white/90 max-w-2xl mx-auto">
                        <?php echo esc_html(get_theme_mod('cpfauto_vehicle_archive_description', __('Explore our wide selection of quality vehicles. Find your perfect car today!', 'cpfauto'))); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white shadow-md sticky top-0 z-40 border-b border-gray-200">
        <div class="container-custom py-4">
            <form method="get" id="vehicle-filters" class="flex flex-wrap items-end gap-4">

                <!-- Search -->
                <div class="flex-1 min-w-[200px]">
                    <label for="search_query" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php _e('Search', 'cpfauto'); ?>
                    </label>
                    <input type="text" id="search_query" name="s"
                           value="<?php echo get_search_query(); ?>"
                           placeholder="<?php esc_attr_e('Search vehicles...', 'cpfauto'); ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>

                <!-- Make -->
                <div class="flex-1 min-w-[150px]">
                    <label for="filter_make" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php _e('Make', 'cpfauto'); ?>
                    </label>
                    <select id="filter_make" name="make" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
                        <option value=""><?php _e('All Makes', 'cpfauto'); ?></option>
                        <?php
                        global $wpdb;
                        $makes = $wpdb->get_col("SELECT DISTINCT meta_value FROM {$wpdb->postmeta} WHERE meta_key = '_vehicle_make' ORDER BY meta_value ASC");
                        foreach ($makes as $make) :
                            if (!empty($make)) :
                        ?>
                            <option value="<?php echo esc_attr($make); ?>" <?php selected(isset($_GET['make']) ? $_GET['make'] : '', $make); ?>>
                                <?php echo esc_html($make); ?>
                            </option>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </select>
                </div>

                <!-- Year -->
                <div class="flex-1 min-w-[120px]">
                    <label for="filter_year" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php _e('Year', 'cpfauto'); ?>
                    </label>
                    <select id="filter_year" name="year" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
                        <option value=""><?php _e('All Years', 'cpfauto'); ?></option>
                        <?php
                        for ($year = date('Y') + 1; $year >= 2000; $year--) :
                        ?>
                            <option value="<?php echo $year; ?>" <?php selected(isset($_GET['year']) ? $_GET['year'] : '', $year); ?>>
                                <?php echo $year; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <!-- Body Type -->
                <div class="flex-1 min-w-[150px]">
                    <label for="filter_body_type" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php _e('Body Type', 'cpfauto'); ?>
                    </label>
                    <select id="filter_body_type" name="body_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
                        <option value=""><?php _e('All Types', 'cpfauto'); ?></option>
                        <?php
                        $body_types = array('sedan', 'suv', 'truck', 'coupe', 'convertible', 'hatchback', 'wagon', 'van');
                        foreach ($body_types as $type) :
                        ?>
                            <option value="<?php echo esc_attr($type); ?>" <?php selected(isset($_GET['body_type']) ? $_GET['body_type'] : '', $type); ?>>
                                <?php echo esc_html(ucwords($type)); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Price Range -->
                <div class="flex-1 min-w-[150px]">
                    <label for="filter_max_price" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php _e('Max Price', 'cpfauto'); ?>
                    </label>
                    <select id="filter_max_price" name="max_price" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
                        <option value=""><?php _e('Any Price', 'cpfauto'); ?></option>
                        <option value="10000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '10000'); ?>>$10,000</option>
                        <option value="20000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '20000'); ?>>$20,000</option>
                        <option value="30000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '30000'); ?>>$30,000</option>
                        <option value="50000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '50000'); ?>>$50,000</option>
                        <option value="75000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '75000'); ?>>$75,000</option>
                        <option value="100000" <?php selected(isset($_GET['max_price']) ? $_GET['max_price'] : '', '100000'); ?>>$100,000</option>
                    </select>
                </div>

                <!-- Sort By -->
                <div class="flex-1 min-w-[150px]">
                    <label for="filter_sort" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php _e('Sort By', 'cpfauto'); ?>
                    </label>
                    <select id="filter_sort" name="orderby" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
                        <option value="date" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'date'); ?>><?php _e('Newest First', 'cpfauto'); ?></option>
                        <option value="price_asc" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'price_asc'); ?>><?php _e('Price: Low to High', 'cpfauto'); ?></option>
                        <option value="price_desc" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'price_desc'); ?>><?php _e('Price: High to Low', 'cpfauto'); ?></option>
                        <option value="year" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'year'); ?>><?php _e('Year: Newest', 'cpfauto'); ?></option>
                        <option value="mileage" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'mileage'); ?>><?php _e('Mileage: Lowest', 'cpfauto'); ?></option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex gap-2">
                    <button type="submit" class="btn-primary px-6 py-2">
                        <?php _e('Filter', 'cpfauto'); ?>
                    </button>
                    <a href="<?php echo get_post_type_archive_link('vehicle'); ?>" class="btn-secondary px-6 py-2">
                        <?php _e('Reset', 'cpfauto'); ?>
                    </a>
                </div>

            </form>
        </div>
    </div>

    <!-- Results Section -->
    <div class="container-custom py-8 md:py-16">

        <?php if (have_posts()) : ?>

            <!-- Results Count -->
            <div class="flex items-center justify-between mb-6 animate-fade-in">
                <p class="text-gray-600">
                    <?php
                    global $wp_query;
                    $total = $wp_query->found_posts;
                    printf(
                        _n('%s vehicle found', '%s vehicles found', $total, 'cpfauto'),
                        '<strong>' . number_format($total) . '</strong>'
                    );
                    ?>
                </p>

                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-600"><?php _e('View:', 'cpfauto'); ?></span>
                    <button type="button" id="view-grid" class="p-2 text-gray-600 hover:text-primary transition-colors" title="<?php esc_attr_e('Grid View', 'cpfauto'); ?>">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                    </button>
                    <button type="button" id="view-list" class="p-2 text-gray-600 hover:text-primary transition-colors" title="<?php esc_attr_e('List View', 'cpfauto'); ?>">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Vehicle Grid -->
            <div id="vehicles-container" class="vehicles-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-stagger">
                <?php
                while (have_posts()) :
                    the_post();
                    cpfauto_vehicle_card(get_post());
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12 animate-fade-in">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('&laquo; Previous', 'cpfauto'),
                    'next_text' => __('Next &raquo;', 'cpfauto'),
                    'class'     => 'flex justify-center gap-2',
                ));
                ?>
            </div>

        <?php else : ?>

            <!-- No Results -->
            <div class="text-center py-16 animate-fade-in">
                <div class="max-w-md mx-auto">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>

                    <h2 class="text-2xl font-heading font-bold text-gray-900 mb-4">
                        <?php _e('No Vehicles Found', 'cpfauto'); ?>
                    </h2>

                    <p class="text-gray-600 mb-6">
                        <?php _e('We couldn\'t find any vehicles matching your criteria. Please try adjusting your filters or search terms.', 'cpfauto'); ?>
                    </p>

                    <a href="<?php echo get_post_type_archive_link('vehicle'); ?>" class="btn-primary">
                        <?php _e('View All Vehicles', 'cpfauto'); ?>
                    </a>
                </div>
            </div>

        <?php endif; ?>

    </div>

</main>

<script>
// View toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('vehicles-container');
    const gridBtn = document.getElementById('view-grid');
    const listBtn = document.getElementById('view-list');

    if (container && gridBtn && listBtn) {
        gridBtn.addEventListener('click', function() {
            container.className = 'vehicles-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6';
            this.classList.add('text-primary');
            listBtn.classList.remove('text-primary');
        });

        listBtn.addEventListener('click', function() {
            container.className = 'vehicles-list space-y-6';
            this.classList.add('text-primary');
            gridBtn.classList.remove('text-primary');
        });
    }
});
</script>

<?php get_footer(); ?>
