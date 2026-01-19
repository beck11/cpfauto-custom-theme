<?php
/**
 * Vehicle Custom Fields (Meta Boxes)
 *
 * @package Cpfauto
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Vehicle Meta Boxes
 */
function cpfauto_add_vehicle_meta_boxes() {

    // Basic Vehicle Information
    add_meta_box(
        'cpfauto_vehicle_basic_info',
        __('Basic Vehicle Information', 'cpfauto'),
        'cpfauto_vehicle_basic_info_callback',
        'vehicle',
        'normal',
        'high'
    );

    // Pricing Information
    add_meta_box(
        'cpfauto_vehicle_pricing',
        __('Pricing Information', 'cpfauto'),
        'cpfauto_vehicle_pricing_callback',
        'vehicle',
        'normal',
        'high'
    );

    // Technical Specifications
    add_meta_box(
        'cpfauto_vehicle_specs',
        __('Technical Specifications', 'cpfauto'),
        'cpfauto_vehicle_specs_callback',
        'vehicle',
        'normal',
        'default'
    );

    // Features & Options
    add_meta_box(
        'cpfauto_vehicle_features',
        __('Features & Options', 'cpfauto'),
        'cpfauto_vehicle_features_callback',
        'vehicle',
        'normal',
        'default'
    );

    // Vehicle Gallery
    add_meta_box(
        'cpfauto_vehicle_gallery',
        __('Vehicle Gallery', 'cpfauto'),
        'cpfauto_vehicle_gallery_callback',
        'vehicle',
        'normal',
        'default'
    );

    // Contact Information
    add_meta_box(
        'cpfauto_vehicle_contact',
        __('Contact Information', 'cpfauto'),
        'cpfauto_vehicle_contact_callback',
        'vehicle',
        'side',
        'default'
    );

    // Featured Vehicle
    add_meta_box(
        'cpfauto_vehicle_featured',
        __('Featured Vehicle', 'cpfauto'),
        'cpfauto_vehicle_featured_callback',
        'vehicle',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'cpfauto_add_vehicle_meta_boxes');

/**
 * Basic Vehicle Information Callback
 */
function cpfauto_vehicle_basic_info_callback($post) {
    wp_nonce_field('cpfauto_vehicle_meta_box', 'cpfauto_vehicle_meta_box_nonce');

    $make = get_post_meta($post->ID, '_vehicle_make', true);
    $model = get_post_meta($post->ID, '_vehicle_model', true);
    $year = get_post_meta($post->ID, '_vehicle_year', true);
    $condition = get_post_meta($post->ID, '_vehicle_condition', true);
    $body_type = get_post_meta($post->ID, '_vehicle_body_type', true);
    $vin = get_post_meta($post->ID, '_vehicle_vin', true);
    $stock_number = get_post_meta($post->ID, '_vehicle_stock_number', true);
    $status = get_post_meta($post->ID, '_vehicle_status', true);
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
        <div>
            <label for="vehicle_make"><strong><?php _e('Make:', 'cpfauto'); ?> *</strong></label><br>
            <input type="text" id="vehicle_make" name="vehicle_make" value="<?php echo esc_attr($make); ?>"
                   style="width: 100%; margin-top: 5px;" placeholder="e.g., Toyota, Ford, BMW" required>
        </div>

        <div>
            <label for="vehicle_model"><strong><?php _e('Model:', 'cpfauto'); ?> *</strong></label><br>
            <input type="text" id="vehicle_model" name="vehicle_model" value="<?php echo esc_attr($model); ?>"
                   style="width: 100%; margin-top: 5px;" placeholder="e.g., Camry, Mustang, X5" required>
        </div>

        <div>
            <label for="vehicle_year"><strong><?php _e('Year:', 'cpfauto'); ?> *</strong></label><br>
            <input type="number" id="vehicle_year" name="vehicle_year" value="<?php echo esc_attr($year); ?>"
                   style="width: 100%; margin-top: 5px;" min="1900" max="<?php echo date('Y') + 1; ?>"
                   placeholder="<?php echo date('Y'); ?>" required>
        </div>

        <div>
            <label for="vehicle_condition"><strong><?php _e('Condition:', 'cpfauto'); ?> *</strong></label><br>
            <select id="vehicle_condition" name="vehicle_condition" style="width: 100%; margin-top: 5px;" required>
                <option value=""><?php _e('Select Condition', 'cpfauto'); ?></option>
                <option value="new" <?php selected($condition, 'new'); ?>><?php _e('New', 'cpfauto'); ?></option>
                <option value="used" <?php selected($condition, 'used'); ?>><?php _e('Used', 'cpfauto'); ?></option>
                <option value="certified" <?php selected($condition, 'certified'); ?>><?php _e('Certified Pre-Owned', 'cpfauto'); ?></option>
            </select>
        </div>

        <div>
            <label for="vehicle_body_type"><strong><?php _e('Body Type:', 'cpfauto'); ?></strong></label><br>
            <select id="vehicle_body_type" name="vehicle_body_type" style="width: 100%; margin-top: 5px;">
                <option value=""><?php _e('Select Body Type', 'cpfauto'); ?></option>
                <option value="sedan" <?php selected($body_type, 'sedan'); ?>><?php _e('Sedan', 'cpfauto'); ?></option>
                <option value="suv" <?php selected($body_type, 'suv'); ?>><?php _e('SUV', 'cpfauto'); ?></option>
                <option value="truck" <?php selected($body_type, 'truck'); ?>><?php _e('Truck', 'cpfauto'); ?></option>
                <option value="coupe" <?php selected($body_type, 'coupe'); ?>><?php _e('Coupe', 'cpfauto'); ?></option>
                <option value="convertible" <?php selected($body_type, 'convertible'); ?>><?php _e('Convertible', 'cpfauto'); ?></option>
                <option value="hatchback" <?php selected($body_type, 'hatchback'); ?>><?php _e('Hatchback', 'cpfauto'); ?></option>
                <option value="wagon" <?php selected($body_type, 'wagon'); ?>><?php _e('Wagon', 'cpfauto'); ?></option>
                <option value="van" <?php selected($body_type, 'van'); ?>><?php _e('Van/Minivan', 'cpfauto'); ?></option>
            </select>
        </div>

        <div>
            <label for="vehicle_vin"><strong><?php _e('VIN:', 'cpfauto'); ?></strong></label><br>
            <input type="text" id="vehicle_vin" name="vehicle_vin" value="<?php echo esc_attr($vin); ?>"
                   style="width: 100%; margin-top: 5px;" placeholder="Vehicle Identification Number" maxlength="17">
        </div>

        <div>
            <label for="vehicle_stock_number"><strong><?php _e('Stock Number:', 'cpfauto'); ?></strong></label><br>
            <input type="text" id="vehicle_stock_number" name="vehicle_stock_number" value="<?php echo esc_attr($stock_number); ?>"
                   style="width: 100%; margin-top: 5px;" placeholder="Internal stock number">
        </div>

        <div>
            <label for="vehicle_status"><strong><?php _e('Status:', 'cpfauto'); ?></strong></label><br>
            <select id="vehicle_status" name="vehicle_status" style="width: 100%; margin-top: 5px;">
                <option value="available" <?php selected($status, 'available'); ?>><?php _e('Available', 'cpfauto'); ?></option>
                <option value="sold" <?php selected($status, 'sold'); ?>><?php _e('Sold', 'cpfauto'); ?></option>
                <option value="pending" <?php selected($status, 'pending'); ?>><?php _e('Pending', 'cpfauto'); ?></option>
                <option value="reserved" <?php selected($status, 'reserved'); ?>><?php _e('Reserved', 'cpfauto'); ?></option>
            </select>
        </div>
    </div>
    <?php
}

/**
 * Pricing Information Callback
 */
function cpfauto_vehicle_pricing_callback($post) {
    $price = get_post_meta($post->ID, '_vehicle_price', true);
    $original_price = get_post_meta($post->ID, '_vehicle_original_price', true);
    $sale_price = get_post_meta($post->ID, '_vehicle_sale_price', true);
    $currency = get_post_meta($post->ID, '_vehicle_currency', true) ?: 'USD';
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
        <div>
            <label for="vehicle_price"><strong><?php _e('Price:', 'cpfauto'); ?> *</strong></label><br>
            <input type="number" id="vehicle_price" name="vehicle_price" value="<?php echo esc_attr($price); ?>"
                   style="width: 100%; margin-top: 5px;" min="0" step="0.01" placeholder="29999.99" required>
            <small><?php _e('Current selling price', 'cpfauto'); ?></small>
        </div>

        <div>
            <label for="vehicle_currency"><strong><?php _e('Currency:', 'cpfauto'); ?></strong></label><br>
            <select id="vehicle_currency" name="vehicle_currency" style="width: 100%; margin-top: 5px;">
                <option value="USD" <?php selected($currency, 'USD'); ?>>USD ($)</option>
                <option value="EUR" <?php selected($currency, 'EUR'); ?>>EUR (€)</option>
                <option value="GBP" <?php selected($currency, 'GBP'); ?>>GBP (£)</option>
                <option value="CAD" <?php selected($currency, 'CAD'); ?>>CAD ($)</option>
                <option value="AUD" <?php selected($currency, 'AUD'); ?>>AUD ($)</option>
            </select>
        </div>

        <div>
            <label for="vehicle_original_price"><strong><?php _e('Original Price:', 'cpfauto'); ?></strong></label><br>
            <input type="number" id="vehicle_original_price" name="vehicle_original_price"
                   value="<?php echo esc_attr($original_price); ?>"
                   style="width: 100%; margin-top: 5px;" min="0" step="0.01" placeholder="34999.99">
            <small><?php _e('Original/MSRP price (for comparison)', 'cpfauto'); ?></small>
        </div>

        <div>
            <label for="vehicle_sale_price"><strong><?php _e('Sale Price:', 'cpfauto'); ?></strong></label><br>
            <input type="number" id="vehicle_sale_price" name="vehicle_sale_price"
                   value="<?php echo esc_attr($sale_price); ?>"
                   style="width: 100%; margin-top: 5px;" min="0" step="0.01" placeholder="27999.99">
            <small><?php _e('Special sale price (optional)', 'cpfauto'); ?></small>
        </div>
    </div>
    <?php
}

/**
 * Technical Specifications Callback
 */
function cpfauto_vehicle_specs_callback($post) {
    $mileage = get_post_meta($post->ID, '_vehicle_mileage', true);
    $engine = get_post_meta($post->ID, '_vehicle_engine', true);
    $transmission = get_post_meta($post->ID, '_vehicle_transmission', true);
    $drivetrain = get_post_meta($post->ID, '_vehicle_drivetrain', true);
    $fuel_type = get_post_meta($post->ID, '_vehicle_fuel_type', true);
    $exterior_color = get_post_meta($post->ID, '_vehicle_exterior_color', true);
    $interior_color = get_post_meta($post->ID, '_vehicle_interior_color', true);
    $doors = get_post_meta($post->ID, '_vehicle_doors', true);
    $seats = get_post_meta($post->ID, '_vehicle_seats', true);
    $mpg_city = get_post_meta($post->ID, '_vehicle_mpg_city', true);
    $mpg_highway = get_post_meta($post->ID, '_vehicle_mpg_highway', true);
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
        <div>
            <label for="vehicle_mileage"><strong><?php _e('Mileage:', 'cpfauto'); ?></strong></label><br>
            <input type="number" id="vehicle_mileage" name="vehicle_mileage" value="<?php echo esc_attr($mileage); ?>"
                   style="width: 100%; margin-top: 5px;" min="0" placeholder="50000">
            <small><?php _e('Miles/Kilometers', 'cpfauto'); ?></small>
        </div>

        <div>
            <label for="vehicle_engine"><strong><?php _e('Engine:', 'cpfauto'); ?></strong></label><br>
            <input type="text" id="vehicle_engine" name="vehicle_engine" value="<?php echo esc_attr($engine); ?>"
                   style="width: 100%; margin-top: 5px;" placeholder="e.g., 2.5L 4-Cylinder">
        </div>

        <div>
            <label for="vehicle_transmission"><strong><?php _e('Transmission:', 'cpfauto'); ?></strong></label><br>
            <select id="vehicle_transmission" name="vehicle_transmission" style="width: 100%; margin-top: 5px;">
                <option value=""><?php _e('Select', 'cpfauto'); ?></option>
                <option value="automatic" <?php selected($transmission, 'automatic'); ?>><?php _e('Automatic', 'cpfauto'); ?></option>
                <option value="manual" <?php selected($transmission, 'manual'); ?>><?php _e('Manual', 'cpfauto'); ?></option>
                <option value="cvt" <?php selected($transmission, 'cvt'); ?>><?php _e('CVT', 'cpfauto'); ?></option>
                <option value="semi-automatic" <?php selected($transmission, 'semi-automatic'); ?>><?php _e('Semi-Automatic', 'cpfauto'); ?></option>
            </select>
        </div>

        <div>
            <label for="vehicle_drivetrain"><strong><?php _e('Drivetrain:', 'cpfauto'); ?></strong></label><br>
            <select id="vehicle_drivetrain" name="vehicle_drivetrain" style="width: 100%; margin-top: 5px;">
                <option value=""><?php _e('Select', 'cpfauto'); ?></option>
                <option value="fwd" <?php selected($drivetrain, 'fwd'); ?>><?php _e('FWD', 'cpfauto'); ?></option>
                <option value="rwd" <?php selected($drivetrain, 'rwd'); ?>><?php _e('RWD', 'cpfauto'); ?></option>
                <option value="awd" <?php selected($drivetrain, 'awd'); ?>><?php _e('AWD', 'cpfauto'); ?></option>
                <option value="4wd" <?php selected($drivetrain, '4wd'); ?>><?php _e('4WD', 'cpfauto'); ?></option>
            </select>
        </div>

        <div>
            <label for="vehicle_fuel_type"><strong><?php _e('Fuel Type:', 'cpfauto'); ?></strong></label><br>
            <select id="vehicle_fuel_type" name="vehicle_fuel_type" style="width: 100%; margin-top: 5px;">
                <option value=""><?php _e('Select', 'cpfauto'); ?></option>
                <option value="gasoline" <?php selected($fuel_type, 'gasoline'); ?>><?php _e('Gasoline', 'cpfauto'); ?></option>
                <option value="diesel" <?php selected($fuel_type, 'diesel'); ?>><?php _e('Diesel', 'cpfauto'); ?></option>
                <option value="hybrid" <?php selected($fuel_type, 'hybrid'); ?>><?php _e('Hybrid', 'cpfauto'); ?></option>
                <option value="electric" <?php selected($fuel_type, 'electric'); ?>><?php _e('Electric', 'cpfauto'); ?></option>
                <option value="plug-in-hybrid" <?php selected($fuel_type, 'plug-in-hybrid'); ?>><?php _e('Plug-in Hybrid', 'cpfauto'); ?></option>
            </select>
        </div>

        <div>
            <label for="vehicle_exterior_color"><strong><?php _e('Exterior Color:', 'cpfauto'); ?></strong></label><br>
            <input type="text" id="vehicle_exterior_color" name="vehicle_exterior_color"
                   value="<?php echo esc_attr($exterior_color); ?>"
                   style="width: 100%; margin-top: 5px;" placeholder="e.g., Pearl White">
        </div>

        <div>
            <label for="vehicle_interior_color"><strong><?php _e('Interior Color:', 'cpfauto'); ?></strong></label><br>
            <input type="text" id="vehicle_interior_color" name="vehicle_interior_color"
                   value="<?php echo esc_attr($interior_color); ?>"
                   style="width: 100%; margin-top: 5px;" placeholder="e.g., Black Leather">
        </div>

        <div>
            <label for="vehicle_doors"><strong><?php _e('Doors:', 'cpfauto'); ?></strong></label><br>
            <select id="vehicle_doors" name="vehicle_doors" style="width: 100%; margin-top: 5px;">
                <option value=""><?php _e('Select', 'cpfauto'); ?></option>
                <option value="2" <?php selected($doors, '2'); ?>>2</option>
                <option value="3" <?php selected($doors, '3'); ?>>3</option>
                <option value="4" <?php selected($doors, '4'); ?>>4</option>
                <option value="5" <?php selected($doors, '5'); ?>>5</option>
            </select>
        </div>

        <div>
            <label for="vehicle_seats"><strong><?php _e('Seats:', 'cpfauto'); ?></strong></label><br>
            <input type="number" id="vehicle_seats" name="vehicle_seats" value="<?php echo esc_attr($seats); ?>"
                   style="width: 100%; margin-top: 5px;" min="1" max="15" placeholder="5">
        </div>

        <div>
            <label for="vehicle_mpg_city"><strong><?php _e('MPG City:', 'cpfauto'); ?></strong></label><br>
            <input type="number" id="vehicle_mpg_city" name="vehicle_mpg_city" value="<?php echo esc_attr($mpg_city); ?>"
                   style="width: 100%; margin-top: 5px;" min="0" step="0.1" placeholder="25">
        </div>

        <div>
            <label for="vehicle_mpg_highway"><strong><?php _e('MPG Highway:', 'cpfauto'); ?></strong></label><br>
            <input type="number" id="vehicle_mpg_highway" name="vehicle_mpg_highway"
                   value="<?php echo esc_attr($mpg_highway); ?>"
                   style="width: 100%; margin-top: 5px;" min="0" step="0.1" placeholder="32">
        </div>
    </div>
    <?php
}

/**
 * Features & Options Callback
 */
function cpfauto_vehicle_features_callback($post) {
    $features = get_post_meta($post->ID, '_vehicle_features', true);
    $features = is_array($features) ? $features : array();

    $available_features = array(
        'Air Conditioning' => 'air_conditioning',
        'Heated Seats' => 'heated_seats',
        'Leather Seats' => 'leather_seats',
        'Sunroof/Moonroof' => 'sunroof',
        'Navigation System' => 'navigation',
        'Backup Camera' => 'backup_camera',
        'Bluetooth' => 'bluetooth',
        'Cruise Control' => 'cruise_control',
        'Parking Sensors' => 'parking_sensors',
        'Blind Spot Monitor' => 'blind_spot',
        'Lane Departure Warning' => 'lane_departure',
        'Apple CarPlay' => 'apple_carplay',
        'Android Auto' => 'android_auto',
        'Premium Sound System' => 'premium_sound',
        'Keyless Entry' => 'keyless_entry',
        'Push Button Start' => 'push_start',
        'Power Windows' => 'power_windows',
        'Power Locks' => 'power_locks',
        'Alloy Wheels' => 'alloy_wheels',
        'Tow Package' => 'tow_package',
    );
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px;">
        <?php foreach ($available_features as $label => $value) : ?>
            <label style="display: flex; align-items: center;">
                <input type="checkbox" name="vehicle_features[]" value="<?php echo esc_attr($value); ?>"
                       <?php checked(in_array($value, $features)); ?> style="margin-right: 8px;">
                <?php echo esc_html($label); ?>
            </label>
        <?php endforeach; ?>
    </div>

    <div style="margin-top: 20px;">
        <label for="vehicle_custom_features"><strong><?php _e('Additional Features:', 'cpfauto'); ?></strong></label><br>
        <textarea id="vehicle_custom_features" name="vehicle_custom_features" rows="3" style="width: 100%; margin-top: 5px;"
                  placeholder="Enter any additional features not listed above, one per line"><?php echo esc_textarea(get_post_meta($post->ID, '_vehicle_custom_features', true)); ?></textarea>
    </div>
    <?php
}

/**
 * Vehicle Gallery Callback
 */
function cpfauto_vehicle_gallery_callback($post) {
    $gallery_ids = get_post_meta($post->ID, '_vehicle_gallery', true);
    ?>
    <div>
        <input type="hidden" id="vehicle_gallery" name="vehicle_gallery" value="<?php echo esc_attr($gallery_ids); ?>">
        <button type="button" class="button" id="upload_gallery_button">
            <?php _e('Add Images to Gallery', 'cpfauto'); ?>
        </button>
        <button type="button" class="button" id="clear_gallery_button">
            <?php _e('Clear Gallery', 'cpfauto'); ?>
        </button>

        <div id="gallery_preview" style="margin-top: 15px; display: flex; flex-wrap: wrap; gap: 10px;">
            <?php
            if ($gallery_ids) {
                $ids = explode(',', $gallery_ids);
                foreach ($ids as $id) {
                    $image = wp_get_attachment_image_src($id, 'thumbnail');
                    if ($image) {
                        echo '<div class="gallery-image" style="position: relative;">
                                <img src="' . esc_url($image[0]) . '" style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #ddd; border-radius: 4px;">
                                <span class="remove-image" data-id="' . esc_attr($id) . '" style="position: absolute; top: -5px; right: -5px; background: #dc3545; color: white; border-radius: 50%; width: 20px; height: 20px; text-align: center; cursor: pointer; line-height: 20px;">×</span>
                              </div>';
                    }
                }
            }
            ?>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        var frame;
        var galleryIds = $('#vehicle_gallery').val() ? $('#vehicle_gallery').val().split(',') : [];

        $('#upload_gallery_button').on('click', function(e) {
            e.preventDefault();

            if (frame) {
                frame.open();
                return;
            }

            frame = wp.media({
                title: '<?php _e('Select or Upload Vehicle Images', 'cpfauto'); ?>',
                button: {
                    text: '<?php _e('Add to Gallery', 'cpfauto'); ?>'
                },
                multiple: true
            });

            frame.on('select', function() {
                var attachments = frame.state().get('selection').toJSON();

                attachments.forEach(function(attachment) {
                    if (galleryIds.indexOf(attachment.id.toString()) === -1) {
                        galleryIds.push(attachment.id);

                        var img = '<div class="gallery-image" style="position: relative;">';
                        img += '<img src="' + attachment.sizes.thumbnail.url + '" style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #ddd; border-radius: 4px;">';
                        img += '<span class="remove-image" data-id="' + attachment.id + '" style="position: absolute; top: -5px; right: -5px; background: #dc3545; color: white; border-radius: 50%; width: 20px; height: 20px; text-align: center; cursor: pointer; line-height: 20px;">×</span>';
                        img += '</div>';

                        $('#gallery_preview').append(img);
                    }
                });

                $('#vehicle_gallery').val(galleryIds.join(','));
            });

            frame.open();
        });

        $('#clear_gallery_button').on('click', function(e) {
            e.preventDefault();
            galleryIds = [];
            $('#vehicle_gallery').val('');
            $('#gallery_preview').empty();
        });

        $(document).on('click', '.remove-image', function() {
            var id = $(this).data('id').toString();
            galleryIds = galleryIds.filter(function(item) { return item !== id; });
            $('#vehicle_gallery').val(galleryIds.join(','));
            $(this).parent().remove();
        });
    });
    </script>
    <?php
}

/**
 * Contact Information Callback
 */
function cpfauto_vehicle_contact_callback($post) {
    $contact_name = get_post_meta($post->ID, '_vehicle_contact_name', true);
    $contact_phone = get_post_meta($post->ID, '_vehicle_contact_phone', true);
    $contact_email = get_post_meta($post->ID, '_vehicle_contact_email', true);
    $location = get_post_meta($post->ID, '_vehicle_location', true);
    ?>
    <div>
        <p>
            <label for="vehicle_contact_name"><strong><?php _e('Contact Name:', 'cpfauto'); ?></strong></label><br>
            <input type="text" id="vehicle_contact_name" name="vehicle_contact_name"
                   value="<?php echo esc_attr($contact_name); ?>" style="width: 100%;"
                   placeholder="Sales Representative">
        </p>

        <p>
            <label for="vehicle_contact_phone"><strong><?php _e('Phone:', 'cpfauto'); ?></strong></label><br>
            <input type="tel" id="vehicle_contact_phone" name="vehicle_contact_phone"
                   value="<?php echo esc_attr($contact_phone); ?>" style="width: 100%;"
                   placeholder="(555) 123-4567">
        </p>

        <p>
            <label for="vehicle_contact_email"><strong><?php _e('Email:', 'cpfauto'); ?></strong></label><br>
            <input type="email" id="vehicle_contact_email" name="vehicle_contact_email"
                   value="<?php echo esc_attr($contact_email); ?>" style="width: 100%;"
                   placeholder="sales@example.com">
        </p>

        <p>
            <label for="vehicle_location"><strong><?php _e('Location:', 'cpfauto'); ?></strong></label><br>
            <input type="text" id="vehicle_location" name="vehicle_location"
                   value="<?php echo esc_attr($location); ?>" style="width: 100%;"
                   placeholder="City, State">
        </p>
    </div>
    <?php
}

/**
 * Featured Vehicle Callback
 */
function cpfauto_vehicle_featured_callback($post) {
    $featured = get_post_meta($post->ID, '_vehicle_featured', true);
    ?>
    <div>
        <label style="display: flex; align-items: center; cursor: pointer;">
            <input type="checkbox" name="vehicle_featured" value="yes" <?php checked($featured, 'yes'); ?> style="margin-right: 8px;">
            <strong><?php _e('Mark as Featured Vehicle', 'cpfauto'); ?></strong>
        </label>
        <p class="description" style="margin-top: 10px;">
            <?php _e('Featured vehicles will appear in the "Featured Vehicles" section on the homepage.', 'cpfauto'); ?>
        </p>
    </div>
    <?php
}

/**
 * Save Vehicle Meta Box Data
 */
function cpfauto_save_vehicle_meta_box_data($post_id) {
    // Check if nonce is set
    if (!isset($_POST['cpfauto_vehicle_meta_box_nonce'])) {
        return;
    }

    // Verify nonce
    if (!wp_verify_nonce($_POST['cpfauto_vehicle_meta_box_nonce'], 'cpfauto_vehicle_meta_box')) {
        return;
    }

    // Check if autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Define all fields to save
    $fields = array(
        // Basic Info
        'vehicle_make',
        'vehicle_model',
        'vehicle_year',
        'vehicle_condition',
        'vehicle_body_type',
        'vehicle_vin',
        'vehicle_stock_number',
        'vehicle_status',
        // Pricing
        'vehicle_price',
        'vehicle_original_price',
        'vehicle_sale_price',
        'vehicle_currency',
        // Specs
        'vehicle_mileage',
        'vehicle_engine',
        'vehicle_transmission',
        'vehicle_drivetrain',
        'vehicle_fuel_type',
        'vehicle_exterior_color',
        'vehicle_interior_color',
        'vehicle_doors',
        'vehicle_seats',
        'vehicle_mpg_city',
        'vehicle_mpg_highway',
        // Features
        'vehicle_custom_features',
        // Gallery
        'vehicle_gallery',
        // Contact
        'vehicle_contact_name',
        'vehicle_contact_phone',
        'vehicle_contact_email',
        'vehicle_location',
    );

    // Save each field
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }

    // Save featured checkbox
    if (isset($_POST['vehicle_featured']) && $_POST['vehicle_featured'] === 'yes') {
        update_post_meta($post_id, '_vehicle_featured', 'yes');
    } else {
        delete_post_meta($post_id, '_vehicle_featured');
    }

    // Save features (checkbox array)
    if (isset($_POST['vehicle_features'])) {
        $features = array_map('sanitize_text_field', $_POST['vehicle_features']);
        update_post_meta($post_id, '_vehicle_features', $features);
    } else {
        delete_post_meta($post_id, '_vehicle_features');
    }
}
add_action('save_post_vehicle', 'cpfauto_save_vehicle_meta_box_data');

/**
 * Add custom columns to Vehicle admin list
 */
function cpfauto_vehicle_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['thumbnail'] = __('Image', 'cpfauto');
    $new_columns['title'] = $columns['title'];
    $new_columns['vehicle_info'] = __('Vehicle Info', 'cpfauto');
    $new_columns['price'] = __('Price', 'cpfauto');
    $new_columns['status'] = __('Status', 'cpfauto');
    $new_columns['date'] = $columns['date'];

    return $new_columns;
}
add_filter('manage_vehicle_posts_columns', 'cpfauto_vehicle_columns');

/**
 * Display custom column content
 */
function cpfauto_vehicle_column_content($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(60, 60));
            } else {
                echo '<span style="color: #999;">—</span>';
            }
            break;

        case 'vehicle_info':
            $year = get_post_meta($post_id, '_vehicle_year', true);
            $make = get_post_meta($post_id, '_vehicle_make', true);
            $model = get_post_meta($post_id, '_vehicle_model', true);
            $mileage = get_post_meta($post_id, '_vehicle_mileage', true);

            echo '<strong>' . esc_html($year . ' ' . $make . ' ' . $model) . '</strong><br>';
            if ($mileage) {
                echo '<small>' . number_format($mileage) . ' miles</small>';
            }
            break;

        case 'price':
            $price = get_post_meta($post_id, '_vehicle_price', true);
            $currency = get_post_meta($post_id, '_vehicle_currency', true) ?: 'USD';

            if ($price) {
                $symbols = array('USD' => '$', 'EUR' => '€', 'GBP' => '£', 'CAD' => '$', 'AUD' => '$');
                $symbol = isset($symbols[$currency]) ? $symbols[$currency] : '$';
                echo '<strong style="color: #2271b1;">' . $symbol . number_format($price, 2) . '</strong>';
            } else {
                echo '<span style="color: #999;">—</span>';
            }
            break;

        case 'status':
            $status = get_post_meta($post_id, '_vehicle_status', true) ?: 'available';
            $status_colors = array(
                'available' => '#10B981',
                'sold' => '#EF4444',
                'pending' => '#F59E0B',
                'reserved' => '#3B82F6',
            );
            $color = isset($status_colors[$status]) ? $status_colors[$status] : '#999';
            echo '<span style="display: inline-block; padding: 4px 8px; background: ' . $color . '; color: white; border-radius: 4px; font-size: 11px; text-transform: uppercase;">' . esc_html($status) . '</span>';
            break;
    }
}
add_action('manage_vehicle_posts_custom_column', 'cpfauto_vehicle_column_content', 10, 2);

/**
 * Make custom columns sortable
 */
function cpfauto_vehicle_sortable_columns($columns) {
    $columns['price'] = 'price';
    $columns['status'] = 'status';
    return $columns;
}
add_filter('manage_edit-vehicle_sortable_columns', 'cpfauto_vehicle_sortable_columns');
