# 🎨 Mostay - Estudio de Branding y Diseño

[![WordPress](https://img.shields.io/badge/WordPress-6.0+-blue.svg)](https://wordpress.org/)
[![Sass](https://img.shields.io/badge/Sass-3.4+-pink.svg)](https://sass-lang.com/)
[![Node.js](https://img.shields.io/badge/Node.js-16+-green.svg)](https://nodejs.org/)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

**Sitio web profesional del estudio de branding Mostay, especializado en diseño de marcas y estrategia visual.**

## 📋 **Tabla de Contenidos**

- [🚀 Inicio Rápido](#-inicio-rápido)
- [🏗️ Estructura del Proyecto](#️-estructura-del-proyecto)
- [⚙️ Configuración](#️-configuración)
- [🛠️ Desarrollo](#️-desarrollo)
- [🧪 Testing y Calidad](#-testing-y-calidad)
- [📚 Documentación](#-documentación)
- [🤝 Contribución](#-contribución)

## 🚀 **Inicio Rápido**

### **Prerrequisitos**
- Node.js 16+ y npm
- MAMP/XAMPP para WordPress local
- Git

### **Instalación**
```bash
# Clonar el repositorio
git clone [URL_DEL_REPO]
cd Mostay

# Instalar dependencias
npm install

# Configurar WordPress local
# (Ver sección de configuración)

# Iniciar desarrollo
npm run dev
```

## 🏗️ **Estructura del Proyecto**

```
Mostay/
├── components/                 # Código fuente
│   ├── sass/                  # Estilos SCSS
│   │   ├── 0-plugins/        # Bootstrap, FontAwesome
│   │   ├── 1-base/           # Variables, mixins, base
│   │   └── 2-layouts/        # Componentes de layout
│   └── scripts/               # JavaScript modular
├── wp/                        # WordPress
│   └── wp-content/themes/mostay/  # Tema personalizado
├── project.config.js          # Configuración centralizada
├── package.json               # Dependencias y scripts
└── README.md                  # Esta documentación
```

## ⚙️ **Configuración**

### **Variables del Proyecto**
El archivo `project.config.js` centraliza:
- Rutas de archivos
- Breakpoints responsivos
- Escala de z-index
- Transiciones y espaciados
- Configuración de testing

### **Breakpoints Responsivos**
```scss
// Breakpoints centralizados
$breakpoints: (
  xs: 20rem,    // 320px
  sm: 30rem,    // 480px
  md: 43.75rem, // 700px
  lg: 64rem,    // 1024px
  xl: 90rem     // 1440px
);
```

## 🛠️ **Desarrollo**

### **Comandos Principales**
```bash
# Desarrollo con watch automático
npm run dev

# Compilación manual
npm run build

# Solo SASS
npm run sass:build
npm run sass:watch

# Solo JavaScript
npm run js:build
npm run js:watch
```

### **Scripts de Desarrollo**
```bash
# Usando dev.sh (más opciones)
./dev.sh start      # Iniciar desarrollo
./dev.sh build      # Compilar
./dev.sh test       # Ejecutar tests
./dev.sh deploy     # Desplegar
./dev.sh clean      # Limpiar archivos
```

### **Flujo de Trabajo**
1. **Desarrollo**: `npm run dev` (watch automático)
2. **Testing**: `npm run test` (antes de commit)
3. **Build**: `npm run build` (para producción)
4. **Commit**: Describir cambios claramente
5. **Push**: Solo cuando una funcionalidad esté completa

## 🧪 **Testing y Calidad**

### **Linting Automático**
```bash
# Verificar calidad del código
npm run lint

# Auto-fix de problemas
npm run lint:fix
```

### **Testing Visual**
```bash
# Capturar screenshots en múltiples viewports
npm run test:visual

# Generar reportes
npm run test:report
```

### **Testing de Accesibilidad**
```bash
# Verificar estándares WCAG2AA
npm run test:accessibility
```

### **Lighthouse Performance**
```bash
# Análisis de performance
npm run test:lighthouse
```

## 📚 **Documentación**

### **Archivos de Configuración**
- **`.gitignore`**: Excluye archivos compilados y temporales
- **`project.config.js`**: Configuración centralizada del proyecto
- **`.stylelintrc.json`**: Reglas de linting para SASS
- **`.pa11yci`**: Configuración de testing de accesibilidad

### **Documentación del Proyecto**
- **`README.md`**: Esta guía principal del proyecto
- **`SECURITY.md`**: Configuración y mejoras de seguridad implementadas
- **`FRONTEND.md`**: Todas las mejoras del frontend organizadas por fases
- **`PRELOADER.md`**: Especificaciones técnicas del preloader inteligente
- **`CHANGELOG.md`**: Historial completo de cambios y versiones
- **`DEVELOPMENT.md`**: Guía de desarrollo y workflow

### **Navegación Rápida**
- **🚀 Inicio**: `README.md` - Guía principal y setup
- **🔒 Seguridad**: `SECURITY.md` - Configuración de seguridad
- **🎨 Frontend**: `FRONTEND.md` - Mejoras implementadas
- **⚡ Preloader**: `PRELOADER.md` - Especificaciones técnicas
- **📝 Cambios**: `CHANGELOG.md` - Historial de versiones
- **🛠️ Desarrollo**: `DEVELOPMENT.md` - Workflow y herramientas

### **Convenciones de Nomenclatura**
- **SASS**: kebab-case (`_header.scss`, `_navigation.scss`)
- **JavaScript**: camelCase (`scrollAnimations.js`)
- **PHP**: snake_case (`mostay_functions.php`)
- **Clases CSS**: BEM methodology (`.header__nav--active`)

### **Estructura de Commits**
```
feat: agregar animaciones de scroll
fix: corregir preloader en móviles
docs: actualizar README
style: mejorar espaciado en formularios
refactor: optimizar JavaScript de navegación
```

## 🤝 **Contribución**

### **Antes de Contribuir**
1. Verificar que `npm run test` pase
2. Asegurar que el código cumple estándares de linting
3. Probar en múltiples navegadores
4. Verificar accesibilidad

### **Proceso de Pull Request**
1. Crear rama feature: `git checkout -b feature/nueva-funcionalidad`
2. Desarrollar y testear
3. Commit con mensaje descriptivo
4. Push y crear Pull Request
5. Revisión y merge

## 🚀 **Despliegue**

### **Producción**
```bash
# Build de producción
npm run build:prod

# Verificar calidad
npm run test:all

# Desplegar
npm run deploy
```

### **Staging**
```bash
# Build de staging
npm run build:staging

# Testing en staging
npm run test:staging
```

## 📞 **Soporte**

- **Desarrollador Principal**: Angel Montiel
- **Email**: [EMAIL]
- **Documentación**: Este README
- **Issues**: GitHub Issues

## 📄 **Licencia**

Este proyecto está bajo la Licencia MIT. Ver archivo `LICENSE` para más detalles.

---

**¿Necesitas ayuda?** Revisa la documentación o crea un issue en GitHub.
