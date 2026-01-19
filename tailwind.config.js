/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './template-parts/**/*.php',
    './inc/**/*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      // ===========================
      // COLOR PALETTE
      // ===========================
      colors: {
        // Primary Brand Color - Deep Navy Blue (Trust, Professionalism)
        primary: {
          50: '#e8e9f0',
          100: '#c2c4d9',
          200: '#9c9fc2',
          300: '#767aab',
          400: '#505594',
          500: '#15153f', // Base primary
          600: '#111136',
          700: '#0d0d2d',
          800: '#090924',
          900: '#05051b',
          DEFAULT: '#15153f',
        },
        // Secondary Brand Color - Bold Red (Energy, Action)
        secondary: {
          50: '#fce8ea',
          100: '#f8c2c7',
          200: '#f49ca4',
          300: '#f07681',
          400: '#ec505e',
          500: '#be1e2e', // Base secondary
          600: '#981825',
          700: '#72121c',
          800: '#4c0c13',
          900: '#26060a',
          DEFAULT: '#be1e2e',
        },
        // Accent Color - Vibrant Gold (Premium, Luxury)
        accent: {
          50: '#fff9e6',
          100: '#fff1b3',
          200: '#ffe980',
          300: '#ffe14d',
          400: '#ffd91a',
          500: '#febf00', // Base accent
          600: '#cb9900',
          700: '#987300',
          800: '#654d00',
          900: '#322600',
          DEFAULT: '#febf00',
        },
        // Neutral Grays for Text & Backgrounds
        gray: {
          50: '#f9fafb',
          100: '#f3f4f6',
          200: '#e5e7eb',
          300: '#d1d5db',
          400: '#9ca3af',
          500: '#6b7280',
          600: '#4b5563',
          700: '#374151',
          800: '#1f2937',
          900: '#111827',
        },
        // Semantic Colors
        success: {
          DEFAULT: '#10b981',
          light: '#34d399',
          dark: '#059669',
        },
        warning: {
          DEFAULT: '#f59e0b',
          light: '#fbbf24',
          dark: '#d97706',
        },
        error: {
          DEFAULT: '#ef4444',
          light: '#f87171',
          dark: '#dc2626',
        },
        info: {
          DEFAULT: '#3b82f6',
          light: '#60a5fa',
          dark: '#2563eb',
        },
      },
      
      // ===========================
      // TYPOGRAPHY
      // ===========================
      fontFamily: {
        // Body Font - Clean, Professional, Highly Readable
        sans: ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
        // Heading Font - Modern, Professional, Trustworthy
        heading: ['Montserrat', 'system-ui', 'sans-serif'],
        // Display Font - Elegant Serif for Hero Sections (Luxury Feel)
        display: ['Playfair Display', 'Georgia', 'serif'],
        // Alternative Display - Bold, Attention-Grabbing (for automotive feel)
        displayAlt: ['Bebas Neue', 'Impact', 'Arial Black', 'sans-serif'],
        // Monospace for technical content
        mono: ['JetBrains Mono', 'Menlo', 'Monaco', 'Consolas', 'monospace'],
      },
      
      fontSize: {
        // Extended typography scale
        'xs': ['0.75rem', { lineHeight: '1rem' }],
        'sm': ['0.875rem', { lineHeight: '1.25rem' }],
        'base': ['1rem', { lineHeight: '1.5rem' }],
        'lg': ['1.125rem', { lineHeight: '1.75rem' }],
        'xl': ['1.25rem', { lineHeight: '1.75rem' }],
        '2xl': ['1.5rem', { lineHeight: '2rem' }],
        '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
        '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
        '5xl': ['3rem', { lineHeight: '1' }],
        '6xl': ['3.75rem', { lineHeight: '1' }],
        '7xl': ['4.5rem', { lineHeight: '1' }],
        '8xl': ['6rem', { lineHeight: '1' }],
        '9xl': ['8rem', { lineHeight: '1' }],
        // Custom sizes for car dealer theme
        'hero': ['clamp(2.5rem, 5vw, 4.5rem)', { lineHeight: '1.1', letterSpacing: '-0.02em' }],
        'section-title': ['clamp(1.875rem, 3vw, 3rem)', { lineHeight: '1.2', letterSpacing: '-0.01em' }],
      },
      
      fontWeight: {
        thin: '100',
        extralight: '200',
        light: '300',
        normal: '400',
        medium: '500',
        semibold: '600',
        bold: '700',
        extrabold: '800',
        black: '900',
      },
      
      letterSpacing: {
        tighter: '-0.05em',
        tight: '-0.025em',
        normal: '0',
        wide: '0.025em',
        wider: '0.05em',
        widest: '0.1em',
        // Custom for automotive feel
        'auto': '0.15em', // For display text
      },
      
      lineHeight: {
        none: '1',
        tight: '1.25',
        snug: '1.375',
        normal: '1.5',
        relaxed: '1.625',
        loose: '2',
        // Custom line heights
        'heading': '1.2',
        'body': '1.6',
      },
      
      // ===========================
      // SPACING SCALE
      // ===========================
      spacing: {
        // Extended spacing scale for consistent rhythm
        '0': '0',
        '1': '0.25rem',
        '2': '0.5rem',
        '3': '0.75rem',
        '4': '1rem',
        '5': '1.25rem',
        '6': '1.5rem',
        '7': '1.75rem',
        '8': '2rem',
        '9': '2.25rem',
        '10': '2.5rem',
        '11': '2.75rem',
        '12': '3rem',
        '14': '3.5rem',
        '16': '4rem',
        '20': '5rem',
        '24': '6rem',
        '28': '7rem',
        '32': '8rem',
        '36': '9rem',
        '40': '10rem',
        '44': '11rem',
        '48': '12rem',
        '52': '13rem',
        '56': '14rem',
        '60': '15rem',
        '64': '16rem',
        '72': '18rem',
        '80': '20rem',
        '96': '24rem',
        '128': '32rem',
        '144': '36rem',
        // Custom spacing for car dealer layouts
        'section': '6rem', // Standard section padding
        'section-lg': '8rem', // Large section padding
        'container': '1.5rem', // Container padding
      },
      
      // ===========================
      // BORDER RADIUS
      // ===========================
      borderRadius: {
        'none': '0',
        'sm': '0.125rem',
        'DEFAULT': '0.25rem',
        'md': '0.375rem',
        'lg': '0.5rem',
        'xl': '0.75rem',
        '2xl': '1rem',
        '3xl': '1.5rem',
        '4xl': '2rem',
        'full': '9999px',
        // Custom radius for car dealer theme
        'card': '0.75rem', // Standard card radius
        'button': '0.5rem', // Button radius
        'image': '0.5rem', // Image radius
      },
      
      // ===========================
      // BOX SHADOWS
      // ===========================
      boxShadow: {
        'sm': '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
        'DEFAULT': '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
        'md': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
        'lg': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
        'xl': '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
        '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
        'inner': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
        'none': 'none',
        // Custom shadows for car dealer theme
        'card': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
        'card-hover': '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
        'button': '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
        'button-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.2)',
        'header': '0 2px 8px rgba(0, 0, 0, 0.1)',
        'vehicle-card': '0 8px 16px rgba(0, 0, 0, 0.12)',
        'vehicle-card-hover': '0 16px 32px rgba(0, 0, 0, 0.16)',
      },
      
      // ===========================
      // ANIMATIONS & TRANSITIONS
      // ===========================
      animation: {
        'fade-in': 'fadeIn 0.6s ease-in-out',
        'slide-up': 'slideUp 0.6s ease-out',
        'slide-down': 'slideDown 0.6s ease-out',
        'slide-left': 'slideLeft 0.6s ease-out',
        'slide-right': 'slideRight 0.6s ease-out',
        'scale-in': 'scaleIn 0.4s ease-out',
        'bounce-subtle': 'bounceSubtle 2s infinite',
      },
      
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        slideDown: {
          '0%': { transform: 'translateY(-20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        slideLeft: {
          '0%': { transform: 'translateX(20px)', opacity: '0' },
          '100%': { transform: 'translateX(0)', opacity: '1' },
        },
        slideRight: {
          '0%': { transform: 'translateX(-20px)', opacity: '0' },
          '100%': { transform: 'translateX(0)', opacity: '1' },
        },
        scaleIn: {
          '0%': { transform: 'scale(0.9)', opacity: '0' },
          '100%': { transform: 'scale(1)', opacity: '1' },
        },
        bounceSubtle: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-5px)' },
        },
      },
      
      transitionDuration: {
        'DEFAULT': '200ms',
        '75': '75ms',
        '100': '100ms',
        '150': '150ms',
        '200': '200ms',
        '300': '300ms',
        '500': '500ms',
        '700': '700ms',
        '1000': '1000ms',
      },
      
      transitionTimingFunction: {
        'smooth': 'cubic-bezier(0.4, 0, 0.2, 1)',
        'bounce-in': 'cubic-bezier(0.68, -0.55, 0.265, 1.55)',
      },
      
      // ===========================
      // BREAKPOINTS
      // ===========================
      screens: {
        'xs': '475px',
        'sm': '640px',
        'md': '768px',
        'lg': '1024px',
        'xl': '1280px',
        '2xl': '1536px',
        // Custom breakpoints for car dealer layouts
        'container': '1200px', // Standard container width
        'wide': '1400px', // Wide layouts
      },
      
      // ===========================
      // MAX WIDTHS
      // ===========================
      maxWidth: {
        'container': '1200px',
        'container-wide': '1400px',
        'container-narrow': '800px',
        'content': '65ch', // Optimal reading width
      },
      
      // ===========================
      // Z-INDEX SCALE
      // ===========================
      zIndex: {
        'auto': 'auto',
        '0': '0',
        '10': '10',
        '20': '20',
        '30': '30',
        '40': '40',
        '50': '50',
        // Custom z-index values
        'dropdown': '1000',
        'sticky': '1020',
        'fixed': '1030',
        'modal-backdrop': '1040',
        'modal': '1050',
        'popover': '1060',
        'tooltip': '1070',
      },
      
      // ===========================
      // ASPECT RATIOS
      // ===========================
      aspectRatio: {
        'auto': 'auto',
        'square': '1 / 1',
        'video': '16 / 9',
        'vehicle': '4 / 3', // Standard vehicle image ratio
        'vehicle-wide': '16 / 9', // Wide vehicle image
        'hero': '21 / 9', // Hero banner ratio
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
  ],
  // Safelist for WordPress-generated classes
  safelist: [
    'alignwide',
    'alignfull',
    'wp-block-image',
    'current-menu-item',
    'menu-item',
    'sub-menu',
    {
      pattern: /^wp-/,
    },
  ],
}
