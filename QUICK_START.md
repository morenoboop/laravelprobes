# Instrucciones para usar la API en Postman

## 1. Iniciar el servidor Laravel

Ejecuta en tu terminal (en la carpeta del proyecto):
```bash
php artisan serve
```

El servidor se ejecutará en: `http://localhost:8000`

## 2. Importar la colección en Postman

### Opción A: Importar automáticamente
1. Abre Postman
2. Click en el botón **Import** (arriba a la izquierda)
3. Selecciona la pestaña **Upload Files**
4. Carga el archivo `Postman_Posts_API_Collection.json` de este proyecto
5. Click en **Import**

### Opción B: Crear manualmente las solicitudes
Sigue los ejemplos en `API_DOCUMENTATION.md` para crear cada solicitud.

## 3. Endpoints disponibles

### Listar todos los posts
```
GET http://localhost:8000/api/posts
```

### Obtener un post específico
```
GET http://localhost:8000/api/posts/{id}
```
Ejemplo: `GET http://localhost:8000/api/posts/1`

### Crear un nuevo post
```
POST http://localhost:8000/api/posts
```
Body (JSON):
```json
{
  "title": "Mi nuevo post",
  "content": "Contenido del post",
  "name": "Juan Pérez",
  "email": "juan@example.com",
  "password": "password123",
  "age": 25,
  "course_id": 1
}
```

### Actualizar un post completamente
```
PUT http://localhost:8000/api/posts/{id}
```
Ejemplo: `PUT http://localhost:8000/api/posts/1`

Body: Todos los campos requeridos (igual que en POST)

### Actualizar un post parcialmente
```
PATCH http://localhost:8000/api/posts/{id}
```
Ejemplo: `PATCH http://localhost:8000/api/posts/1`

Body: Solo los campos que deseas actualizar
```json
{
  "title": "Nuevo título"
}
```

### Eliminar un post
```
DELETE http://localhost:8000/api/posts/{id}
```
Ejemplo: `DELETE http://localhost:8000/api/posts/1`

## 4. Requisitos previos

### Asegúrate de tener cursos en la base de datos
Los posts deben estar asociados a un curso. Para crear un post necesitas:
1. Un `course_id` válido que exista en la tabla `courses`

Si no tienes cursos, crea uno primero a través de la interfaz web o usando una migración.

## 5. Headers importantes

En Postman, asegúrate de incluir estos headers en tus solicitudes POST/PUT/PATCH:

```
Content-Type: application/json
Accept: application/json
```

En Postman esto se configura automáticamente si seleccionas "raw" y "JSON" en el body.

## 6. Solución de problemas

### Error: "Course not found" o "course_id is invalid"
- Verifica que el `course_id` que estás usando existe en la tabla `courses`
- Puedes consultar los cursos existentes a través de la interfaz web en `/courses`

### Error: "Post not found" (404)
- Verifica que el ID del post existe
- Usa primero `GET /api/posts` para ver todos los posts disponibles

### Error: "Validation errors"
- Asegúrate de incluir todos los campos requeridos
- Verifica que el email sea válido
- La contraseña debe tener al menos 6 caracteres
- La edad debe ser un número entre 1 y 150

## 7. Respuestas esperadas

### Respuesta exitosa (200/201)
```json
{
  "success": true,
  "message": "Operación completada",
  "data": { ... }
}
```

### Respuesta con error (400/404/422/500)
```json
{
  "success": false,
  "message": "Descripción del error",
  "errors": { ... }
}
```

## Archivos creados

1. **ApiPostController.php** - Controlador API con todos los métodos
2. **routes/api.php** - Rutas de la API
3. **API_DOCUMENTATION.md** - Documentación completa
4. **Postman_Posts_API_Collection.json** - Colección para importar en Postman
5. **QUICK_START.md** - Este archivo

¡Listo! Ya puedes empezar a probar la API con Postman.
