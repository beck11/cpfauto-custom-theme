# CPF Auto Theme - Vehicle Custom Fields Setup

## ✅ Installation Complete!

All vehicle custom fields and functionality have been successfully added to your CPF Auto WordPress theme.

---

## 🚀 Quick Start Guide

### Step 1: Flush Rewrite Rules (IMPORTANT!)

After activating the theme or adding new custom post types, you **must** flush the rewrite rules:

1. Go to WordPress Admin Dashboard
2. Navigate to **Settings > Permalinks**
3. Simply click the **"Save Changes"** button (no need to change anything)
4. This ensures the vehicle URLs work correctly (`/vehicles/`, `/vehicles/your-car/`)

### Step 2: Add Your First Vehicle

1. Go to **Vehicles > Add New** in the WordPress admin
2. Fill in the vehicle information:
   - **Title**: Will be auto-generated from Year + Make + Model
   - **Content**: Vehicle description (optional)
   - **Featured Image**: Main vehicle photo

3. Fill in the custom fields:
   - **Basic Info**: Make, Model, Year, Condition (Required)
   - **Pricing**: Set the price (Required)
   - **Specifications**: Mileage, Engine, Transmission, etc.
   - **Features**: Check applicable features
   - **Gallery**: Upload multiple vehicle photos
   - **Contact**: Add sales contact information

4. Click **Publish**

### Step 3: View Your Vehicle

Visit these URLs to see your vehicles:
- **All Vehicles**: `yoursite.com/vehicles/`
- **Single Vehicle**: `yoursite.com/vehicles/your-vehicle-slug/`

---

## 📁 Files Added/Modified

### New Files Created:

1. **`/inc/post-types.php`**
   - Registers Vehicle custom post type
   - Registers Vehicle Categories taxonomy
   - Registers Vehicle Tags taxonomy

2. **`/inc/vehicle-meta-boxes.php`**
   - All custom fields for vehicles
   - Admin interface for entering vehicle data
   - Custom columns in vehicle admin list

3. **`/inc/vehicle-helpers.php`**
   - Helper functions to retrieve vehicle data
   - Query functions for filtering vehicles
   - Formatting functions (price, mileage, etc.)

4. **`/inc/admin-notices.php`**
   - Admin dashboard vehicle statistics widget
   - Helpful admin notices

5. **`single-vehicle.php`**
   - Template for displaying single vehicles
   - Includes gallery, specs table, features, contact form

6. **`archive-vehicle.php`**
   - Template for vehicle listings/archive
   - Includes filters (make, year, price, etc.)
   - Grid/List view toggle

7. **`VEHICLE-CUSTOM-FIELDS.md`**
   - Complete documentation of all fields
   - Helper function reference
   - Query examples

### Modified Files:

1. **`functions.php`**
   - Added includes for all new files

---

## 🎨 Custom Fields Available

### Basic Information
- Make (Toyota, Ford, BMW, etc.)
- Model (Camry, Mustang, X5, etc.)
- Year (2000 - 2026)
- Condition (New, Used, Certified Pre-Owned)
- Body Type (Sedan, SUV, Truck, etc.)
- VIN
- Stock Number
- Status (Available, Sold, Pending, Reserved)

### Pricing
- Price (Required)
- Currency (USD, EUR, GBP, CAD, AUD)
- Original Price (for showing discounts)
- Sale Price (optional promotional price)

### Technical Specs
- Mileage
- Engine (e.g., "2.5L 4-Cylinder")
- Transmission (Automatic, Manual, CVT)
- Drivetrain (FWD, RWD, AWD, 4WD)
- Fuel Type (Gasoline, Diesel, Hybrid, Electric)
- Exterior/Interior Color
- Doors & Seats
- MPG (City & Highway)

### Features (20+ Options)
- Air Conditioning
- Heated Seats
- Leather Seats
- Sunroof
- Navigation
- Backup Camera
- Bluetooth
- Apple CarPlay/Android Auto
- And many more...

### Media
- Featured Image (main photo)
- Vehicle Gallery (multiple images)

### Contact Info
- Contact Name
- Phone Number
- Email Address
- Location

---

## 💡 Using Helper Functions

### Display Vehicle Title
```php
echo cpfauto_get_vehicle_title(); // "2024 Toyota Camry"
```

### Display Price
```php
echo cpfauto_get_vehicle_price(); // "$29,999"
```

### Display Features List
```php
echo cpfauto_get_vehicle_features($post_id, true); // HTML list
```

### Display Specs Table
```php
echo cpfauto_get_vehicle_specs_table(); // Full specs table
```

### Query Vehicles
```php
$args = array(
    'post_type' => 'vehicle',
    'meta_query' => array(
        array(
            'key' => '_vehicle_make',
            'value' => 'Toyota'
        )
    )
);
$vehicles = new WP_Query($args);
```

For complete documentation, see **[VEHICLE-CUSTOM-FIELDS.md](VEHICLE-CUSTOM-FIELDS.md)**

---

## 🎯 Admin Features

### Dashboard Widget
A new widget on the WordPress dashboard shows:
- Total Vehicles
- Available Vehicles
- Sold Vehicles
- Pending Vehicles

### Custom Admin Columns
The vehicle list in admin shows:
- Thumbnail image
- Vehicle info (Year Make Model)
- Mileage
- Price
- Status badge

### Easy Navigation
Quick links to:
- View all vehicles
- Add new vehicle
- Manage categories/tags

---

## 🔧 Customization Tips

### Change Available Features
Edit the `$available_features` array in `/inc/vehicle-meta-boxes.php` (line ~401)

### Modify Admin Columns
Edit functions in `/inc/vehicle-meta-boxes.php`:
- `cpfauto_vehicle_columns()` - Define columns
- `cpfauto_vehicle_column_content()` - Display content

### Customize Templates
- **Single Vehicle**: Edit `single-vehicle.php`
- **Vehicle Archive**: Edit `archive-vehicle.php`
- **Vehicle Card**: Edit `template-parts/content/card-vehicle.php`

### Add New Fields
1. Add field in meta box callback (e.g., `cpfauto_vehicle_basic_info_callback()`)
2. Add field to save function (`cpfauto_save_vehicle_meta_box_data()`)
3. Create helper function in `vehicle-helpers.php`

---

## 📝 Best Practices

1. **Always set Featured Image** - Used as thumbnail in listings
2. **Add multiple gallery images** - Better presentation
3. **Fill in all specs** - Helps with filtering/search
4. **Use descriptive titles** - Auto-generated from Year/Make/Model
5. **Add features** - Customers want to know what's included
6. **Keep prices updated** - Mark sold vehicles as "Sold" status
7. **Flush permalinks after changes** - If URLs don't work

---

## 🆘 Troubleshooting

### Vehicle pages show 404 error
**Solution**: Go to Settings > Permalinks and click "Save Changes"

### Custom fields not saving
**Solution**: Make sure you filled in all required fields (Make, Model, Year, Price)

### Gallery images not showing
**Solution**: Click "Add Images to Gallery" button and select images from Media Library

### Features not displaying
**Solution**: Check the boxes for features in the "Features & Options" section

---

## 🎉 You're All Set!

Your CPF Auto theme now has a complete vehicle management system with:
- ✅ Custom post type for vehicles
- ✅ 30+ custom fields
- ✅ Beautiful single vehicle template
- ✅ Advanced filtering on archive page
- ✅ Helper functions for easy development
- ✅ Admin dashboard integration
- ✅ Complete documentation

Start adding vehicles and building your car dealership website!

---

## 📚 Additional Resources

- **Field Documentation**: [VEHICLE-CUSTOM-FIELDS.md](VEHICLE-CUSTOM-FIELDS.md)
- **Theme Documentation**: [README.md](README.md)
- **Markdown Template**: [MarkdownTemplateForWp_Tailwind_Gsap.md](MarkdownTemplateForWp_Tailwind_Gsap.md)

---

**Need Help?** Review the documentation or check the code comments in `/inc/vehicle-*.php` files.

**Last Updated**: January 2026
