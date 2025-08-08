# Guía de Desarrollo - Mostay

## Configuración del Entorno de Desarrollo

### Instalación de Dependencias
```bash
npm install
```

### Comandos Disponibles

#### Compilación
- `npm run build` - Compila tanto Sass como JavaScript
- `npm run sass:build` - Compila solo Sass
- `npm run js:build` - Compila solo JavaScript

#### Modo Desarrollo (Watch)
- `npm run dev` - Inicia el modo watch para ambos (Sass + JS)
- `npm run watch` - Alias para `npm run dev`
- `npm run sass:watch` - Watch solo para Sass
- `npm run js:watch` - Watch solo para JavaScript

### Estructura de Archivos

#### Sass
- **Entrada**: `components/sass/main.scss`
- **Salida**: `wp/wp-content/themes/mostay/css/main.min.css`
- **Source Map**: `wp/wp-content/themes/mostay/css/main.min.css.map`

#### JavaScript
- **Entrada**: `components/scripts/script.js`
- **Salida**: `wp/wp-content/themes/mostay/js/script-bundle.min.js`

### Flujo de Trabajo

1. **Iniciar desarrollo**:
   ```bash
   npm run dev
   ```

2. **Editar archivos**:
   - Sass: `components/sass/`
   - JavaScript: `components/scripts/script.js`

3. **Los cambios se compilan automáticamente** y se reflejan en el tema de WordPress

### Configuración del Servidor Local

Para ver los cambios en el navegador, asegúrate de que:
- MAMP esté corriendo
- El sitio esté configurado en `http://localhost/Mostay/wp/`
- El tema "mostay" esté activo en WordPress

### Notas Importantes

- Los archivos compilados se guardan en el tema de WordPress
- Los source maps están habilitados para debugging
- Sass se compila en modo comprimido para producción
- JavaScript se minifica y manglea para producción
