 # 🛒 Marketplace API – Prueba Técnica


## 🚀 Tecnologías utilizadas

- **PHP 8.2+**
- **Laravel 10**
- **MySQL / PostgreSQL**
- **Composer**
- **Postman (documentación de endpoints)**

---

## ⚙️ Instalación y configuración

1️⃣ Clonar el repositorio
```bash
git clone https://github.com/alcarraz301997/marketplace_product.git

2️⃣ Instalar dependencias

composer install

3️⃣ Configurar el archivo .env

Copia el archivo de ejemplo y modifica tus credenciales:

cp .env.example .env

En el archivo .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bd_marketplace
DB_USERNAME=root
DB_PASSWORD=


Luego genera la key:

php artisan key:generate

4️⃣ Ejecutar migraciones y seeders

php artisan migrate --seed


5️⃣ Levantar el servidor local

php artisan serve


Command:

php artisan orders:expire

Busca pedidos con estado pending con más de 24 horas.

Cambia su estado a expired.

Muestra el listado actualizado.



Documentación de API (Postman)

Se incluye una colección exportada en la carpeta:

docs/Productos_Marketplace.postman_collection.json