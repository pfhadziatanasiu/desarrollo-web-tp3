# Clima Integral

Aplicación para gestionar clientes.

## Ejecutar con XAMPP

1. Copiar esta carpeta dentro de `htdocs` de XAMPP.
2. Iniciar Apache y MySQL desde XAMPP.
3. Importar `data/database.sql` desde phpMyAdmin para crear la base de datos y la tabla de clientes.
4. Abrir `http://localhost/Proyecto/index.php`.

## Cómo usar la interfaz

- **Consultar clientes:** la pantalla principal muestra todos los clientes y sus datos. En pantallas pequeñas, desplazar la tabla horizontalmente para ver todas las columnas.
- **Agregar un cliente:** presionar **+ Nuevo cliente**, completar el formulario y elegir **Guardar cliente**. Nombre, apellido y email son obligatorios.
- **Modificar un cliente:** presionar **Modificar** en su fila, editar los datos y elegir **Guardar cambios**.
- **Borrar un cliente:** presionar **Borrar** en su fila y confirmar con **Borrar cliente**. La eliminación es definitiva.
- **Cancelar:** elegir **Cancelar** para volver al listado sin guardar cambios ni borrar al cliente.

El ID y las fechas se generan automáticamente.
