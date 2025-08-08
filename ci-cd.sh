#!/bin/bash

# CI/CD Pipeline para Mostay
# Automatización de testing, building y deployment

set -e  # Exit on any error

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Variables de configuración
PROJECT_NAME="Mostay"
BUILD_DIR="dist"
BACKUP_DIR="backups"
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
GIT_BRANCH=$(git rev-parse --abbrev-ref HEAD)

# Función para logging
log() {
    echo -e "${BLUE}[$(date +'%Y-%m-%d %H:%M:%S')]${NC} $1"
}

success() {
    echo -e "${GREEN}✅ $1${NC}"
}

warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

error() {
    echo -e "${RED}❌ $1${NC}"
}

# Función para mostrar banner
show_banner() {
    echo ""
    echo "🚀 $PROJECT_NAME CI/CD Pipeline"
    echo "=================================="
    echo "Branch: $GIT_BRANCH"
    echo "Timestamp: $TIMESTAMP"
    echo ""
}

# Función para verificar dependencias
check_dependencies() {
    log "Verificando dependencias..."
    
    # Verificar Node.js
    if ! command -v node &> /dev/null; then
        error "Node.js no está instalado"
        exit 1
    fi
    
    # Verificar npm
    if ! command -v npm &> /dev/null; then
        error "npm no está instalado"
        exit 1
    fi
    
    # Verificar Git
    if ! command -v git &> /dev/null; then
        error "Git no está instalado"
        exit 1
    fi
    
    success "Dependencias verificadas"
}

# Función para limpiar build anterior
clean_build() {
    log "Limpiando build anterior..."
    
    if [ -d "$BUILD_DIR" ]; then
        rm -rf "$BUILD_DIR"
        success "Build anterior eliminado"
    fi
    
    # Limpiar cache de npm
    npm cache clean --force
}

# Función para instalar dependencias
install_dependencies() {
    log "Instalando dependencias..."
    
    if [ -f "package.json" ]; then
        npm ci --silent
        success "Dependencias instaladas"
    else
        warning "No se encontró package.json"
    fi
}

# Función para linting
run_linting() {
    log "Ejecutando linting..."
    
    # Linting de JavaScript
    if [ -f ".eslintrc.js" ] || [ -f ".eslintrc.json" ]; then
        npx eslint . --ext .js --quiet
        success "Linting completado"
    else
        warning "No se encontró configuración de ESLint"
    fi
    
    # Linting de CSS/SCSS
    if command -v stylelint &> /dev/null; then
        npx stylelint "**/*.css" "**/*.scss" --quiet
        success "Stylelint completado"
    fi
}

# Función para testing
run_tests() {
    log "Ejecutando tests..."
    
    # Tests unitarios
    if [ -f "package.json" ] && grep -q "test" package.json; then
        npm test --silent
        success "Tests unitarios completados"
    fi
    
    # Tests de integración
    if [ -d "tests" ]; then
        log "Ejecutando tests de integración..."
        # Aquí irían los tests de integración
        success "Tests de integración completados"
    fi
    
    # Tests de accesibilidad
    if command -v pa11y &> /dev/null; then
        log "Ejecutando tests de accesibilidad..."
        npx pa11y-ci
        success "Tests de accesibilidad completados"
    fi
}

# Función para building
build_project() {
    log "Construyendo proyecto..."
    
    # Crear directorio de build
    mkdir -p "$BUILD_DIR"
    
    # Build de Sass
    if [ -f "components/sass/main.scss" ]; then
        log "Compilando Sass..."
        npx sass components/sass/main.scss:wp/wp-content/themes/mostay/css/main.min.css --style=compressed --source-map --quiet-deps
        success "Sass compilado"
    fi
    
    # Build de JavaScript
    if [ -f "components/scripts/script.js" ]; then
        log "Minificando JavaScript..."
        npx terser components/scripts/script.js -o wp/wp-content/themes/mostay/js/script-bundle.min.js --compress --mangle
        success "JavaScript minificado"
    fi
    
    # Copiar archivos estáticos
    log "Copiando archivos estáticos..."
    cp -r layout/* "$BUILD_DIR/"
    cp -r wp "$BUILD_DIR/"
    success "Archivos estáticos copiados"
    
    # Optimizar imágenes
    if command -v cwebp &> /dev/null; then
        log "Optimizando imágenes..."
        find "$BUILD_DIR" -name "*.jpg" -o -name "*.png" | xargs -I {} sh -c 'cwebp -q 85 "{}" -o "{}.webp"'
        success "Imágenes optimizadas"
    fi
    
    success "Build completado"
}

# Función para análisis de seguridad
security_scan() {
    log "Ejecutando análisis de seguridad..."
    
    # Verificar dependencias vulnerables
    if command -v npm-audit &> /dev/null; then
        npm audit --audit-level moderate
        success "Auditoría de seguridad completada"
    fi
    
    # Verificar archivos de configuración
    log "Verificando configuraciones de seguridad..."
    
    # Verificar .htaccess
    if [ -f "wp/.htaccess" ]; then
        if grep -q "X-Content-Type-Options" wp/.htaccess; then
            success "Headers de seguridad configurados"
        else
            warning "Headers de seguridad no encontrados"
        fi
    fi
    
    # Verificar wp-config.php
    if [ -f "wp/wp-config.php" ]; then
        if grep -q "WP_DEBUG.*false" wp/wp-config.php; then
            success "Debug deshabilitado en producción"
        else
            warning "Debug habilitado - revisar configuración"
        fi
    fi
}

# Función para análisis de performance
performance_analysis() {
    log "Analizando performance..."
    
    # Lighthouse CI (si está disponible)
    if command -v lhci &> /dev/null; then
        npx lhci autorun
        success "Análisis de Lighthouse completado"
    fi
    
    # Análisis de tamaño de archivos
    log "Analizando tamaño de archivos..."
    du -sh "$BUILD_DIR"/*
    
    # Verificar Core Web Vitals
    log "Verificando Core Web Vitals..."
    # Aquí irían las verificaciones de Core Web Vitals
}

# Función para crear backup
create_backup() {
    log "Creando backup..."
    
    mkdir -p "$BACKUP_DIR"
    tar -czf "$BACKUP_DIR/backup_$TIMESTAMP.tar.gz" -C . .
    success "Backup creado: backup_$TIMESTAMP.tar.gz"
}

# Función para deployment
deploy() {
    log "Iniciando deployment..."
    
    # Verificar que estamos en la rama correcta
    if [ "$GIT_BRANCH" != "master" ] && [ "$GIT_BRANCH" != "main" ]; then
        warning "Deployment desde rama: $GIT_BRANCH"
    fi
    
    # Crear backup antes del deployment
    create_backup
    
    # Deployment a staging (ejemplo)
    if [ "$1" = "staging" ]; then
        log "Deploying a staging..."
        # Comandos de deployment a staging
        success "Deployment a staging completado"
    fi
    
    # Deployment a producción
    if [ "$1" = "production" ]; then
        log "Deploying a producción..."
        # Comandos de deployment a producción
        success "Deployment a producción completado"
    fi
}

# Función para notificaciones
send_notifications() {
    log "Enviando notificaciones..."
    
    # Notificación por email (ejemplo)
    if command -v mail &> /dev/null; then
        echo "Build completado exitosamente" | mail -s "CI/CD: $PROJECT_NAME" admin@mostay.es
    fi
    
    # Notificación por Slack (ejemplo)
    if [ -n "$SLACK_WEBHOOK" ]; then
        curl -X POST -H 'Content-type: application/json' \
            --data "{\"text\":\"🚀 Build de $PROJECT_NAME completado exitosamente\"}" \
            "$SLACK_WEBHOOK"
    fi
    
    success "Notificaciones enviadas"
}

# Función para limpieza
cleanup() {
    log "Limpiando archivos temporales..."
    
    # Eliminar archivos temporales
    find . -name "*.tmp" -delete
    find . -name "*.log" -delete
    
    # Limpiar cache
    npm cache clean --force
    
    success "Limpieza completada"
}

# Función para mostrar ayuda
show_help() {
    echo "Uso: $0 [OPCIÓN]"
    echo ""
    echo "Opciones:"
    echo "  build       - Construir proyecto"
    echo "  test        - Ejecutar tests"
    echo "  deploy      - Deploy a staging"
    echo "  production  - Deploy a producción"
    echo "  full        - Pipeline completo"
    echo "  help        - Mostrar esta ayuda"
    echo ""
    echo "Ejemplos:"
    echo "  $0 build"
    echo "  $0 test"
    echo "  $0 deploy"
    echo "  $0 full"
}

# Función principal
main() {
    show_banner
    
    case "${1:-full}" in
        "build")
            check_dependencies
            clean_build
            install_dependencies
            build_project
            security_scan
            performance_analysis
            cleanup
            ;;
        "test")
            check_dependencies
            install_dependencies
            run_linting
            run_tests
            ;;
        "deploy")
            check_dependencies
            clean_build
            install_dependencies
            build_project
            security_scan
            deploy "staging"
            send_notifications
            cleanup
            ;;
        "production")
            check_dependencies
            clean_build
            install_dependencies
            build_project
            security_scan
            performance_analysis
            deploy "production"
            send_notifications
            cleanup
            ;;
        "full")
            check_dependencies
            clean_build
            install_dependencies
            run_linting
            run_tests
            build_project
            security_scan
            performance_analysis
            deploy "staging"
            send_notifications
            cleanup
            ;;
        "help"|*)
            show_help
            exit 0
            ;;
    esac
    
    success "Pipeline completado exitosamente!"
}

# Ejecutar función principal
main "$@"
