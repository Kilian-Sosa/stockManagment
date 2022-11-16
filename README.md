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
 
# A3.1 - Manejo de sesiones y cookies

Añade un nuevo repositorio a tu cuenta GitHub donde incorporarás el código fuente que has presentado en la actividad A2.2. Crea una nueva rama en la que implementarás las mejoras que se detallan a continuación:

- Añade a la base de datos una tabla donde registrarás la información relativa a los usuarios que podrán usar la aplicación:
    Nombre y apellidos (en un único campo)
    Nombre de usuario
    Clave encriptada
    Correo electrónico
    Color de fondo favorito (por defecto, blanco)
    Tipo de letra favorita (por defecto, Arial)

- Crea una carpeta en el repositorio en la que incluirás el código SQL de la estructura de todas tus tablas. Si en el futuro realizas alguna modificación en ellas, deberás actualizar dichos ficheros.

- Crea el fichero login.php para mostrar una pantalla que te permita validar a cualquier usuario que intente acceder a la aplicación. Si el usuario intenta acceder directamente a cualquier PHP de la aplicación sin haberse validado previamente, se le deberá redirigir a login.php para que lo haga.

- Al iniciar sesión, carga en dos variables de sesión el color de fondo y el tipo de letra especificados en la tabla de usuarios, de forma que se utilicen en todos los PHP que visite el usuario.

- Crea el fichero perfil.php para permitir al usuario cambiar su nombre y apellidos, contraseña, correo electrónico, color de fondo y tipo de letra. Los datos modificados (únicamente esos datos) los debes volver a cargar en las variables de sesión correspondientes.

- Durante toda la navegación por la aplicación debes mostrar en el encabezado el nombre completo del usuario junto con un enlace que le permita editar el perfil.

- Almacena tres cookies en el navegador con una caducidad de un mes, cuyas funciones sean las siguientes:

    Contar el número de accesos incorrectos a la aplicación.
    Registrar los usuarios y contraseñas utilizados al acceder erróneamente a la aplicación.
    Almacenar la fecha y la hora del último inicio de sesión exitoso. Esta información, en caso de existir, se debe mostrar en la página de inicio de sesión.

- El usuario debería tener la posibilidad de cerrar sesión en cualquier momento, a través de un enlace que se mostrará en el encabezado de todas las páginas de la aplicación. Tras cerrar la sesión, al usuario se le mostrará la página de login.

- Cuando hayas validado el funcionamiento de la aplicación, une la rama donde has hecho este desarrollo a la rama principal.


Propuesta para organizar el código de la validación del usuario

# login.php

- Definir una función "error($mensaje)" que en caso de error guarde en sesión el mensaje de error pasado por parámetro y redirija al usuario a login.php.

- Si está recibiendo datos de inicio de sesión por POST, que obtenga el usuario y contraseña y compruebe si coinciden con los de la BD.

- Si no coinciden o si hay algún problema al conectar con la BD, invocar a la función "error" con un mensaje de error.

- Asignar a una variable de sesión el nombre de usuario
- Redirigir al usuario al listado de productos, aunque lo ideal sería redirigir al usuario a la página desde la que se intentó hacer la validación.

- Si no está recibiendo datos por POST, mostrar el formulario de inicio de sesión.

- Si está definida la variable de sesión 'error', mostrar su contenido y eliminar dicha variable.

# resto de la aplicación
- Si no existe la variable de sesión “nombredeusuario”, redirigir a login.php
