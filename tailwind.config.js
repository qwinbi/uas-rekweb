/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  
  darkMode: 'class',
  
  theme: {
    extend: {
      colors: {
        // Primary Colors
        'burgundy': {
          50: '#fdf2f4',
          100: '#fce7ea',
          200: '#f9d2d9',
          300: '#f4adbb',
          400: '#ec7a93',
          500: '#e14d6f',
          600: '#d12e5c',
          700: '#b01d47',
          800: '#931b40',
          900: '#7d1b3c',
          950: '#6C0820', // Our main burgundy color
          DEFAULT: '#6C0820',
        },
        
        // Cherry Blossom Pink
        'cherry': {
          50: '#fef2f4',
          100: '#fde7eb',
          200: '#fbd2da',
          300: '#f8adbd',
          400: '#f27998',
          500: '#e94d7a',
          600: '#d5295f',
          700: '#b31d4d',
          800: '#951b44',
          900: '#7f1b3e',
          950: '#F2AEBC', // Our main cherry color
          DEFAULT: '#F2AEBC',
        },
        
        // Misty Rose
        'misty': {
          50: '#fef2f3',
          100: '#fde7e8',
          200: '#fbd2d4',
          300: '#f8adbb',
          400: '#f27998',
          500: '#e94d7a',
          600: '#d5295f',
          700: '#b31d4d',
          800: '#951b44',
          900: '#7f1b3e',
          950: '#F2DCDB', // Our main misty color
          DEFAULT: '#F2DCDB',
        },
        
        // Silver Lake Blue
        'silver': {
          50: '#eff6ff',
          100: '#dbeafe',
          200: '#bfdbfe',
          300: '#93c5fd',
          400: '#60a5fa',
          500: '#3b82f6',
          600: '#2563eb',
          700: '#1d4ed8',
          800: '#1e40af',
          900: '#1e3a8a',
          950: '#5A86CB', // Our main silver blue
          DEFAULT: '#5A86CB',
        },
        
        // Lapis Lazuli
        'lapis': {
          50: '#eff6ff',
          100: '#dbeafe',
          200: '#bfdbfe',
          300: '#93c5fd',
          400: '#60a5fa',
          500: '#3b82f6',
          600: '#2563eb',
          700: '#1d4ed8',
          800: '#1e40af',
          900: '#1e3a8a',
          950: '#3D5D91', // Our main lapis color
          DEFAULT: '#3D5D91',
        },
        
        // Semantic colors based on our palette
        primary: {
          DEFAULT: '#6C0820',
          50: '#fdf2f4',
          100: '#fce7ea',
          200: '#f9d2d9',
          300: '#f4adbb',
          400: '#ec7a93',
          500: '#e14d6f',
          600: '#d12e5c',
          700: '#b01d47',
          800: '#931b40',
          900: '#7d1b3c',
        },
        
        secondary: {
          DEFAULT: '#F2AEBC',
          50: '#fef2f4',
          100: '#fde7eb',
          200: '#fbd2da',
          300: '#f8adbd',
          400: '#f27998',
          500: '#e94d7a',
          600: '#d5295f',
          700: '#b31d4d',
          800: '#951b44',
          900: '#7f1b3e',
        },
        
        background: {
          DEFAULT: '#F2DCDB',
          50: '#fef2f3',
          100: '#fde7e8',
          200: '#fbd2d4',
          300: '#f8adbb',
          400: '#f27998',
          500: '#e94d7a',
          600: '#d5295f',
          700: '#b31d4d',
          800: '#951b44',
          900: '#7f1b3e',
        },
        
        accent: {
          DEFAULT: '#5A86CB',
          50: '#eff6ff',
          100: '#dbeafe',
          200: '#bfdbfe',
          300: '#93c5fd',
          400: '#60a5fa',
          500: '#3b82f6',
          600: '#2563eb',
          700: '#1d4ed8',
          800: '#1e40af',
          900: '#1e3a8a',
        },
        
        dark: {
          DEFAULT: '#3D5D91',
          50: '#eff6ff',
          100: '#dbeafe',
          200: '#bfdbfe',
          300: '#93c5fd',
          400: '#60a5fa',
          500: '#3b82f6',
          600: '#2563eb',
          700: '#1d4ed8',
          800: '#1e40af',
          900: '#1e3a8a',
        },
        
        // Additional colors for status
        success: {
          DEFAULT: '#10b981',
          50: '#ecfdf5',
          100: '#d1fae5',
          200: '#a7f3d0',
          300: '#6ee7b7',
          400: '#34d399',
          500: '#10b981',
          600: '#059669',
          700: '#047857',
          800: '#065f46',
          900: '#064e3b',
        },
        
        warning: {
          DEFAULT: '#f59e0b',
          50: '#fffbeb',
          100: '#fef3c7',
          200: '#fde68a',
          300: '#fcd34d',
          400: '#fbbf24',
          500: '#f59e0b',
          600: '#d97706',
          700: '#b45309',
          800: '#92400e',
          900: '#78350f',
        },
        
        error: {
          DEFAULT: '#ef4444',
          50: '#fef2f2',
          100: '#fee2e2',
          200: '#fecaca',
          300: '#fca5a5',
          400: '#f87171',
          500: '#ef4444',
          600: '#dc2626',
          700: '#b91c1c',
          800: '#991b1b',
          900: '#7f1d1d',
        },
        
        info: {
          DEFAULT: '#0ea5e9',
          50: '#f0f9ff',
          100: '#e0f2fe',
          200: '#bae6fd',
          300: '#7dd3fc',
          400: '#38bdf8',
          500: '#0ea5e9',
          600: '#0284c7',
          700: '#0369a1',
          800: '#075985',
          900: '#0c4a6e',
        },
      },
      
      fontFamily: {
        'sans': ['Poppins', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
        'display': ['"Playfair Display"', 'Georgia', 'serif'],
        'mono': ['ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'Liberation Mono', 'Courier New', 'monospace'],
      },
      
      fontSize: {
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
      },
      
      spacing: {
        '18': '4.5rem',
        '88': '22rem',
        '128': '32rem',
        '144': '36rem',
      },
      
      animation: {
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'fade-out': 'fadeOut 0.5s ease-in-out',
        'slide-in-up': 'slideInUp 0.3s ease-out',
        'slide-in-down': 'slideInDown 0.3s ease-out',
        'slide-in-left': 'slideInLeft 0.3s ease-out',
        'slide-in-right': 'slideInRight 0.3s ease-out',
        'bounce-slow': 'bounce 2s infinite',
        'pulse-slow': 'pulse 3s infinite',
        'spin-slow': 'spin 3s linear infinite',
        'ping-slow': 'ping 3s cubic-bezier(0, 0, 0.2, 1) infinite',
      },
      
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        fadeOut: {
          '0%': { opacity: '1' },
          '100%': { opacity: '0' },
        },
        slideInUp: {
          '0%': { transform: 'translateY(10px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        slideInDown: {
          '0%': { transform: 'translateY(-10px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        slideInLeft: {
          '0%': { transform: 'translateX(-10px)', opacity: '0' },
          '100%': { transform: 'translateX(0)', opacity: '1' },
        },
        slideInRight: {
          '0%': { transform: 'translateX(10px)', opacity: '0' },
          '100%': { transform: 'translateX(0)', opacity: '1' },
        },
      },
      
      boxShadow: {
        'soft': '0 4px 6px -1px rgba(108, 8, 32, 0.1), 0 2px 4px -1px rgba(108, 8, 32, 0.06)',
        'hover': '0 10px 15px -3px rgba(108, 8, 32, 0.1), 0 4px 6px -2px rgba(108, 8, 32, 0.05)',
        'card': '0 4px 12px rgba(108, 8, 32, 0.08), 0 0 1px rgba(108, 8, 32, 0.1)',
        'dropdown': '0 10px 30px rgba(108, 8, 32, 0.15), 0 0 1px rgba(108, 8, 32, 0.3)',
        'inner-soft': 'inset 0 2px 4px 0 rgba(108, 8, 32, 0.05)',
        'glow': '0 0 20px rgba(242, 174, 188, 0.3)',
        'glow-burgundy': '0 0 20px rgba(108, 8, 32, 0.3)',
      },
      
      borderRadius: {
        'none': '0',
        'sm': '0.125rem',
        DEFAULT: '0.25rem',
        'md': '0.375rem',
        'lg': '0.5rem',
        'xl': '0.75rem',
        '2xl': '1rem',
        '3xl': '1.5rem',
        'full': '9999px',
        'large': '1.25rem',
      },
      
      backgroundImage: {
        'gradient-burgundy': 'linear-gradient(135deg, #6C0820 0%, #931b40 100%)',
        'gradient-cherry': 'linear-gradient(135deg, #F2AEBC 0%, #f27998 100%)',
        'gradient-misty': 'linear-gradient(135deg, #F2DCDB 0%, #f8adbb 100%)',
        'gradient-silver': 'linear-gradient(135deg, #5A86CB 0%, #3b82f6 100%)',
        'gradient-lapis': 'linear-gradient(135deg, #3D5D91 0%, #1e40af 100%)',
        'gradient-primary': 'linear-gradient(135deg, #6C0820 0%, #F2AEBC 100%)',
        'gradient-blossom': 'linear-gradient(135deg, #F2AEBC 0%, #F2DCDB 100%)',
        'gradient-sky': 'linear-gradient(135deg, #5A86CB 0%, #3D5D91 100%)',
        'gradient-brand': 'linear-gradient(135deg, #6C0820 0%, #F2AEBC 50%, #5A86CB 100%)',
      },
      
      backgroundSize: {
        'auto': 'auto',
        'cover': 'cover',
        'contain': 'contain',
        '200%': '200%',
      },
      
      transitionProperty: {
        'height': 'height',
        'spacing': 'margin, padding',
        'transform': 'transform',
        'colors': 'color, background-color, border-color, text-decoration-color, fill, stroke',
        'opacity': 'opacity',
        'shadow': 'box-shadow',
        'filter': 'filter',
      },
      
      transitionDuration: {
        '2000': '2000ms',
        '3000': '3000ms',
      },
      
      zIndex: {
        '60': '60',
        '70': '70',
        '80': '80',
        '90': '90',
        '100': '100',
      },
      
      screens: {
        'xs': '475px',
        '3xl': '1920px',
        '4xl': '2560px',
      },
    },
  },
  
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/container-queries'),
    require('flowbite/plugin'),
  ],
  
  safelist: [
    'bg-burgundy',
    'bg-cherry',
    'bg-misty',
    'bg-silver',
    'bg-lapis',
    'text-burgundy',
    'text-cherry',
    'text-misty',
    'text-silver',
    'text-lapis',
    'border-burgundy',
    'border-cherry',
    'border-misty',
    'border-silver',
    'border-lapis',
    'hover:bg-burgundy',
    'hover:bg-cherry',
    'hover:bg-misty',
    'hover:bg-silver',
    'hover:bg-lapis',
    'hover:text-burgundy',
    'hover:text-cherry',
    'hover:text-misty',
    'hover:text-silver',
    'hover:text-lapis',
    'animate-fade-in',
    'animate-slide-in-up',
  ],
}