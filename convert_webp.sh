#!/bin/bash

# Script para convertir imágenes a WebP
# Requiere: cwebp (Google WebP utilities)

echo "🖼️  Convirtiendo imágenes a WebP..."

# Función para convertir imagen a WebP
convert_to_webp() {
    local input_file="$1"
    local output_file="${input_file%.*}.webp"
    
    if [[ -f "$input_file" ]]; then
        echo "Convirtiendo: $input_file → $output_file"
        
        # Convertir con calidad 85 (buen balance calidad/tamaño)
        cwebp -q 85 -m 6 -af -f 50 -sharpness 0 -mt -v "$input_file" -o "$output_file"
        
        if [[ $? -eq 0 ]]; then
            # Mostrar comparación de tamaños
            original_size=$(stat -f%z "$input_file" 2>/dev/null || stat -c%s "$input_file" 2>/dev/null)
            webp_size=$(stat -f%z "$output_file" 2>/dev/null || stat -c%s "$output_file" 2>/dev/null)
            
            if [[ -n "$original_size" && -n "$webp_size" ]]; then
                savings=$(( (original_size - webp_size) * 100 / original_size ))
                echo "✅ Completado: $savings% de reducción de tamaño"
            fi
        else
            echo "❌ Error convirtiendo: $input_file"
        fi
    fi
}

# Verificar si cwebp está instalado
if ! command -v cwebp &> /dev/null; then
    echo "❌ Error: cwebp no está instalado"
    echo "Instalar con: brew install webp (macOS) o apt-get install webp (Ubuntu)"
    exit 1
fi

# Convertir imágenes en layout/img/
echo "📁 Procesando imágenes en layout/img/..."
find layout/img/ -type f \( -iname "*.jpg" -o -iname "*.jpeg" -o -iname "*.png" \) | while read -r file; do
    convert_to_webp "$file"
done

# Convertir imágenes en placeholders
echo "📁 Procesando placeholders..."
find layout/img/placeholders/ -type f \( -iname "*.jpg" -o -iname "*.jpeg" -o -iname "*.png" \) | while read -r file; do
    convert_to_webp "$file"
done

# Crear archivo HTML con picture elements
echo "📝 Generando picture elements..."
cat > layout/picture_elements.html << 'EOF'
<!-- Picture Elements para WebP -->
<picture>
  <source srcset="img/logo.webp" type="image/webp">
  <source srcset="img/logo.png" type="image/png">
  <img src="img/logo.png" alt="Mostay Logo" loading="lazy">
</picture>

<!-- Para imágenes del slider -->
<picture>
  <source srcset="img/slider-image.webp" type="image/webp">
  <source srcset="img/slider-image.jpg" type="image/jpeg">
  <img src="img/slider-image.jpg" alt="Slider Image" loading="lazy">
</picture>

<!-- Para placeholders -->
<picture>
  <source srcset="img/placeholders/blog_300_300.webp" type="image/webp">
  <source srcset="img/placeholders/blog_300_300.jpg" type="image/jpeg">
  <img src="img/placeholders/blog_300_300.jpg" alt="Blog Placeholder" loading="lazy">
</picture>
EOF

echo "✅ Conversión a WebP completada"
echo "📄 Picture elements generados en: layout/picture_elements.html"
echo ""
echo "💡 Para usar WebP en tu HTML:"
echo "1. Reemplaza las etiquetas <img> con <picture>"
echo "2. Usa el formato generado en picture_elements.html"
echo "3. Asegúrate de tener fallbacks para navegadores antiguos"
