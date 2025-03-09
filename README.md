
# Startup de cursos online

Aplicación en PHP (en consola) que toma como mínimo las tres primeras letras para consultar coincidencias en el nombre de sus clases y exámenes en su base de datos.


## Requisitos

Antes de instalar, por favor asegúrate de tener instalado lo siguiente:

- PHP 8.x con las extensiones:
  - `pdo`
  - `pdo_mysql`
- Composer (para gestionar dependencias)
- Un servidor de base de datos MySQL/MariaDB


## Instalación

#### 1. Clona el repositorio:

```bash
  git clone https://github.com/xxxx/xxxx.git
  cd xxxx
```

#### 2. Copiar la configuración de PHPUnit:

```bash
  cp phpunit.xml.dist phpunit.xml
```

#### 3. Instala las dependencias con Composer:

```bash
  composer install
```

#### 4. Configuración de la base de datos:

- Crear una base de datos en MySQL/MariaDB.
- Importar el esquema desde ./schema.sql.
- Modificar las configuraciones necesarias en ./config.php.

## Ejecución local

Ir al directorio del proyecto.

```bash
  cd my-project
```

Ejecutar el archivo principal.

```bash
  php .\main.php search <Texto a buscar (mínimo 3 caracteres)>
```

## Ejecución de prubas

Para ejecutar las pruebas, escriba el siguiente comando:

```bash
  vendor/bin/phpunit
```

Este repositorio usa GitHub Actions para ejecutar pruebas en cada PR dirigido a la rama principal (master).
Puedes revisar la configuración en .github/workflows/ci.yml.

## Optimizaciones

La consulta utiliza MATCH - AGAINST en lugar de LIKE para mejorar el rendimiento.
Se realizaron pruebas con ~100.000 registros y se obtuvieron los siguientes resultados:

MATCH - AGAINST es hasta 35x más rápido que LIKE 'search%'.
Se ejecuta en 0.0006s en comparación con 0.0213s.