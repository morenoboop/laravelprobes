# API Documentation - Posts

Esta documentación te ayudará a usar la API de Posts en Postman.

## Base URL
```
http://localhost:8000/api
```

---

## Endpoints Disponibles

### 1. GET - Obtener todos los posts
**Endpoint:** `GET /api/posts`

**Descripción:** Obtiene la lista completa de todos los posts.

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "message": "Posts obtenidos correctamente",
    "data": [
        {
            "id": 1,
            "title": "Mi primer post",
            "content": "Contenido del post",
            "name": "Juan Pérez",
            "email": "juan@example.com",
            "password": "password123",
            "age": 25,
            "course_id": 1,
            "created_at": "2025-01-09T10:30:00.000000Z",
            "updated_at": "2025-01-09T10:30:00.000000Z",
            "course": {
                "id": 1,
                "name": "Laravel Basics",
                "created_at": "2025-01-08T15:20:00.000000Z",
                "updated_at": "2025-01-08T15:20:00.000000Z"
            }
        }
    ],
    "count": 1
}
```

---

### 2. GET - Obtener un post específico
**Endpoint:** `GET /api/posts/{id}`

**Descripción:** Obtiene los detalles de un post específico por su ID.

**Parámetro:**
- `id` (requerido): ID del post a obtener

**Ejemplo:** `GET /api/posts/1`

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "message": "Post obtenido correctamente",
    "data": {
        "id": 1,
        "title": "Mi primer post",
        "content": "Contenido del post",
        "name": "Juan Pérez",
        "email": "juan@example.com",
        "password": "password123",
        "age": 25,
        "course_id": 1,
        "created_at": "2025-01-09T10:30:00.000000Z",
        "updated_at": "2025-01-09T10:30:00.000000Z",
        "course": {
            "id": 1,
            "name": "Laravel Basics"
        }
    }
}
```

**Respuesta si no existe (404):**
```json
{
    "success": false,
    "message": "Post no encontrado",
    "data": null
}
```

---

### 3. POST - Crear un nuevo post
**Endpoint:** `POST /api/posts`

**Descripción:** Crea un nuevo post con los datos proporcionados.

**Headers requeridos:**
```
Content-Type: application/json
Accept: application/json
```

**Body (JSON):**
```json
{
    "title": "Mi nuevo post",
    "content": "Este es el contenido de mi nuevo post",
    "name": "Juan Pérez",
    "email": "juan@example.com",
    "password": "password123",
    "age": 25,
    "course_id": 1
}
```

**Campos requeridos:**
- `title` (string, máx 255 caracteres)
- `content` (string)
- `name` (string, máx 255 caracteres)
- `email` (email válido)
- `password` (string, mínimo 6 caracteres)
- `age` (número, entre 1 y 150)
- `course_id` (número, debe existir en la tabla courses)

**Respuesta exitosa (201):**
```json
{
    "success": true,
    "message": "Post creado correctamente",
    "data": {
        "id": 2,
        "title": "Mi nuevo post",
        "content": "Este es el contenido de mi nuevo post",
        "name": "Juan Pérez",
        "email": "juan@example.com",
        "password": "password123",
        "age": 25,
        "course_id": 1,
        "created_at": "2025-01-09T11:45:00.000000Z",
        "updated_at": "2025-01-09T11:45:00.000000Z",
        "course": {
            "id": 1,
            "name": "Laravel Basics"
        }
    }
}
```

**Respuesta con errores de validación (422):**
```json
{
    "success": false,
    "message": "Errores de validación",
    "errors": {
        "email": ["El email debe ser un correo válido"],
        "age": ["El age debe ser un número"]
    }
}
```

---

### 4. PUT - Actualizar un post (completo)
**Endpoint:** `PUT /api/posts/{id}`

**Descripción:** Actualiza todos los campos de un post. Todos los campos son requeridos.

**Parámetro:**
- `id` (requerido): ID del post a actualizar

**Headers requeridos:**
```
Content-Type: application/json
Accept: application/json
```

**Body (JSON):**
```json
{
    "title": "Post actualizado",
    "content": "Contenido actualizado",
    "name": "Juan Carlos",
    "email": "juan.carlos@example.com",
    "password": "newpassword123",
    "age": 26,
    "course_id": 2
}
```

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "message": "Post actualizado correctamente",
    "data": {
        "id": 1,
        "title": "Post actualizado",
        "content": "Contenido actualizado",
        "name": "Juan Carlos",
        "email": "juan.carlos@example.com",
        "password": "newpassword123",
        "age": 26,
        "course_id": 2,
        "created_at": "2025-01-09T10:30:00.000000Z",
        "updated_at": "2025-01-09T12:00:00.000000Z",
        "course": {
            "id": 2,
            "name": "Advanced Laravel"
        }
    }
}
```

---

### 5. PATCH - Actualizar un post (parcial)
**Endpoint:** `PATCH /api/posts/{id}`

**Descripción:** Actualiza solo los campos proporcionados. Los campos no incluidos no se modifican.

**Parámetro:**
- `id` (requerido): ID del post a actualizar

**Headers requeridos:**
```
Content-Type: application/json
Accept: application/json
```

**Body (JSON) - Ejemplo actualizar solo el título:**
```json
{
    "title": "Nuevo título"
}
```

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "message": "Post actualizado correctamente",
    "data": {
        "id": 1,
        "title": "Nuevo título",
        "content": "Contenido original",
        "name": "Juan Pérez",
        "email": "juan@example.com",
        "password": "password123",
        "age": 25,
        "course_id": 1,
        "created_at": "2025-01-09T10:30:00.000000Z",
        "updated_at": "2025-01-09T12:15:00.000000Z",
        "course": {
            "id": 1,
            "name": "Laravel Basics"
        }
    }
}
```

---

### 6. DELETE - Eliminar un post
**Endpoint:** `DELETE /api/posts/{id}`

**Descripción:** Elimina un post existente.

**Parámetro:**
- `id` (requerido): ID del post a eliminar

**Ejemplo:** `DELETE /api/posts/1`

**Respuesta exitosa (200):**
```json
{
    "success": true,
    "message": "Post eliminado correctamente",
    "data": null
}
```

**Respuesta si no existe (404):**
```json
{
    "success": false,
    "message": "Post no encontrado",
    "data": null
}
```

---

## Códigos de respuesta HTTP

| Código | Significado |
|--------|-------------|
| 200 | OK - Solicitud exitosa |
| 201 | Created - Recurso creado exitosamente |
| 404 | Not Found - Recurso no encontrado |
| 422 | Unprocessable Entity - Errores de validación |
| 500 | Internal Server Error - Error del servidor |

---

## Pasos para usar en Postman

### 1. GET todos los posts
1. Abre Postman
2. Crea una nueva solicitud
3. Selecciona **GET**
4. URL: `http://localhost:8000/api/posts`
5. Click en **Send**

### 2. Crear un nuevo post (POST)
1. Crea una nueva solicitud
2. Selecciona **POST**
3. URL: `http://localhost:8000/api/posts`
4. Vete a la pestaña **Body**
5. Selecciona **raw** y cambia a **JSON**
6. Pega el siguiente JSON:
```json
{
    "title": "Mi nuevo post",
    "content": "Este es el contenido de mi nuevo post",
    "name": "Juan Pérez",
    "email": "juan@example.com",
    "password": "password123",
    "age": 25,
    "course_id": 1
}
```
7. Click en **Send**

### 3. Obtener un post específico (GET)
1. Crea una nueva solicitud
2. Selecciona **GET**
3. URL: `http://localhost:8000/api/posts/1`
4. Click en **Send**

### 4. Actualizar un post (PUT)
1. Crea una nueva solicitud
2. Selecciona **PUT**
3. URL: `http://localhost:8000/api/posts/1`
4. Vete a la pestaña **Body**
5. Selecciona **raw** y cambia a **JSON**
6. Pega el JSON con los datos actualizados
7. Click en **Send**

### 5. Actualizar parcialmente un post (PATCH)
1. Crea una nueva solicitud
2. Selecciona **PATCH**
3. URL: `http://localhost:8000/api/posts/1`
4. Vete a la pestaña **Body**
5. Selecciona **raw** y cambia a **JSON**
6. Pega solo los campos que deseas actualizar
7. Click en **Send**

### 6. Eliminar un post (DELETE)
1. Crea una nueva solicitud
2. Selecciona **DELETE**
3. URL: `http://localhost:8000/api/posts/1`
4. Click en **Send**

---

## Notas importantes

- Asegúrate de tener al menos un curso creado en la base de datos, ya que `course_id` debe hacer referencia a un curso existente.
- Los IDs de los posts son auto-incrementales. Usa el ID retornado después de crear un post para operaciones posteriores.
- El servidor debe estar ejecutándose en `http://localhost:8000` para que los endpoints funcionen.
- Si encuentras errores CORS, verifica la configuración de CORS en tu aplicación Laravel.
