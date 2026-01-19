# Featured Vehicles - Fixed!

## Problem
When adding vehicles, they weren't showing in the "Featured Vehicles" section on the homepage.

## Solution
Updated the featured vehicles section to query the `vehicle` custom post type instead of regular `post` type.

## Changes Made

### 1. Updated Featured Vehicles Query
**File**: `template-parts/sections/featured-vehicles.php`

Changed from:
```php
'post_type' => 'post'
```

To:
```php
'post_type' => 'vehicle'
```

### 2. Added "Featured Vehicle" Checkbox
**File**: `inc/vehicle-meta-boxes.php`

Added a new meta box in the sidebar with a checkbox to mark vehicles as featured.

**How to use**:
- When editing a vehicle, look for the "Featured Vehicle" box in the right sidebar
- Check the box "Mark as Featured Vehicle"
- Save/Update the vehicle
- That vehicle will now appear in the Featured Vehicles section

### 3. Updated "View All Vehicles" Link
The "View All Vehicles" button now correctly links to `/vehicles/` (the vehicle archive page).

## How It Works Now

### Option 1: Show Featured Vehicles (Recommended)
1. Create your vehicles
2. Edit each vehicle you want to feature
3. Check the "Featured Vehicle" checkbox in the sidebar
4. Save the vehicle
5. The featured vehicles will appear on the homepage

### Option 2: Show Latest Vehicles (Automatic)
If no vehicles are marked as featured, the section will automatically display the 6 most recent vehicles.

## Quick Steps

1. **Go to**: Vehicles > All Vehicles
2. **Edit** a vehicle
3. **Find** the "Featured Vehicle" box in the right sidebar (near the Publish box)
4. **Check** the "Mark as Featured Vehicle" checkbox
5. **Click** Update
6. **Repeat** for up to 6 vehicles you want to feature
7. **Visit** your homepage to see them!

## Number of Featured Vehicles

By default, it shows 6 featured vehicles. To change this:

Edit `template-parts/sections/featured-vehicles.php` line 11:
```php
'posts_per_page' => 6,  // Change to desired number
```

## Complete!

Your featured vehicles section is now working correctly! 🎉

Any vehicles you add will now appear on the homepage, and you can control which ones are "featured" using the checkbox.
