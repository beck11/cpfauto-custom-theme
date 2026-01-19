# Vehicle Custom Fields Documentation

## Overview

This document details all the custom fields available for the Vehicle custom post type in the CPF Auto WordPress theme.

## Custom Post Type

- **Post Type Slug**: `vehicle`
- **Archive URL**: `/vehicles/`
- **Single URL**: `/vehicles/{slug}/`

## Taxonomies

### Vehicle Category
- **Slug**: `vehicle_category`
- **Type**: Hierarchical (like categories)
- **URL**: `/vehicle-category/{term}/`

### Vehicle Tags
- **Slug**: `vehicle_tag`
- **Type**: Non-hierarchical (like tags)
- **URL**: `/vehicle-tag/{term}/`

---

## Custom Fields

### Basic Vehicle Information

| Field Name | Meta Key | Type | Required | Description |
|------------|----------|------|----------|-------------|
| Make | `_vehicle_make` | Text | Yes | Vehicle manufacturer (e.g., Toyota, Ford, BMW) |
| Model | `_vehicle_model` | Text | Yes | Vehicle model name (e.g., Camry, Mustang, X5) |
| Year | `_vehicle_year` | Number | Yes | Model year (1900 - current year + 1) |
| Condition | `_vehicle_condition` | Select | Yes | Options: new, used, certified |
| Body Type | `_vehicle_body_type` | Select | No | Options: sedan, suv, truck, coupe, convertible, hatchback, wagon, van |
| VIN | `_vehicle_vin` | Text | No | Vehicle Identification Number (max 17 chars) |
| Stock Number | `_vehicle_stock_number` | Text | No | Internal inventory stock number |
| Status | `_vehicle_status` | Select | No | Options: available, sold, pending, reserved (default: available) |

### Pricing Information

| Field Name | Meta Key | Type | Required | Description |
|------------|----------|------|----------|-------------|
| Price | `_vehicle_price` | Number | Yes | Current selling price |
| Currency | `_vehicle_currency` | Select | No | Options: USD, EUR, GBP, CAD, AUD (default: USD) |
| Original Price | `_vehicle_original_price` | Number | No | Original/MSRP price for comparison |
| Sale Price | `_vehicle_sale_price` | Number | No | Special sale/promotional price |

### Technical Specifications

| Field Name | Meta Key | Type | Required | Description |
|------------|----------|------|----------|-------------|
| Mileage | `_vehicle_mileage` | Number | No | Odometer reading in miles/kilometers |
| Engine | `_vehicle_engine` | Text | No | Engine description (e.g., "2.5L 4-Cylinder") |
| Transmission | `_vehicle_transmission` | Select | No | Options: automatic, manual, cvt, semi-automatic |
| Drivetrain | `_vehicle_drivetrain` | Select | No | Options: fwd, rwd, awd, 4wd |
| Fuel Type | `_vehicle_fuel_type` | Select | No | Options: gasoline, diesel, hybrid, electric, plug-in-hybrid |
| Exterior Color | `_vehicle_exterior_color` | Text | No | Exterior paint color |
| Interior Color | `_vehicle_interior_color` | Text | No | Interior color/material |
| Doors | `_vehicle_doors` | Select | No | Options: 2, 3, 4, 5 |
| Seats | `_vehicle_seats` | Number | No | Number of passenger seats |
| MPG City | `_vehicle_mpg_city` | Number | No | City fuel economy |
| MPG Highway | `_vehicle_mpg_highway` | Number | No | Highway fuel economy |

### Features & Options

| Field Name | Meta Key | Type | Required | Description |
|------------|----------|------|----------|-------------|
| Features | `_vehicle_features` | Array | No | Checkboxes for standard features (see list below) |
| Custom Features | `_vehicle_custom_features` | Textarea | No | Additional features not in the standard list |

#### Standard Features List
- Air Conditioning
- Heated Seats
- Leather Seats
- Sunroof/Moonroof
- Navigation System
- Backup Camera
- Bluetooth
- Cruise Control
- Parking Sensors
- Blind Spot Monitor
- Lane Departure Warning
- Apple CarPlay
- Android Auto
- Premium Sound System
- Keyless Entry
- Push Button Start
- Power Windows
- Power Locks
- Alloy Wheels
- Tow Package

### Vehicle Gallery

| Field Name | Meta Key | Type | Required | Description |
|------------|----------|------|----------|-------------|
| Gallery | `_vehicle_gallery` | Text | No | Comma-separated attachment IDs for vehicle images |

### Contact Information

| Field Name | Meta Key | Type | Required | Description |
|------------|----------|------|----------|-------------|
| Contact Name | `_vehicle_contact_name` | Text | No | Sales representative name |
| Phone | `_vehicle_contact_phone` | Tel | No | Contact phone number |
| Email | `_vehicle_contact_email` | Email | No | Contact email address |
| Location | `_vehicle_location` | Text | No | Dealership location (City, State) |

---

## Helper Functions

### Retrieving Vehicle Data

```php
// Get any vehicle meta field
$value = cpfauto_get_vehicle_meta($post_id, 'make');
$value = cpfauto_get_vehicle_meta($post_id, 'year', '2024'); // with default

// Get formatted vehicle title
$title = cpfauto_get_vehicle_title($post_id); // Returns "2024 Toyota Camry"

// Get formatted price
$price = cpfauto_get_vehicle_price($post_id); // Returns "$29,999"
$price_raw = cpfauto_get_vehicle_price($post_id, false); // Returns 29999

// Get sale price (returns false if no sale price)
$sale_price = cpfauto_get_vehicle_sale_price($post_id);

// Check if vehicle is on sale
if (cpfauto_is_vehicle_on_sale($post_id)) {
    // Show sale badge
}

// Get discount percentage
$discount = cpfauto_get_vehicle_discount($post_id); // Returns 15 (for 15% off)

// Get status badge HTML
echo cpfauto_get_vehicle_status_badge($post_id);

// Get condition badge HTML
echo cpfauto_get_vehicle_condition_badge($post_id);

// Get formatted mileage
$mileage = cpfauto_get_formatted_mileage($post_id); // Returns "50,000 miles"

// Get features as array
$features = cpfauto_get_vehicle_features($post_id);

// Get features as formatted HTML list
echo cpfauto_get_vehicle_features($post_id, true);

// Get vehicle gallery
$gallery = cpfauto_get_vehicle_gallery($post_id);
foreach ($gallery as $image) {
    echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '">';
}

// Get specs table HTML
echo cpfauto_get_vehicle_specs_table($post_id);

// Get contact information
$contact = cpfauto_get_vehicle_contact($post_id);
echo $contact['name'];
echo $contact['phone'];
echo $contact['email'];
echo $contact['location'];

// Get related vehicles
$related = cpfauto_get_related_vehicles($post_id, 4);
if ($related && $related->have_posts()) {
    while ($related->have_posts()) {
        $related->the_post();
        // Display vehicle
    }
    wp_reset_postdata();
}
```

### Querying Vehicles

```php
// Basic vehicle query
$args = cpfauto_get_vehicle_query_args(array(
    'posts_per_page' => 12,
    'orderby' => 'date',
    'order' => 'DESC',
));
$vehicles = new WP_Query($args);

// Filter by make
$args = array(
    'post_type' => 'vehicle',
    'meta_query' => array(
        array(
            'key' => '_vehicle_make',
            'value' => 'Toyota',
            'compare' => '='
        )
    )
);
$vehicles = new WP_Query($args);

// Filter by price range
$args = array(
    'post_type' => 'vehicle',
    'meta_query' => array(
        array(
            'key' => '_vehicle_price',
            'value' => array(20000, 30000),
            'type' => 'NUMERIC',
            'compare' => 'BETWEEN'
        )
    )
);
$vehicles = new WP_Query($args);

// Filter by year
$args = array(
    'post_type' => 'vehicle',
    'meta_query' => array(
        array(
            'key' => '_vehicle_year',
            'value' => 2024,
            'type' => 'NUMERIC',
            'compare' => '='
        )
    )
);
$vehicles = new WP_Query($args);

// Multiple filters (AND condition)
$args = array(
    'post_type' => 'vehicle',
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => '_vehicle_make',
            'value' => 'Toyota',
            'compare' => '='
        ),
        array(
            'key' => '_vehicle_condition',
            'value' => 'new',
            'compare' => '='
        ),
        array(
            'key' => '_vehicle_price',
            'value' => 50000,
            'type' => 'NUMERIC',
            'compare' => '<='
        )
    )
);
$vehicles = new WP_Query($args);

// Sort by price (low to high)
$args = array(
    'post_type' => 'vehicle',
    'meta_key' => '_vehicle_price',
    'orderby' => 'meta_value_num',
    'order' => 'ASC'
);
$vehicles = new WP_Query($args);

// Sort by year (newest first)
$args = array(
    'post_type' => 'vehicle',
    'meta_key' => '_vehicle_year',
    'orderby' => 'meta_value_num',
    'order' => 'DESC'
);
$vehicles = new WP_Query($args);
```

---

## Template Files

### Single Vehicle
- **File**: `single-vehicle.php`
- **Purpose**: Display individual vehicle details
- **Features**:
  - Image gallery with thumbnails
  - Full specifications table
  - Features list
  - Contact form
  - Related vehicles section

### Vehicle Archive
- **File**: `archive-vehicle.php`
- **Purpose**: Display vehicle listings
- **Features**:
  - Advanced filtering (make, year, body type, price)
  - Search functionality
  - Multiple sort options
  - Grid/List view toggle
  - Pagination

### Vehicle Card Component
- **File**: `template-parts/content/card-vehicle.php`
- **Purpose**: Reusable vehicle card component
- **Usage**: `cpfauto_vehicle_card($post_id);`

---

## Admin Customization

### Custom Columns in Admin List

The vehicle post type admin list displays:
- Thumbnail image
- Vehicle info (Year Make Model, Mileage)
- Price
- Status badge

### Sortable Columns

Columns that can be sorted:
- Price
- Status

---

## Metadata Storage

All custom fields are stored as WordPress post meta with the prefix `_vehicle_`. The underscore prefix makes them hidden from the default custom fields UI.

Example in database:
```
post_id: 123
meta_key: _vehicle_make
meta_value: Toyota

post_id: 123
meta_key: _vehicle_model
meta_value: Camry
```

---

## Best Practices

1. **Always use helper functions** when retrieving vehicle data
2. **Escape output** when displaying data: `echo esc_html($value);`
3. **Check for empty values** before displaying
4. **Use proper nonces** when saving custom data
5. **Validate and sanitize** all input data

---

## Support & Updates

For questions or issues with the vehicle custom fields:
1. Check this documentation first
2. Review the helper functions in `/inc/vehicle-helpers.php`
3. Examine the meta boxes code in `/inc/vehicle-meta-boxes.php`

---

**Last Updated**: January 2026
**Theme Version**: 1.0.0
