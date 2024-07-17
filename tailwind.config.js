const animate = require("tailwindcss-animate")

/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: ["class"],
  safelist: ["dark"],
  prefix: "",
  
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.{js,jsx,vue}",
  ],
  
  theme: {
    extend: {
      screens: {
        'lg-custom': {'min': '1300px'},  // Large devices (1300px and below)
        'md-custom': {'min': '768px'},   // Medium devices (768px and below)
        'sm-custom': {'min': '576px'},   // Small devices (576px and below)
        'xs-custom': {'min': '350px'},   // Extra small devices (350px and below)

        //Default  Tailwind
        'xl': {'max': '1280px'},
        'lg': {'max': '1024'},
        'md': {'max': '768px'},
      },
      colors: {
        primary: '#00b14f',
        secondary: '#028241',
        accent: '#ffffff',
        'secondary-accent': '#f6f6f6',
        text: '#333333',
        error: '#e63946',
        success: '#2a9d8f',
      },
      fontFamily: {
        sans: ['Poppins', 'sans-serif'],
      },
      fontWeight: {
        'normal': 400,
        'medium': 500,
        'semi-bold': 600,
      },
      fontSize: {
        'big': [
          '3.5rem',
          {
            sm: '2.5rem',
            md: '3rem',
            lg: '3.5rem',
            xl: '3.5rem',
          },
        ],
        'h1': [
          '2.25rem',
          {
            sm: '1.75rem',
            md: '2.25rem',
            lg: '2.5rem',
            xl: '2.5rem',
          },
        ],
        'h2': [
          '1.5rem',
          {
            sm: '1.25rem',
            md: '1.5rem',
            lg: '1.75rem ',
            xl: '1.75rem',
          },
        ],
        'h3': [
          '1.25rem ',
          {
            sm: '1rem',
            md: '1.25rem',
            lg: '1.5rem',
            xl: '1.5rem',
          },
        ],
        'base': [
          '1rem',
          {
            sm: '0.875rem',
            md: '1rem',
            lg: '1.125rem',
            xl: '1.125rem',
          },
        ],
        'small': [
          '0.875rem',
          {
            sm: '0.75rem',
            md: '0.875rem',
            lg: '1rem',
            xl: '1rem',
          },
        ],
        'smaller': [
          '0.813rem',
          {
            sm: '0.688rem',
            md: '0.813rem',
            lg: '0.875rem',
            xl: '0.875rem',
          },
        ],
        'tiny': [
          '0.625rem',
          {
            sm: '0.563rem',
            md: '0.625rem',
            lg: '0.688rem',
            xl: '0.688rem',
          },
        ],
      },
      keyframes: {
        "accordion-down": {
          from: { height: 0 },
          to: { height: "var(--radix-accordion-content-height)" },
        },
        "accordion-up": {
          from: { height: "var(--radix-accordion-content-height)" },
          to: { height: 0 },
        },
        "collapsible-down": {
          from: { height: 0 },
          to: { height: 'var(--radix-collapsible-content-height)' },
        },
        "collapsible-up": {
          from: { height: 'var(--radix-collapsible-content-height)' },
          to: { height: 0 },
        },
      },
      animation: {
        "accordion-down": "accordion-down 0.2s ease-out",
        "accordion-up": "accordion-up 0.2s ease-out",
        "collapsible-down": "collapsible-down 0.2s ease-in-out",
        "collapsible-up": "collapsible-up 0.2s ease-in-out",
      },

      keyframes: {
        'accordion-down': {
          from: { height: 0 },
          to: { height: 'var(--radix-accordion-content-height)' },
        },
        'accordion-up': {
          from: { height: 'var(--radix-accordion-content-height)' },
          to: { height: 0 },
        },
      },
      animation: {
        'accordion-down': 'accordion-down 0.2s ease-out',
        'accordion-up': 'accordion-up 0.2s ease-out',
      },
    },
  },
  plugins: [animate],
}