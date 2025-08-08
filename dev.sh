#!/bin/bash

# Script de desarrollo para Mostay
# Uso: ./dev.sh [comando]

case "$1" in
    "start"|"dev"|"watch")
        echo "🚀 Iniciando modo desarrollo..."
        echo "📁 Sass: components/sass/main.scss → wp/wp-content/themes/mostay/css/main.min.css"
        echo "📁 JS: components/scripts/script.js → wp/wp-content/themes/mostay/js/script-bundle.min.js"
        echo "⏳ Esperando cambios... (Ctrl+C para detener)"
        npm run dev
        ;;
    "build")
        echo "🔨 Compilando archivos..."
        npm run build
        echo "✅ Compilación completada"
        ;;
    "sass")
        echo "🎨 Compilando solo Sass..."
        npm run sass:build
        ;;
    "js")
        echo "⚡ Compilando solo JavaScript..."
        npm run js:build
        ;;
    "sass:watch")
        echo "🎨 Iniciando watch de Sass..."
        npm run sass:watch
        ;;
    "js:watch")
        echo "⚡ Iniciando watch de JavaScript..."
        npm run js:watch
        ;;
    "clean")
        echo "🧹 Limpiando archivos compilados..."
        rm -f wp/wp-content/themes/mostay/css/main.min.css*
        rm -f wp/wp-content/themes/mostay/js/script-bundle.min.js*
        echo "✅ Limpieza completada"
        ;;
    "help"|*)
        echo "📖 Comandos disponibles:"
        echo "  ./dev.sh start    - Inicia modo desarrollo (watch)"
        echo "  ./dev.sh dev      - Alias para start"
        echo "  ./dev.sh watch    - Alias para start"
        echo "  ./dev.sh build    - Compila todos los archivos"
        echo "  ./dev.sh sass     - Compila solo Sass"
        echo "  ./dev.sh js       - Compila solo JavaScript"
        echo "  ./dev.sh sass:watch - Watch solo Sass"
        echo "  ./dev.sh js:watch   - Watch solo JavaScript"
        echo "  ./dev.sh clean    - Limpia archivos compilados"
        echo "  ./dev.sh help     - Muestra esta ayuda"
        ;;
esac
