# Cpfauto WordPress Theme

Professional car dealer WordPress theme built with Tailwind CSS and GSAP animations.

## Features

- **Tailwind CSS** - Utility-first CSS framework
- **GSAP Animations** - Smooth, performant animations
- **Responsive Design** - Mobile-first approach
- **WordPress Standards** - Follows WordPress coding standards
- **Accessibility** - WCAG compliant
- **Performance** - Optimized for speed

## Installation

### For Development

1. Install dependencies:
```bash
npm install
```

2. Build CSS:
```bash
npm run build
```

3. For development (watch mode):
```bash
npm run dev
```

### For Production Deployment

1. **Build production assets:**
```bash
npm install
npm run build
```

2. **Upload to WordPress:**
   - **Option A (FTP):** Upload the entire theme folder to `/wp-content/themes/` on your server
   - **Option B (WordPress Admin):**
     - Create a ZIP of the theme folder
     - Go to Appearance → Themes → Add New → Upload Theme
     - Upload and activate

3. **Activate theme:**
   - Log in to WordPress admin
   - Navigate to Appearance → Themes
   - Activate "Cpfauto"

**Note:** Make sure the compiled CSS file exists in `assets/css/` before deploying.

## Theme Structure

```
Cpfauto/
├── assets/
│   ├── css/          # Compiled CSS
│   ├── js/           # JavaScript files
│   ├── images/       # Theme images
│   └── src/          # Source CSS (Tailwind)
├── inc/              # PHP includes
├── template-parts/   # Template partials
└── *.php            # WordPress template files
```

## Brand Colors

- Primary: `#15153f`
- Secondary: `#be1e2e`
- Accent: `#febf00`

## Development

### Build Commands

- `npm run dev` - Watch mode for development
- `npm run build` - Build production CSS (minified)

### GSAP Animation Classes

Add these classes to trigger animations:

- `.animate-fade-in` - Fade in on scroll
- `.animate-slide-left` - Slide from left
- `.animate-slide-right` - Slide from right
- `.animate-scale` - Scale up animation
- `.animate-stagger` - Stagger children animations
- `.parallax` - Parallax effect (use `data-speed` attribute)
- `.card-hover` - Card hover effect
- `.btn-hover-effect` - Button hover effect

## License

GPL-2.0-or-later
