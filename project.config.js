/**
 * Configuración centralizada del proyecto Mostay
 * Centraliza rutas, breakpoints, z-index y configuraciones del proyecto
 */

module.exports = {
  // Información del proyecto
  project: {
    name: 'Mostay',
    version: '1.0.0',
    description: 'Estudio de branding y diseño de marcas',
    author: 'Mostay Team'
  },

  // Rutas del proyecto
  paths: {
    // Directorios principales
    root: './',
    components: './components/',
    wordpress: './wp/',
    theme: './wp/wp-content/themes/mostay/',
    
    // SASS
    sass: {
      source: './components/sass/',
      main: './components/sass/main.scss',
      output: './wp/wp-content/themes/mostay/css/',
      mainOutput: './wp/wp-content/themes/mostay/css/main.min.css'
    },
    
    // JavaScript
    js: {
      source: './components/scripts/',
      main: './components/scripts/script.js',
      output: './wp/wp-content/themes/mostay/js/',
      mainOutput: './wp/wp-content/themes/mostay/js/script-bundle.min.js'
    },
    
    // Assets
    assets: {
      images: './wp/wp-content/themes/mostay/img/',
      fonts: './wp/wp-content/themes/mostay/fonts/',
      videos: './wp/wp-content/themes/mostay/video/'
    },
    
    // Testing
    testing: {
      screenshots: './screenshots/',
      reports: './reports/',
      coverage: './coverage/'
    }
  },

  // Breakpoints del proyecto (en rem)
  breakpoints: {
    xs: '20rem',    // 320px
    sm: '30rem',    // 480px
    md: '43.75rem', // 700px
    lg: '64rem',    // 1024px
    xl: '90rem'     // 1440px
  },

  // Z-index scale
  zIndex: {
    base: 1,
    dropdown: 1000,
    sticky: 1020,
    fixed: 1030,
    modal: 1040,
    popover: 1050,
    tooltip: 1060,
    preloader: 9999
  },

  // Transiciones
  transitions: {
    fast: '0.15s ease-in-out',
    normal: '0.3s ease-in-out',
    slow: '0.5s ease-in-out',
    slower: '0.75s ease-in-out'
  },

  // Espaciados
  spacing: {
    xs: '0.25rem',   // 4px
    sm: '0.5rem',    // 8px
    md: '1rem',      // 16px
    lg: '1.5rem',    // 24px
    xl: '2rem',      // 32px
    xxl: '3rem'      // 48px
  },

  // Colores del proyecto
  colors: {
    primary: 'var(--primary)',
    secondary: 'var(--secondary)',
    accent: 'var(--accent)',
    success: 'var(--success)',
    warning: 'var(--warning)',
    error: 'var(--error)',
    text: 'var(--text)',
    background: 'var(--background)'
  },

  // Configuración de compilación
  build: {
    sass: {
      style: 'compressed',
      sourceMap: true,
      quietDeps: true
    },
    js: {
      compress: true,
      mangle: true,
      sourceMap: true
    }
  },

  // Configuración de testing
  testing: {
    viewports: [
      { name: 'mobile', width: 375, height: 667 },
      { name: 'tablet', width: 768, height: 1024 },
      { name: 'desktop', width: 1440, height: 900 }
    ],
    accessibility: {
      standard: 'WCAG2AA',
      timeout: 30000
    },
    lighthouse: {
      port: 9222,
      chromeFlags: ['--headless', '--disable-gpu', '--no-sandbox']
    }
  }
};
