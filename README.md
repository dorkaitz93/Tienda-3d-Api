3D Print & Merch Store - Backend API
Esta es la API desarrollada para gestionar una tienda online de merchandising y figuras de impresión 3D. El proyecto está construido con Laravel 11, aplicando prácticas de desarrollo backend y diseño de bases de datos relacionales.

Características Principales
Gestión de Catálogo: CRUD de productos con control de stock automatizado.

Categorización Dinámica: Organización de productos mediante categorías vinculadas con Slugs para optimización de rutas.

Sistema de Pedidos: Motor de procesamiento de compras que soporta tanto usuarios registrados como invitados.

Transacciones Seguras: Implementación de DB::transaction para garantizar la integridad de los datos en pagos y stock.

Relaciones Avanzadas: Uso de tablas pivote para gestionar pedidos con múltiples productos y cantidades.

API RESTful: Endpoints preparados para ser consumidos por un frontend en Vue 3.

Tecnologías Utilizadas
Framework: Laravel 11

Lenguaje: PHP 8.2+

Base de Datos: MySQL / MariaDB

Herramientas de Testing: Thunder Client / Postman

Entorno: XAMPP

Estructura de la Base de Datos
El sistema se basa en cuatro pilares:

Categorías: Familia de productos (Camisetas, Figuras 3D, etc.).

Productos: Detalles técnicos, precios, tallas y stock.

Pedidos: Información del cliente, dirección y estado de la venta.

Pedido_Producto (Pivot): Detalle de cada producto vendido, capturando el precio en el momento de la compra.

Endpoints Principales
Productos
GET /api/productos - Lista todos los productos.

GET /api/productos/{id} - Detalle de un producto específico.

Categorías
GET /api/categorias - Listado de categorías para navegación.

GET /api/categorias/{slug} - Filtra productos por categoría.

Ventas
POST /api/pedidos - Procesa un carrito de compra, genera el pedido y descuenta stock.

GET /api/pedidos - Historial de ventas con carga ambiciosa de productos.

Instalación Local
Clona el repositorio:


git clone https://github.com/tu-usuario/nombre-del-repo.git
Instala las dependencias:


composer install
Configura el archivo .env (Base de Datos y APP_KEY).

Ejecuta las migraciones y los seeders:


php artisan migrate:fresh --seed
Enlaza el almacenamiento de imágenes:


php artisan storage:link
Inicia el servidor:


php artisan serve

Desarrollado por Dorki - Desarrollador Web.