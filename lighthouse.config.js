/**
 * Configuración de Lighthouse para análisis de performance
 * Análisis de Core Web Vitals, SEO y mejores prácticas
 */

module.exports = {
  ci: {
    collect: {
      url: [
        'http://localhost/Mostay/wp/',
        'http://localhost/Mostay/wp/about/',
        'http://localhost/Mostay/wp/proyectos/',
        'http://localhost/Mostay/wp/blog/',
        'http://localhost/Mostay/wp/contacto/'
      ],
      numberOfRuns: 3,
      startServerCommand: 'echo "Servidor local debe estar corriendo en MAMP/XAMPP"',
      startServerReadyPattern: 'ready',
      startServerReadyTimeout: 60000,
      settings: {
        chromeFlags: '--no-sandbox --disable-dev-shm-usage --disable-gpu',
        preset: 'desktop',
        throttling: {
          rttMs: 40,
          throughputKbps: 10240,
          cpuSlowdownMultiplier: 1,
          requestLatencyMs: 0,
          downloadThroughputKbps: 0,
          uploadThroughputKbps: 0
        },
        formFactor: 'desktop',
        screenEmulation: {
          mobile: false,
          width: 1350,
          height: 940,
          deviceScaleFactor: 1,
          disabled: false
        },
        emulatedUserAgent: 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
      }
    },
    assert: {
      assertions: {
        'categories:performance': ['warn', { minScore: 0.8 }],
        'categories:accessibility': ['error', { minScore: 0.9 }],
        'categories:best-practices': ['warn', { minScore: 0.8 }],
        'categories:seo': ['warn', { minScore: 0.8 }],
        'first-contentful-paint': ['warn', { maxNumericValue: 2000 }],
        'largest-contentful-paint': ['warn', { maxNumericValue: 2500 }],
        'cumulative-layout-shift': ['warn', { maxNumericValue: 0.1 }],
        'total-blocking-time': ['warn', { maxNumericValue: 300 }],
        'interactive': ['warn', { maxNumericValue: 3500 }],
        'speed-index': ['warn', { maxNumericValue: 3000 }]
      }
    },
    upload: {
      target: 'filesystem',
      outputDir: './reports/lighthouse'
    }
  },
  // Configuración para uso local (no CI)
  local: {
    port: 9222,
    chromeFlags: ['--headless', '--disable-gpu', '--no-sandbox'],
    output: 'html',
    outputPath: './reports/lighthouse',
    onlyCategories: ['performance', 'accessibility', 'best-practices', 'seo'],
    skipAudits: [
      'uses-http2',
      'redirects-http',
      'uses-long-cache-ttl'
    ]
  }
};
