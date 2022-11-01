# A2.1_ManejoStock

Partiendo de la base de datos '**proyecto**' (que debes crear previamente a partir de los ficheros alojados en el aula virtual), vamos a programar una aplicación que permita gestionar los registros de la tabla '**productos**'. La aplicación se dividirá en 5 páginas:

- `listado.php`. Mostrará en una tabla los datos **código** y **nombre** y los botones para crear un nuevo registro, actualizar uno existente, borrarlo o ver todos sus detalles.

- `crear.php`. Será un formulario para rellenar todos los campos de productos (a excepción del **id**). Para la familia nos aparecerá un "`select`" con los nombre de las familias de los productos para elegir uno (aunque mostremos los nombres en el formulario, el formulario enviará el código de la familia).

- `detalle.php`. Mostrará todo los detalles del producto seleccionado.

- `update.php`. Nos aparecerá un formulario con los campos rellenos con los valores del producto seleccionado desde "`listado.php`" incluido el `select` donde seleccionamos la familia

- `borrar.php`. Será una página `php` con el código necesario para borrar el producto seleccionado desde "`listado.php`" un mensaje de información y un botón volver para volver a "`listado.php`".

Para acceder a la base de datos se debe usar [PDO](#).

Pasaremos el código de producto por "`get`" tanto para "`detalle.php`" como para "update.php". Utilizando en el enlace "`detalle.php?id=cod`" .En ambas páginas comprobaremos que esta variable existe. En caso contrario, redireccionaremos a "`listado.php`". Pa ello podemos usar "`header('Location:listado.php')`".

Deberemos controlar todos los errores que se puedan generar para informar al usuario convenientemente.

# A2.2 - Transacciones y manejo de errores

## Manejo de errores

Modifica el código de la actividad a2.1 de forma que capturemos las excepciones que puedan generar todas las **conexiones** a las bases de datos, y todas las **ejecuciones de sentencias SQL**, de forma que informemos convenientemente al usuario de los posibles errores que se puedan generar en esos casos.

## Transacciones
Modifica el código de la actividad A2.1 para implementar lo siguiente:

- En el listado principal cada producto dispondrá de un nuevo enlace que permitirá al usuario "Mover stock".

- Al pulsar en dicho enlace, se pasará por get el id del producto al php "muevestock.php".

- En dicho PHP se mostrará al usuario un listado que contendrá el stock de dicho producto en cada tienda, junto a un formulario que le permitirá mover unidades a otra tienda. Tendrá las siguientes columnas:
  - Tienda (Nombre)
  - Stock actual (Nº unidades)
  - Nueva tienda (Desplegable)
  - Nº unidades (Desplegable entre 1 y 'Stock actual')

- Por cada desplegable existirá un botón de un formulario que permitirá ejecutar la operación.

El movimiento de stock se debe implementar utilizando transacciones, de forma que si no se completan las operaciones realizadas en las dos tablas no se realice el movimiento.

En caso de que no exista stock en la tienda destino se debe crear el registro correspondiente en la tabla "stock".

NOTA: Fuerza a que se produzca un error en la sentencia SQL que registra el stock en la tienda destino para confirmar que funciona correctamente la gestión de la transacción.

# A2.2.1 - Listado con ordenación de resultados y paginación

Modifica la página principal del listado de productos para que se incorporen las siguientes funcionalidades:

- Número de resultados por página: Incluye un pequeño formulario que permita seleccionar el número de resultados que se muestran en una página. Hasta ahora se mostraban todos los productos en una misma página. A partir de ahora se mostrarán 5 productos por defecto y el usuario podrá cambiar ese valor mediante un desplegable

- Paginación: Se deberán incluir los enlaces correspondientes para pasar a la siguiente o a la anterior página de resultados.

- Ordenación: Pulsando sobre el nombre de las columnas se permitirá al usuario ordenar el listado por el campo seleccionado.
 
