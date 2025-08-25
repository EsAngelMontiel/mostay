#!/usr/bin/env node

/**
 * Script de Testing Visual Automatizado
 * Captura screenshots en múltiples viewports y genera reportes
 */

const puppeteer = require('puppeteer');
const fs = require('fs').promises;
const path = require('path');

// Configuración del proyecto
const config = require('../project.config.js');

// URLs a testear (ajustar según tu entorno local)
const TEST_URLS = [
  'http://localhost:8888/Mostay/wp/',
  'http://localhost:8888/Mostay/wp/about/',
  'http://localhost:8888/Mostay/wp/proyectos/',
  'http://localhost:8888/Mostay/wp/blog/',
  'http://localhost:8888/Mostay/wp/contacto/'
];

// Viewports a testear
const VIEWPORTS = config.testing.viewports;

// Directorios
const SCREENSHOTS_DIR = path.join(__dirname, '..', 'screenshots');
const REPORTS_DIR = path.join(__dirname, '..', 'reports');

class VisualTester {
  constructor() {
    this.browser = null;
    this.page = null;
    this.results = [];
  }

  async init() {
    console.log('🚀 Iniciando Visual Testing...');
    
    // Crear directorios si no existen
    await this.createDirectories();
    
    // Iniciar navegador
    this.browser = await puppeteer.launch({
      headless: true,
      args: ['--no-sandbox', '--disable-setuid-sandbox']
    });
    
    this.page = await this.browser.newPage();
    
    // Configurar viewport por defecto
    await this.page.setViewport({
      width: 1440,
      height: 900
    });
  }

  async createDirectories() {
    try {
      await fs.mkdir(SCREENSHOTS_DIR, { recursive: true });
      await fs.mkdir(REPORTS_DIR, { recursive: true });
      console.log('✅ Directorios creados');
    } catch (error) {
      console.log('⚠️  Directorios ya existen');
    }
  }

  async captureScreenshots() {
    console.log('📸 Capturando screenshots...');
    
    for (const url of TEST_URLS) {
      console.log(`\n🔗 Procesando: ${url}`);
      
      try {
        await this.page.goto(url, { 
          waitUntil: 'networkidle2',
          timeout: 30000 
        });
        
        // Esperar a que las animaciones terminen
        await this.page.waitForTimeout(2000);
        
        const urlResults = [];
        
        for (const viewport of VIEWPORTS) {
          console.log(`  📱 ${viewport.name}: ${viewport.width}x${viewport.height}`);
          
          await this.page.setViewport({
            width: viewport.width,
            height: viewport.height
          });
          
          // Esperar a que el layout se estabilice
          await this.page.waitForTimeout(1000);
          
          const filename = this.generateFilename(url, viewport);
          const filepath = path.join(SCREENSHOTS_DIR, filename);
          
          await this.page.screenshot({
            path: filepath,
            fullPage: true,
            quality: 90
          });
          
          urlResults.push({
            viewport: viewport.name,
            dimensions: `${viewport.width}x${viewport.height}`,
            filename: filename,
            filepath: filepath,
            timestamp: new Date().toISOString()
          });
          
          console.log(`    ✅ ${filename}`);
        }
        
        this.results.push({
          url: url,
          screenshots: urlResults,
          status: 'success',
          timestamp: new Date().toISOString()
        });
        
      } catch (error) {
        console.error(`❌ Error procesando ${url}:`, error.message);
        
        this.results.push({
          url: url,
          error: error.message,
          status: 'error',
          timestamp: new Date().toISOString()
        });
      }
    }
  }

  generateFilename(url, viewport) {
    const urlPath = new URL(url).pathname.replace(/\/$/, '') || 'home';
    const cleanPath = urlPath.replace(/[^a-zA-Z0-9]/g, '-');
    const timestamp = new Date().toISOString().replace(/[:.]/g, '-').slice(0, -5);
    
    return `${cleanPath}-${viewport.name}-${viewport.width}x${viewport.height}-${timestamp}.png`;
  }

  async generateReport() {
    console.log('\n📊 Generando reporte...');
    
    const report = {
      project: config.project.name,
      version: config.project.version,
      timestamp: new Date().toISOString(),
      summary: {
        totalUrls: TEST_URLS.length,
        totalScreenshots: this.results.reduce((acc, result) => {
          return acc + (result.screenshots ? result.screenshots.length : 0);
        }, 0),
        successful: this.results.filter(r => r.status === 'success').length,
        failed: this.results.filter(r => r.status === 'error').length
      },
      results: this.results,
      viewports: VIEWPORTS,
      config: {
        screenshotsDir: SCREENSHOTS_DIR,
        reportsDir: REPORTS_DIR
      }
    };
    
    const reportPath = path.join(REPORTS_DIR, `visual-test-${Date.now()}.json`);
    
    await fs.writeFile(reportPath, JSON.stringify(report, null, 2));
    
    console.log(`✅ Reporte generado: ${reportPath}`);
    
    // Mostrar resumen en consola
    this.displaySummary(report);
    
    return report;
  }

  displaySummary(report) {
    console.log('\n' + '='.repeat(60));
    console.log('📊 RESUMEN DEL TESTING VISUAL');
    console.log('='.repeat(60));
    console.log(`🏗️  Proyecto: ${report.project} v${report.version}`);
    console.log(`⏰ Timestamp: ${new Date(report.timestamp).toLocaleString()}`);
    console.log(`🔗 URLs testeadas: ${report.summary.totalUrls}`);
    console.log(`📸 Screenshots capturados: ${report.summary.totalScreenshots}`);
    console.log(`✅ Exitosos: ${report.summary.successful}`);
    console.log(`❌ Fallidos: ${report.summary.failed}`);
    console.log(`📁 Screenshots guardados en: ${SCREENSHOTS_DIR}`);
    console.log(`📄 Reporte guardado en: ${REPORTS_DIR}`);
    console.log('='.repeat(60));
  }

  async cleanup() {
    if (this.browser) {
      await this.browser.close();
      console.log('🔒 Navegador cerrado');
    }
  }

  async run() {
    try {
      await this.init();
      await this.captureScreenshots();
      await this.generateReport();
    } catch (error) {
      console.error('💥 Error durante el testing:', error);
    } finally {
      await this.cleanup();
    }
  }
}

// Función principal
async function main() {
  const tester = new VisualTester();
  await tester.run();
}

// Ejecutar si es llamado directamente
if (require.main === module) {
  main().catch(console.error);
}

module.exports = VisualTester;
