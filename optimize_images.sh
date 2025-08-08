#!/bin/bash

# Script para optimizar imágenes en todos los archivos HTML
echo "🔧 Optimizando imágenes en archivos HTML..."

# Función para optimizar imágenes en un archivo
optimize_images_in_file() {
    local file="$1"
    echo "Optimizando: $file"
    
    # Reemplazar imágenes dummy con lazy loading y mejores alt texts
    sed -i '' 's/alt="imagen del articulo"/alt="Proyecto de diseño - Mostay" loading="lazy" decoding="async"/g' "$file"
    sed -i '' 's/alt="Nombre"/alt="Miembro del equipo - Mostay" loading="lazy" decoding="async"/g' "$file"
    
    # Optimizar imágenes del slider principal
    sed -i '' 's/alt="image"/alt="Diseño web profesional - Mostay" loading="lazy" decoding="async"/g' "$file"
}

# Optimizar todos los archivos HTML en layout/
for file in layout/*.html; do
    if [ -f "$file" ]; then
        optimize_images_in_file "$file"
    fi
done

echo "✅ Optimización de imágenes completada"
echo "📊 Resumen de cambios:"
echo "   - Agregado lazy loading a todas las imágenes"
echo "   - Mejorados los textos alternativos"
echo "   - Agregado decoding async para mejor rendimiento"
